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
                        <label for="name.{{$locale}}">Название университета ({{ $locale }}) @if($locale === config('project.default_locale'))<span class="text-danger">*</span>@endif</label>
                        <input type="text" class="form-control" id="name.{{$locale}}" name="name[{{ $locale }}]"
                               @if(isset($item)) value="{{ $item->getTranslation('name', $locale) }}" @endif>
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



