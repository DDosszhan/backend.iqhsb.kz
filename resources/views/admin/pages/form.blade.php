<form action="{{ $formAction }}" method="post" class="ajax" enctype="multipart/form-data"
      data-ui-block-type="element" data-ui-block-element="#largeModal .modal-body" id="ajaxForm">


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

                    <div class="form-group">
                        <label for="slug">Машинное имя</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder=""  @if(isset($item)) value="{{$item->slug}}" @endif disabled>
                        <p class="help-block"></p>
                    </div>

                    <div class="form-group">
                        <label for="content.{{$locale}}">Содержание ({{ $locale }}) @if($locale === config('project.default_locale'))<span class="text-danger">*</span>@endif</label>
                        <textarea type="text" class="form-control editor" id="content.{{$locale}}"
                                  name="content[{{ $locale }}]">@isset($item){{ $item->getTranslation('content', $locale) }}@endisset</textarea>
                        <p class="help-block"></p>
                    </div>

                    {{-- range() - создает массив --}}
                    @if (isset($item) && $item->settings['block_count'] > 0)
                        @foreach(range(0,$item->settings['block_count']-1) as $num)
                            <fieldset>
                                <legend><b>Блок {{ $num+1 }} ({{ $locale }})</b></legend>

                                <div class="form-group">
                                    <label for="blocks.{{ $num }}.title.{{$locale}}">Заголовок</label>
                                    <input type="text" class="form-control" id="blocks.{{ $num }}.title.{{$locale}}" name="blocks[{{ $num }}][title][{{ $locale }}]"
                                           @if(isset($item) && isset($item->blocks[$num])) value="{{ $item->blocks[$num]['title'][$locale] }}" @endif>
                                    <p class="help-block"></p>
                                </div>

                                <div class="form-group">
                                    <label for="blocks.{{ $num }}.content.{{$locale}}">Содержание</label>
                                    <textarea type="text" class="form-control editor" id="blocks.{{ $num }}.content.{{$locale}}" rows="5"
                                              name="blocks[{{ $num }}][content][{{ $locale }}]">@if(isset($item) && isset($item->blocks[$num])){{ $item->blocks[$num]['content'][$locale] }}@endif</textarea>
                                    <p class="help-block"></p>
                                </div>
                            </fieldset>
                        @endforeach
                    @endif

                </fieldset>
            </div>
        @endforeach

        @if(isset($item) && $item->getConfig('has_image'))
            <fieldset>
                <legend>Изображение</legend>
                <div class="form-group">
                    <input type="file" class="form-input-image-media" id="image" name="image"
                           accept="image/x-png,image/gif,image/jpeg,image/svg+xml">
                    <p class="help-block"></p>

                    @if(isset($item) && $item->getFirstMedia('default'))
                        <fieldset>
                            <legend>Текущее фото</legend>
                            <img width="150" src="{{ $item->getFirstMedia('default')->getFullUrl() }}">
                        </fieldset>
                    @endif
                </div>
            </fieldset>
        @endif

        @if(isset($item) && $item->getConfig('has_gallery'))
            <fieldset>
                <legend>Галерея</legend>
                <div class="form-group">
                    <input type="file" id="gallery" name="gallery[]" multiple accept="image/x-png,image/gif,image/jpeg,image/svg+xml">
                    <p class="help-block"></p>

                    @if(isset($item) && $item->getFirstMedia('gallery'))
                        <fieldset style="display: flex; flex-direction: row; flex-wrap: wrap;">
                            <legend>Загруженные изображения</legend>
                            @foreach($item->getMedia('gallery') as $media)
                                <div id="gallery-media-{{ $media->id }}" style="width: 150px; display: flex; flex-direction: column; justify-content: center; margin: 0 10px 10px 0">
                                    <img width="150" src="{{ $media->getFullUrl() }}" class="p-1 m-1 border">
                                    <a href="#" class="handle-click" data-type="confirm"
                                       title="Удалить"
                                       data-title="Удаление"
                                       data-message="Вы уверены, что хотите удалить?"
                                       data-cancel-text="Нет"
                                       data-confirm-text="Да, удалить" data-url="{{ route($config('route.deleteMedia'), ['id' => $item->id, 'mediaId' => $media->id ]) }}"
                                       style="text-align: center; color: red"
                                    >
                                        <i class="la la-trash"></i> Удалить
                                    </a>
                                </div>
                            @endforeach
                        </fieldset>
                    @endif
                </div>
            </fieldset>
        @endif

        <button type="button" class="btn btn-accent btn-sm float-right" data-dismiss="modal">{{ $config('button.cancel') }}</button>
        <button type="submit" class="btn btn-brand btn-sm">{{ $config('button.create') }}</button>
    </div>
</form>

<script>
    $('.editor').each(function () {
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
