<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'recipe/cachetool.php';

// Название проекта
set('application', 'iqanat'); # Пример: lumen-media

// Репозиторий проекта
set('repository', 'https://gitlab+deploy-token-127:F7A4WKCaHWiv63ka7xYX@gitlab.ibecsystems.kz/iqanat/iqanat-backend.git');
# Пример: https://gitlab+deploy-token-90:xCrDP9iJ1mBebFUMRnBx@gitlab.ibecsystems.kz/lumen-media/lumen-media-backend.git

// [Optional] Allocate tty for git clone. Default value is false.
//set('git_tty', true);

// Общие файлы/директории которые перемещаются из релиза в релиз.
add('shared_files', ['.env']);

// Директории в которые может писать веб-сервер.
add('writable_dirs', ['storage', 'vendor']);
set('allow_anonymous_stats', false);

set('http_user', 'nginx');
set('default_timeout', 1000);

host('production')
    ->hostname('86.107.45.139') # Ваш IP сервера Production
    ->port(22) # SSH Port
    ->set('branch', 'production') # Ветка которая используется для деплоя
    ->stage('production') # Название среды
    ->user('deployer') # Юзер от которого выполняется деплой
    ->set('deploy_path', '/var/www/backend.iqhsb.kz') # Пример: backend.lumenmedia.kz
    ->set('composer_options', 'install --no-dev --verbose')
    ->set('keep_releases', 3);

host('testing')
    ->hostname('86.107.45.139')
    ->port(22)
    ->set('branch', 'master')
    ->stage('testing')
    ->user('deployer')
    ->set('deploy_path', '/var/www/test-backend.iqhsb.kz') # Пример: backend.lumen-media.ibec.systems
    ->set('composer_options', 'install --no-dev --verbose')
    ->set('keep_releases', 1);


// Build
task('build', function () {
    run('cd {{release_path}} && build');
});

// Заюзаем сиды если они добавлены
desc('Execute artisan db:seed');
task('artisan:db:seed', function () {
    $output = run('{{bin/php}} {{release_path}}/artisan db:seed --force');
    writeln('<info>' . $output . '</info>');
});

// Сделаем composer dump-autoload
desc('Execute composer dump-autoload');
task('composer:dump-autoload', function() {
    run('cd {{release_path}} && composer dump-autoload --verbose');
});

// Удалим роут кэш так как юзаем Clasure.
desc('Execute artisan route:cache');
task('artisan:optimize', function () {
    run('echo scip route cache');
});

// Удалим остатки релизов с норм таймаутом по харду.
desc('Cleaning up old releases');
task('cleanup', function () {
    $releases = get('releases_list');
    $keep = get('keep_releases');
    $sudo  = get('cleanup_use_sudo') ? 'sudo' : '';
    $runOpts = [];
    if ($sudo) {
        $runOpts['tty'] = get('cleanup_tty', false);
    } else {
        $runOpts['timeout'] = 1000;
    }

    if ($keep === -1) {
        // Keep unlimited releases.
        return;
    }

    while ($keep > 0) {
        array_shift($releases);
        --$keep;
    }

    foreach ($releases as $release) {
        run("$sudo rm -rf {{deploy_path}}/releases/$release", $runOpts);
    }

    run("cd {{deploy_path}} && if [ -e release ]; then $sudo rm release; fi", $runOpts);
    run("cd {{deploy_path}} && if [ -h release ]; then $sudo rm release; fi", $runOpts);
});

/**
 * Clear opcache cache
 */
desc('Clearing OPcode cache');
task('cachetool:clear:opcache', function () {
    $releasePath = get('release_path');
    $options = get('cachetool');
    $fullOptions = get('cachetool_args');

    if (strlen($fullOptions) > 0) {
        $options = "{$fullOptions}";
    } elseif (strlen($options) > 0) {
        $options = "--fcgi={$options}";
    }

    cd($releasePath);
    $hasCachetool = run("if [ -e $releasePath/{{bin/cachetool}} ]; then echo 'true'; fi");

    if ('true' !== $hasCachetool) {
        run("curl -sO https://gordalina.github.io/cachetool/downloads/{{bin/cachetool}}");
    }

    run("{{bin/php}} {{bin/cachetool}} opcache:reset {$options}");
})->onStage('production');

// Удалим багнутный конфиг с Closure
task('deploy:writable', function() {
    run('echo do not writable');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');

// Cache clear
after('success', 'cachetool:clear:opcache');

// View clear because Redis.
after('success','artisan:view:clear');

// Cache clear because Redis.
after('success','artisan:cache:clear');

// Config Cache clear because Redis.
after('success','artisan:config:cache');
