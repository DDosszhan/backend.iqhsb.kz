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
                        <label for="title.{{$locale}}">Имя ({{ $locale }}) @include('helpers.required')</label>
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
                        <label for="content.{{$locale}}">Содержание ({{ $locale }}) @include('helpers.required')</label>
                        <textarea type="text" class="form-control editor" id="content.{{$locale}}"
                                  name="content[{{ $locale }}]">@isset($item){{ $item->getTranslation('content', $locale) }}@endisset</textarea>
                        <p class="help-block"></p>
                    </div>

                </fieldset>
            </div>
        @endforeach

        <fieldset>
            <legend>Настройки</legend>
            <div class="form-group">
                <label for="published_at">Дата публикации</label>
                <input type="text" id="published_at" name="published_at" class="form-control dpt m-input"
                       @if(isset($item)) value="{{ date("d.m.Y H:i", strtotime($item->published_at ?? "")) }}" @endif autocomplete="off">
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label class="m-checkbox" for="active">
                    <input type="checkbox" name="active" id="active"
                           @if(isset($item) && $item->getOriginal('active')) checked @endif> Отображать на сайте
                    <span></span>
                </label>
                <p class="help-block"></p>
            </div>
        </fieldset>

        <button type="button" class="btn btn-accent btn-sm float-right"
                data-dismiss="modal">{{ $config('button.cancel') }}</button>
        <button type="submit" class="btn btn-brand btn-sm">{{ isset($item) ? $config('button.edit') : $config('button.create') }}</button>
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
<script>
    app.functions.initDateTimePicker();
</script>

