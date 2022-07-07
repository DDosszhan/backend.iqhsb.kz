<tr class="row-{{ $item->id }}"  @if(isset($loop))data-index="{{$loop->iteration}}"@endif>
    <td class="text-center align-middle">{{ $item->id }}</td>

    <td class="align-middle">{{ $item->slug }}</td>
    <td class="align-middle">
        @if(isset($item) && $item->getFirstMedia('default'))
            <img width="100" src="{{ $item->getFirstMedia('default')->getFullUrl() }}">
        @else
            <img width="100" src="/core/adminLTE/assets/app/media/img/error/noimage.png">
        @endif
    </td>
    <td class="align-middle">{{ $item->title }}</td>
    <td class="align-middle">{{ $item->button_text }}</td>
    <td class="align-middle">{{ $item->button_url }}</td>

    <td class="text-center align-middle">
        <a href="#" data-url="{{ route($config('route.edit'), ['id' => $item->id ]) }}" class="handle-click" data-type="modal" data-modal="largeModal">
            <i class="la la-edit"></i>
        </a>

{{--        <a href="#" class="handle-click" data-type="confirm"--}}
{{--           title="Удалить"--}}
{{--           data-title="Удаление"--}}
{{--           data-message="Вы уверены, что хотите удалить?"--}}
{{--           data-cancel-text="Нет"--}}
{{--           data-confirm-text="Да, удалить" data-url="{{ route($routeDelete, ['id' => $item->id ]) }}">--}}
{{--            <i class="la la-trash"></i>--}}
{{--        </a>--}}
    </td>
</tr>
