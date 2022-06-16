<form action="{{ $formAction }}" method="post" class="ajax"
      data-ui-block-type="element" data-ui-block-element="#largeModal .modal-body" id="ajaxForm">

    <fieldset>
        <legend>Информация об элементе</legend>
        @yield('inputs')
    </fieldset>

    <button type="button" class="btn btn-accent btn-sm float-right" data-dismiss="modal">{{ $buttonCancel }}</button>
    <button type="submit" class="btn btn-brand btn-sm">{{ $buttonSubmit }}</button>
</form>
