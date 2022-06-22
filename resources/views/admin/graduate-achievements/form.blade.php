<form action="{{ $formAction }}" method="post" class="ajax"
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
                        <label for="graduate_name.{{$locale}}">Имя выпускника ({{ $locale }}) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="graduate_name.{{$locale}}"
                               name="graduate_name[{{ $locale }}]"
                               @if(isset($item)) value="{{ $item->getTranslation('graduate_name', $locale) }}" @endif>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label for="description.{{$locale}}">Текст ({{ $locale }}) <span
                                class="text-danger">*</span></label>
                        <textarea type="text" class="form-control editor_short" id="description.{{$locale}}"
                                  name="description[{{ $locale }}]">@isset($item)
                                {{ $item->getTranslation('description', $locale) }}
                            @endisset</textarea>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label for="city.{{$locale}}">Город ({{ $locale }}) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="city.{{$locale}}" name="city[{{ $locale }}]"
                               @if(isset($item)) value="{{ $item->getTranslation('city', $locale) }}" @endif>
                        <p class="help-block"></p>
                    </div>
                </fieldset>
            </div>
        @endforeach

        <div class="form-group">
            <label for="year">Год <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="year" name="year"
                   @if(isset($item)) value="{{ $item->year }}" @endif>
            <p class="help-block"></p>
        </div>
        <div class="form-group">
            <label for="university_id">Университет <span class="text-danger">*</span></label>
            <select id="university_id" name="university_id" class="form-control">
                <option value="">Выбрать университет</option>
                @foreach($universities as $university)
                    <option value="{{ $university->id }}" @if(isset($item) && $item->university_id == $university->id) selected @endif>
                        {{ $university->name }}
                    </option>
                @endforeach
            </select>
            <p class="help-block"></p>
        </div>
        <fieldset>
            <legend>Фото выпускника <span class="text-danger">*</span></legend>
            <div class="form-group">
                <input type="file" class="form-input-image-media" id="image" name="image"
                       accept="image/x-png,image/gif,image/jpeg,image/svg">
                <p class="help-block"></p>
                @if(isset($item) && $item->getFirstMedia('default'))
                    <fieldset>
                        <legend>Текущее фото</legend>
                        <img width="150" src="{{ $item->getFirstMedia('default')->getFullUrl() }}">
                    </fieldset>
                @endif
            </div>
        </fieldset>

        <button type="button" class="btn btn-accent btn-sm float-right"
                data-dismiss="modal">{{ $buttonCancel }}</button>
        <button type="submit" class="btn btn-brand btn-sm">{{ $buttonSubmit }}</button>
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
