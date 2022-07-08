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
                        <label for="name.{{$locale}}">Имя ({{ $locale }}) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name.{{$locale}}" name="name[{{ $locale }}]"
                               @if(isset($item)) value="{{ $item->getTranslation('name', $locale) }}" @endif>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label for="company.{{$locale}}">Название компании ({{ $locale }}) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="company.{{$locale}}" name="company[{{ $locale }}]"
                               @if(isset($item)) value="{{ $item->getTranslation('company', $locale) }}" @endif>
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <label for="description.{{$locale}}">Текст ({{ $locale }}) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="description.{{$locale}}" name="description[{{ $locale }}]"
                               @if(isset($item)) value="{{ $item->getTranslation('description', $locale) }}" @endif>
                        <p class="help-block"></p>
                    </div>
                </fieldset>
            </div>
        @endforeach

        <fieldset>
            <legend>Фото партнера <span class="text-danger">*</span></legend>
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

        <button type="button" class="btn btn-accent btn-sm float-right"
                data-dismiss="modal">{{ $config('button.cancel') }}</button>
        <button type="submit" class="btn btn-brand btn-sm">{{ $config('button.create') }}</button>
    </div>
</form>



