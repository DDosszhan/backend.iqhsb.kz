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

                    <!-- tool buttons -->
{{--                    <li class="m-portlet__nav-item">--}}
{{--                        <a href="#" data-url="{{ route($config['route']['create']) }}"--}}
{{--                           data-type="modal" data-modal="largeModal"--}}
{{--                           class="m-portlet__nav-link m-portlet__nav-link--icon handle-click"--}}
{{--                           data-container="body"--}}
{{--                           data-toggle="m-tooltip"--}}
{{--                           data-placement="top"--}}
{{--                           title="Создать">--}}
{{--                            <i class="la la-plus-circle"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                </ul>
            </div>
        </div>


        <!--begin::Section-->
        <div class="m-section">
            <div class="m-section__content">
                <table class="table table-bordered ajax-content" data-url="{{route($config('route.list'))}}">
                    <thead>
                    <tr>
                        <th width="50" class="text-center">#</th>

                        <!-- table columns -->
                        <th>Заголовок</th>
                        <th width="200">Изображение</th>
                        <th>Текст кнопки</th>
                        <th>URL кнопки</th>

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
