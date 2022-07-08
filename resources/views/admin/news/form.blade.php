<div class="row">
    <div class="col-md-12">
        <form action="{{$formAction}}" method="post" class="ajax" id="newsForm">
                <fieldset>
                    <legend>Медиа новости</legend>
                    <div class="form-group">
                        <label for="image">Картинка новости *</label>
                        <input type="file" class="form-control  " id="image" name="image" placeholder="">
                        <p class="help-block"></p>

                        @if(isset($item) && $item->media->first())
                            <fieldset>
                                <legend>Текущее изображение</legend>
                                <img width="150" src="{{ $item->media->first()->url }}">
                            </fieldset>
                        @endif
                    </div>
                </fieldset>

            <ul class="nav nav-tabs" role="tablist">
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
                    <div role="tabpanel" class="tab-pane @if($count == 0)  active  @endif " id="tab-{{ $count }}">
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset>
                                    <legend>Информация о новости</legend>
                                    <div class="form-group">
                                        <label for="title.{{ $locale }}">Заголовок *</label>
                                        <input type="text" class="form-control" id="title.{{ $locale }}" name="title[{{ $locale }}]" placeholder=""  @if(isset($item)) value="{{$item->getTranslation('title', $locale)}}" @endif>
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Машинное имя</label>
                                        <input type="text" class="form-control" id="slug" name="slug" placeholder=""  @if(isset($item)) value="{{$item->slug}}" @endif disabled>
                                        <p class="help-block"></p>
                                    </div>
{{--                                    <div class="form-group">--}}
{{--                                        <label for="short_description.{{ $locale }}">Краткое описание</label>--}}
{{--                                        <textarea id="short_description.{{ $locale }}" name="short_description[{{ $locale }}]"  class="form-control editor_short ">@if(isset($item)) {{$item->getTranslation('short_description', $locale)}} @endif</textarea>--}}
{{--                                        <p class="help-block"></p>--}}
{{--                                    </div>--}}
                                    <div class="form-group">
                                        <label for="contents.{{ $locale }}">Содержимое *</label>
                                        <textarea id="contents.{{ $locale }}" name="contents[{{ $locale }}]"  class="form-control editor ">@if(isset($item)) {{$item->getTranslation('contents', $locale)}} @endif</textarea>
                                        <p class="help-block"></p>
                                    </div>
                                </fieldset>
{{--                                <fieldset>--}}
{{--                                    <legend>Seo настройки</legend>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="seo_title.{{ $locale }}">Meta title</label>--}}
{{--                                        <input type="text" class="form-control" id="seo_title.{{ $locale }}" name="seo_title[{{ $locale }}]" placeholder=""  @if(isset($item)) value="{{$item->getTranslation('seo_title', $locale)}}" @endif>--}}
{{--                                        <p class="help-block"></p>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="seo_description.{{ $locale }}">Meta description</label>--}}
{{--                                        <input type="text" class="form-control" id="seo_description.{{ $locale }}" name="seo_description[{{ $locale }}]" placeholder=""  @if(isset($item)) value="{{$item->getTranslation('seo_description', $locale)}}" @endif>--}}
{{--                                        <p class="help-block"></p>--}}
{{--                                    </div>--}}
{{--                                </fieldset>--}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
{{--            <fieldset>--}}
{{--                <label for="category_id">Категория</label>--}}
{{--                <select id="category_id" name="category_id" class="form-control">--}}
{{--                    <option value="">Выбрать категорию</option>--}}
{{--                    @foreach($categories as $key => $category)--}}
{{--                        <option value="{{ $key }}"--}}
{{--                                @if(isset($item) && $item->category_id == $key) selected @endif>{{ $category }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                <p class="help-block"></p>--}}
{{--            </fieldset>--}}
            <fieldset>
                <legend>Настройки</legend>
                <div class="form-group">
                    <label for="published_at">Дата публикации</label>
                    <input type="text" id="published_at" name="published_at" class="form-control dpt m-input"
                           @if(isset($item)) value="{{ date("d.m.Y H:i", strtotime($item->published_at ?? "")) }}" @endif autocomplete="off">
                    <p class="help-block"></p>
                </div>
                <div class="m-checkbox-list">
                    <label class="m-checkbox">
                        <input type="checkbox" name="site_display" @if(isset($item) && $item->site_display) checked @endif> Отображать на сайте
                        <span></span>
                    </label>
                </div>
{{--                <div class="m-checkbox-list">--}}
{{--                    <label class="m-checkbox">--}}
{{--                        <input type="checkbox" name="display_on_main_page" @if(isset($item) && $item->display_on_main_page) checked @endif> Отображать на главной--}}
{{--                        <span></span>--}}
{{--                    </label>--}}
{{--                </div>--}}
            </fieldset>
            <button type="submit" class="btn btn-sm btn-success">{{ $buttonText }}</button>
        </form>
    </div>
{{--    @if(config('news.images_uploading_support') && isset($item))--}}
{{--    <div class="col-md-4">--}}
{{--        <fieldset>--}}
{{--            <legend>Изображения</legend>--}}
{{--            <form action="{{ route(config('news.routes.media.name'), ['newsId' => $item->id]) }}"--}}
{{--                  method="post"--}}
{{--                  id="formImage">--}}
{{--                @csrf--}}
{{--                <input type="file" name="image[]" class="form-input-image-media" style="display: none"--}}
{{--                       accept="image/x-png,image/gif,image/jpeg,image/svg,image/png"--}}
{{--                       multiple>--}}
{{--                <button type="button" class="btn btn-success btn-sm add-photo">Добавить фото</button>--}}
{{--            </form>--}}
{{--            <div class="media-block">--}}
{{--                @foreach($medias as $row)--}}
{{--                    <div class="row">--}}
{{--                        @foreach($row as $media)--}}
{{--                            @include('news::media.media_item')--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </fieldset>--}}
{{--    </div>--}}
{{--    @endif--}}
</div>
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
<script>
    app.functions.initEditor();
    app.functions.initDateTimePicker();
</script>
