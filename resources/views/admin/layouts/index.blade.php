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
                    @yield('tools_buttons')
                </ul>
            </div>
        </div>


        <!--begin::Section-->
        <div class="m-section">
            <div class="m-section__content">
                <table class="table table-bordered ajax-content" data-url="{{route($routeList)}}">
                    <thead>
                    <tr>
                        <th width="50" class="text-center">#</th>
                        @yield('table_head')
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
