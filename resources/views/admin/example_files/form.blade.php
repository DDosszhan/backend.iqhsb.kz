<form action="{{ $formAction }}" method="post" class="ajax"
      data-ui-block-type="element" data-ui-block-element="#largeModal .modal-body" id="ajaxForm">

    <div class="form-group">
        <label for="name">Имя</label>
        <input type="text" class="form-control" id="name" name="name"
               @if(isset($item)) value="{{ $item->name }}" @endif disabled>
        <p class="help-block"></p>
    </div>

    <fieldset>
        <legend>Файл <span class="text-danger">*</span></legend>
        <div class="form-group">
            <input type="file" id="example_file" name="example_file">
            <p class="help-block"></p>

            @if(isset($item) && $item->getFirstMedia('default'))
                <fieldset>
                    <legend>Загруженный файл</legend>
                    <a target="_blank" href="{{ $item->getFirstMedia('default')->getFullUrl() }}">
                        Скачать
                    </a>
                </fieldset>
            @endif
        </div>
    </fieldset>

    <button type="button" class="btn btn-accent btn-sm float-right" data-dismiss="modal">{{ $config('button.cancel') }}</button>
    <button type="submit" class="btn btn-brand btn-sm">{{ isset($item) ? $config('button.edit') : $config('button.create') }}</button>
</form>



