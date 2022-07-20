@extends('admin.layouts.index')

@section('tools_buttons')
    <li class="m-portlet__nav-item">
        <a href="#" data-url="{{ route($config('route.create')) }}"
           data-type="modal" data-modal="largeModal"
           class="m-portlet__nav-link m-portlet__nav-link--icon handle-click"
           data-container="body"
           data-toggle="m-tooltip"
           data-placement="top"
           title="Создать">
            <i class="la la-plus-circle"></i>
        </a>
    </li>
@endsection

@section('table_head')
    <th>Вопрос</th>
    <th>Активен</th>
    <th width="100" class="text-center"><i class="la la-sort-amount-asc"></i></th>
{{--    <th>Порядок</th>--}}
@endsection

@push('modules')
    <script src="/faq/js/sortManagement.js" type="text/javascript"></script>
@endpush
