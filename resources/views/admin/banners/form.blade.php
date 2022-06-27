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

        <fieldset>
            <legend>Изображение <span class="text-danger">*</span></legend>
            <div class="form-group">
                <input type="file" class="form-input-image-media" id="image" name="image"
                       accept="image/x-png,image/gif,image/jpeg,image/svg">
                <p class="help-block"></p>

                @if(isset($item) && $item->getFirstMedia('default'))
                    <fieldset>
                        <legend>Текущее изображение</legend>
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



