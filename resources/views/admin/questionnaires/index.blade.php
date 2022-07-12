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
                           data-original-title="Найти новость">
                            <i class="la la-filter"></i>
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
                            <label for="last_name">Фамилия</label>
                            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Фамилия">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first_name">Имя</label>
                            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Имя">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_birth">Дата рождения</label>
                            <input type="text" id="date_of_birth" name="date_of_birth" class="form-control dtepkr m-input" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="grade">Школа</label>
                            <select id="grade" name="grade" class="form-control">
                                <option value="">Не выбрано</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="language">Язык</label>
                            <select id="language" name="language" class="form-control">
                                <option value="">Не выбрано</option>
                                <option value="Русский">Русский</option>
                                <option value="Казахский">Казахский</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Телефон">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="E-mail">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="source">Источник</label>
                            <select id="source" name="source" class="form-control">
                                <option value="">Не выбрано</option>
                                <option value="Сайт школы">Сайт школы</option>
                                <option value="Социальные сети">Социальные сети</option>
                                <option value="От знакомых/родственников">От знакомых/родственников</option>
                                <option value="Другое">Другое</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="parent_name">ФИО представителя</label>
                            <input type="text" name="parent_name" class="form-control" id="parent_name" placeholder="ФИО представителя">
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

                        <th>Дата получения</th>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Дата рождения</th>
                        <th>Класс</th>
                        <th>Язык</th>
                        <th>Школа</th>
                        <th>Телефон</th>
                        <th>Email</th>
                        <th>Источник</th>
                        <th>ФИО родителя / законного представителя</th>

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
