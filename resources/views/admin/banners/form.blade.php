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
        <fieldset>
            <legend>Изображение <span class="text-danger">*</span></legend>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <input type="file" id="cropper-image" onchange="handleFile(this);"/>
                    </div>
                    <div class="col">
                        <button type="button" id="crop_button" class="btn btn-sm btn-info float-right d-none">Обрезать</button>
                    </div>
                </div>
                <input type="file" id="image" name="image" class="d-none">
                <p class="help-block"></p>

                <div class="image_container">
                    <img id="uploaded" src="#" alt="uploaded" class="d-none"/>
                </div>
                @if(isset($item) && $item->getFirstMedia('default'))
                    <img id="cropped-image" style="width: 100%" alt="cropped"
                         src="{{ $item->getFirstMedia('default')->getFullUrl() }}">
                @else
                    <img id="cropped-image" src="" alt="cropped" class="d-none">
                @endif
            </div>
        </fieldset>

        @foreach(config('project.locales') as $count => $locale)
            <div role="tabpanel" class="tab-pane @if($count == 0) active @endif" id="tab-{{ $count }}">
                <fieldset>
                    <legend>Информация об элементе</legend>

                    <div class="form-group">
                        <label for="title.{{$locale}}">Заголовок ({{ $locale }}) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title.{{$locale}}" name="title[{{ $locale }}]"
                               @if(isset($item)) value="{{ $item->getTranslation('title', $locale) }}" @endif>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label for="content.{{$locale}}">Описание ({{ $locale }}) <span class="text-danger">*</span></label>
                        <textarea type="text" class="form-control editor_short" id="content.{{$locale}}"
                                  name="content[{{ $locale }}]">@isset($item){{ $item->getTranslation('content', $locale) }}@endisset</textarea>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label for="button_text.{{$locale}}">Текст кнопки ({{ $locale }}) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="button_text.{{$locale}}" name="button_text[{{ $locale }}]"
                               @if(isset($item)) value="{{ $item->getTranslation('button_text', $locale) }}" @endif>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label for="button_url.{{$locale}}">URL кнопки ({{ $locale }}) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="button_url.{{$locale}}" name="button_url[{{ $locale }}]"
                               @if(isset($item)) value="{{ $item->getTranslation('button_url', $locale) }}" @endif>
                        <p class="help-block"></p>
                    </div>
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

<script type="text/javascript">
    function handleFile(input) {
        if (input.files && input.files[0]) {
            destroyCropper();

            let reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('uploaded').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
            setTimeout(initCropper, 1000);
        }
    }

    function destroyCropper() {
        if (typeof cropper !== 'undefined') {
            cropper.destroy();
            document.getElementById('crop_button').classList.add('d-none')
        }

        document.getElementById('cropped-image').classList.add('d-none');
    }

    function initCropper() {
        image = document.getElementById('uploaded');
        cropper = new Cropper(image, {
            minContainerHeight: 400,
            aspectRatio: {{ $config('cropper.aspectRatio') }},
            viewMode: 2,
        });
        document.getElementById('crop_button').classList.remove('d-none')
    }

    function setImagePreview(base64image) {
        document.getElementById('cropped-image').src = base64image;
        document.getElementById('cropped-image').classList.remove('d-none');
    }

    function setFileToInput(blob) {
        let dt = new DataTransfer();
        dt.items.add(new File([blob], 'cropped.jpg', {type: 'image/jpeg'}));
        document.getElementById('image').files = dt.files;
    }

    document.getElementById('crop_button').addEventListener('click', function () {
        let canvasOrigin = cropper.getCroppedCanvas();
        destroyCropper();
        setImagePreview(canvasOrigin.toDataURL());
        canvasOrigin.toBlob((blob) => {
            setFileToInput(blob);
        }, 'image/jpeg', 0.75);

    });
</script>
