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
                        <label for="title.{{$locale}}">Заголовок ({{ $locale }}) <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title.{{$locale}}"
                               name="title[{{ $locale }}]"
                               @if(isset($item)) value="{{ $item->getTranslation('title', $locale) }}" @endif>
                        <p class="help-block"></p>
                    </div>
                </fieldset>
            </div>
        @endforeach

        <div class="form-group">
            <label for="start_date">Дата Начала <span class="text-danger">*</span></label>
            <input type="text" id="start_date" name="start_date" class="form-control dpt m-input"
                   @if(isset($item)) value="{{ date("Y-m-d", strtotime($item->start_date ?? "")) }}"
                   @endif autocomplete="off">
            <p class="help-block"></p>
        </div>
        <div class="form-group">
            <label for="end_date">Дата окончания</label>
            <input type="text" id="end_date" name="end_date" class="form-control dpt m-input"
                   @if(isset($item)) value="{{ date("Y-m-d", strtotime($item->end_date ?? "")) }}"
                   @endif autocomplete="off">
            <p class="help-block"></p>
        </div>

        <button type="button" class="btn btn-accent btn-sm float-right"
                data-dismiss="modal">{{ $config('button.cancel') }}</button>
        <button type="submit" class="btn btn-brand btn-sm">{{ $config('button.create') }}</button>
    </div>
</form>

<script>
    if ($('.dpt').length)
    {
        $('.dpt').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'yyyy-mm-dd',
        })
    }
</script>
