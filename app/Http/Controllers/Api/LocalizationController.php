<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use StarterKit\Core\Http\Utils\ResponseBuilder;
use StarterKit\Core\Services\LocalisationService\LocalisationService;

/**
 * Работает с переводами
 *
 * Class LocalizationController
 * @package App\Http\Controllers\Api\V1\Localization
 */
class LocalizationController extends Controller
{
    private $localisationService;
    private $responseBuilder;

    public function __construct(LocalisationService $localisationService, ResponseBuilder $responseBuilder)
    {
        $this->localisationService = $localisationService;
        $this->responseBuilder = $responseBuilder;
    }

    /**
     * Выводит переводы в locale
     * @param string $locale
     * @return \Illuminate\Http\JsonResponse
     */
    public function i18n(string $locale)
    {
        $translations = $this->localisationService->getLocalisationsForApi($locale);

        if (empty($translations)) {
            return $this->responseBuilder->apiError(404, 'Переводы не найдены', 404);
        }

        return $this->responseBuilder->apiSuccess($translations);
    }

    /**
     * Выводит дополнительные данные для работы с локализацией.
     * @return \Illuminate\Http\JsonResponse
     */
    public function i18nAdditionalData()
    {
        $locales = config('project.locales');

        return $this->responseBuilder->apiSuccess(['locales' => $locales]);
    }
}
