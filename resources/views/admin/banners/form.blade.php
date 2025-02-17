<form action="{{ $formAction }}" method="post" class="ajax"
      data-ui-block-type="element" data-ui-block-element="#largeModal .modal-body" id="ajaxForm">

    @include('core::fields.cropper')

    <ul class="nav nav-tabs" role="tablist" style="margin-top: 5px;">
        @foreach(config('project.locales') as $count => $locale)
            <li role="presentation" class="nav-item">
                <a class="@if($count == 0) active @endif nav-link" href="#tab-{{ $count }}"
                   aria-controls="#tab-{{ $count }}" role="tab"
                   data-toggle="tab">{{ $locale }}</a>
            </li>
        @endforeach
    </ul>

    <div class="tab-content">
        @foreach(config('project.locales') as $count => $locale)
            <div role="tabpanel" class="tab-pane @if($count == 0) active @endif" id="tab-{{ $count }}">
                <fieldset>
                    <legend>Информация об элементе</legend>

                    <div class="form-group">
                        <label for="title.{{$locale}}">Заголовок ({{ $locale }}) @if($locale === config('project.default_locale'))<span class="text-danger">*</span>@endif</label>
                        <input type="text" class="form-control" id="title.{{$locale}}" name="title[{{ $locale }}]"
                               @if(isset($item)) value="{{ $item->getTranslation('title', $locale) }}" @endif>
                        <p class="help-block"></p>
                    </div>
                    @if($config('banner.hasContent'))
                        <div class="form-group">
                            <label for="content.{{$locale}}">Описание ({{ $locale }}) @if($locale === config('project.default_locale'))<span class="text-danger">*</span>@endif</label>
                            <textarea type="text" class="form-control editor_short" id="content.{{$locale}}"
                                      name="content[{{ $locale }}]">@isset($item){{ $item->getTranslation('content', $locale) }}@endisset</textarea>
                            <p class="help-block"></p>
                        </div>
                    @endif
                    @if($config('banner.hasButton'))
                    <div class="form-group">
                        <label for="button_text.{{$locale}}">Текст кнопки ({{ $locale }})</label>
                        <input type="text" class="form-control" id="button_text.{{$locale}}" name="button_text[{{ $locale }}]"
                               @if(isset($item)) value="{{ $item->getTranslation('button_text', $locale) }}" @endif>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label for="button_url.{{$locale}}">URL кнопки ({{ $locale }})</label>
                        <input type="text" class="form-control" id="button_url.{{$locale}}" name="button_url[{{ $locale }}]"
                               @if(isset($item)) value="{{ $item->getTranslation('button_url', $locale) }}" @endif>
                        <p class="help-block"></p>
                    </div>
                        @endif
                </fieldset>
            </div>
        @endforeach

        <button type="button" class="btn btn-accent btn-sm float-right"
                data-dismiss="modal">{{ $config('button.cancel') }}</button>
        <button type="submit" class="btn btn-brand btn-sm">{{ $config('button.create') }}</button>
    </div>
</form>

<script>
    $('.editor_short').each(function () {
        let height = $(this).attr('data-editor-height');
        editor = CKEDITOR.replace($(this).attr('id'), {

            height: (height) ? height : 150
        });

        editor.ui.addButton('FileManager', {
            label: "Менеджер файлов",
            command: 'showFileManager',
            toolbar: 'insert',
            icon: '/core/js/vendors/ckeditor/image_file.png'
        });

        editor.addCommand("showFileManager", {
            exec: function (edt) {
                app.functions.editorShowObjects(edt);
            }
        });
    });
</script>

