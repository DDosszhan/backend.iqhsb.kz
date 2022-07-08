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
{{--                        <a href="#" data-url="{{ route($config('route.create')) }}"--}}
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

        <div class="m-portlet__body">
            @include($config('view.form'), [
                'formAction' => $formAction,
                'buttonSubmit' => $config('button.create'),
                'blocks' => $blocks,
            ])
        </div>

    </div>
@stop
