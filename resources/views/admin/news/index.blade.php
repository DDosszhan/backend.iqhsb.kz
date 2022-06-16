@extends('core::layouts.master')

@section('content')
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        {{ $title }}
                    </h3>
                </div>
            </div>

            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
{{--                    <li class="m-portlet__nav-item">--}}
{{--                        <a href="#"--}}
{{--                           class="m-portlet__nav-link m-portlet__nav-link--icon  show-filter"--}}
{{--                           data-container="body"--}}
{{--                           data-toggle="m-tooltip"--}}
{{--                           data-placement="top"--}}
{{--                           title=""--}}
{{--                           data-original-title="Найти новость">--}}
{{--                            <i class="la la-filter"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="m-portlet__nav-item">--}}
{{--                        <a href="#"--}}
{{--                           data-type="modal"--}}
{{--                           data-modal="largeModal"--}}
{{--                           data-url="{{ route('admin.categories.create', ['owner' => 'news']) }}"--}}
{{--                           class="m-portlet__nav-link m-portlet__nav-link--icon  handle-click"--}}
{{--                           data-container="body" data-toggle="m-tooltip" data-placement="top"--}}
{{--                           title="" data-original-title="Категории">--}}
{{--                            <i class="la la-clipboard"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li class="m-portlet__nav-item">
                        <a href="#" data-url="{{ route('admin.news.create') }}"
                           data-type="modal" data-modal="superLargeModal"
                           class="m-portlet__nav-link m-portlet__nav-link--icon handle-click"
                           data-container="body"
                           data-toggle="m-tooltip"
                           data-placement="top"
                           title="Создать новость">
                            <i class="la la-plus-circle"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!--begin::Filters-->
        <div class="filter pad container-fluid" style="display: none; border-bottom: 1px solid #b6b6b6;">
            <form action="{{ route('admin.news.list') }}" method="post" class="filter-form"
                  data-block-element=".box-body" id="LocalizationFilterForm">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label for="title">Заголовок новости</label>
                            <input type="text" name="title" class="form-control" id="title"
                                   placeholder="Заголовок новости">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label for="slug">Машинное имя</label>
                            <input type="text" name="slug" class="form-control" id="slug"
                                   placeholder="Машинное имя">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label for="contents">Содержание новости</label>
                            <input type="text" name="contents" class="form-control" id="contents"
                                   placeholder="Содержание новости">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label for="published_at">Дата публикации</label>
                            <input type="text" id="published_at" name="published_at" class="form-control dtepkr m-input" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label for="created_at">Дата создания</label>
                            <input type="text" id="created_at" name="created_at" class="form-control dtepkr m-input" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label for="updated_at">Дата обновления</label>
                            <input type="text" id="updated_at" name="updated_at" class="form-control dtepkr m-input" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label for="contents">Категория</label>
                            <select id="category_id" name="category_id" class="form-control">
                                <option value="">Выбрать категорию</option>
                                @foreach($categories as $key => $category)
                                    <option value="{{ $key }}"
                                            @if(isset($item) && $item->category_id == $key) selected @endif>{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label for="contents">Активен</label>
                            <select id="site_display" name="site_display" class="form-control">
                                <option value="">Не выбрано</option>
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-sm">Фильтр</button>
                <a href="{{ route('admin.news') }}" class="btn btn-info btn-sm">Сброс</a>
            </form>
            <br>
        </div>
        <!--end::Filters-->


        <!--begin::Section-->
        <div class="m-section">
            <div class="m-section__content">
                <table class="table table-bordered ajax-content"
                       data-url="{{ route('admin.news.list') }}">
                    <thead>
                    <tr>
                        <th class="text-center" width="50">#</th>
                        <th>Название</th>
{{--                        <th width="200" class="text-center">Категория</th>--}}
                        @if(config('news.images_uploading_support'))
                            <th  class="text-center">Картинка</th>
                        @endif
                        <th width="70" class="text-center">Активен</th>
                        <th class="text-center" width="120">Дата публикации</th>
                        <th class="text-center" width="100"><i class="fa fa-bars" aria-hidden="true"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                <div class="pagination_placeholder"></div>
            </div>
        </div>
        <!--end::Section-->
    </div>
@stop


