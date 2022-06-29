<form action="{{ $formAction }}" method="post" class="ajax"
      data-ui-block-type="element" data-ui-block-element="#largeModal .modal-body" id="ajaxForm">

    <div>
        <fieldset>
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" id="name" name="name"
                       @if(isset($item)) value="{{ $item->name }}" @endif>
                <p class="help-block"></p>
            </div>
            <div class="form-group">
                <label for="url">Ссылка</label>
                <input type="text" class="form-control" id="url" name="url"
                       @if(isset($item)) value="{{ $item->url }}" @endif>
                <p class="help-block"></p>
            </div>
        </fieldset>

        <button type="button" class="btn btn-accent btn-sm float-right"
                data-dismiss="modal">{{ $buttonCancel }}</button>
        <button type="submit" class="btn btn-brand btn-sm">{{ $buttonSubmit }}</button>
    </div>
</form>



