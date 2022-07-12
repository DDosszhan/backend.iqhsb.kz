@extends('core::layouts.master')

@section('content')
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        {{ $config('title.list') }}
                    </h3>
                </div>
            </div>

            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="#"
                           class="m-portlet__nav-link m-portlet__nav-link--icon  show-filter"
                           data-container="body"
                           data-toggle="m-tooltip"
                           data-placement="top"
                           title=""
                           data-original-title="Найти анкету">
                            <i class="la la-filter"></i>
                        </a>
                    </li>
                    <li class="m-portlet__nav-item">
                        <a href="{{ route('admin.consultation-requests.export') }}"
                           class="m-portlet__nav-link m-portlet__nav-link--icon"
                           id="export-button"
                           data-toggle="m-tooltip"
                           data-placement="top"
                           title="Импорт в Excel">
                            <i class="la la-download"></i>
                        </a>
                    </li>
                    {{--    <li class="m-portlet__nav-item">--}}
                    {{--        <a href="#" data-url="{{ route($config('route.create')) }}"--}}
                    {{--           data-type="modal" data-modal="largeModal"--}}
                    {{--           class="m-portlet__nav-link m-portlet__nav-link--icon handle-click"--}}
                    {{--           data-container="body"--}}
                    {{--           data-toggle="m-tooltip"--}}
                    {{--           data-placement="top"--}}
                    {{--           title="Создать">--}}
                    {{--            <i class="la la-plus-circle"></i>--}}
                    {{--        </a>--}}
                    {{--    </li>--}}

                </ul>
            </div>
        </div>

        <!--begin::Filters-->
        <div class="filter pad container-fluid" style="display: none; border-bottom: 1px solid #b6b6b6;">
            <form action="{{ route($config('route.list')) }}" method="post" class="filter-form"
                  data-block-element=".box-body" id="LocalizationFilterForm">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="created_at">Дата получения</label>
                            <input type="text" id="created_at" name="created_at" class="form-control dtepkr m-input" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Имя">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Телефон">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-sm">Фильтр</button>
                <a href="{{ route($config('route.index')) }}" class="btn btn-info btn-sm">Сброс</a>
            </form>
            <br>
        </div>
        <!--end::Filters-->

        <!--begin::Section-->
        <div class="m-section">
            <div class="m-section__content">
                <table class="table table-bordered ajax-content" data-url="{{route($config('route.list'))}}">
                    <thead>
                    <tr>
                        <th width="50" class="text-center">#</th>

                        <th>Дата запроса</th>
                        <th>Имя</th>
                        <th>Номер телефона</th>

                        <th class="text-center" width="100"><i class="fa fa-bars" aria-hidden="true"></i></th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="pagination_placeholder"></div>
            </div>
        </div>
        <!--end::Section-->
    </div>
@stop
