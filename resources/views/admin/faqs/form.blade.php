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
                        <label for="question.{{$locale}}">Вопрос ({{ $locale }}) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="question.{{$locale}}" name="question[{{ $locale }}]"
                               @if(isset($item)) value="{{ $item->getTranslation('question', $locale) }}" @endif>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label for="answer.{{$locale}}">Ответ ({{ $locale }}) <span class="text-danger">*</span></label>
                        <textarea type="text" class="form-control editor_short" id="answer.{{$locale}}"
                                  name="answer[{{ $locale }}]">@isset($item){{ $item->getTranslation('answer', $locale) }}@endisset</textarea>
                        <p class="help-block"></p>
                    </div>
                </fieldset>
            </div>
        @endforeach

        <div class="form-group">
            <label class="m-checkbox" for="active">
                <input type="checkbox" name="active" id="active"
                       @if(isset($item) && $item->getOriginal('active')) checked @endif> Отображать на сайте
                <span></span>
            </label>
            <p class="help-block"></p>
        </div>

        <button type="button" class="btn btn-accent btn-sm float-right" data-dismiss="modal">{{ $config('button.cancel') }}</button>
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
