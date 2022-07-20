<tr class="row-{{ $item->id }}"  @if(isset($loop))data-index="{{$loop->iteration}}"@endif>
    <td class="text-center align-middle">{{ $item->id }}</td>

    <td class="align-middle">{{ $item->graduate_name }}</td>
    <td class="align-middle">
        @if(isset($item) && $item->getFirstMedia('default'))
            <img width="100" src="{{ $item->getFirstMedia('default')->getFullUrl() }}">
        @else
            <img width="100" src="/core/adminLTE/assets/app/media/img/error/noimage.png">
        @endif
    </td>
    <td class="align-middle">
        @if(isset($item) && $item->university)
            {{ $item->university->name }}
        @else
            -
        @endif
    </td>
    <td class="align-middle">{{ $item->year }}</td>
    <td class="align-middle">{{ $item->city }}</td>
    <td class="align-middle text-center">
        <a href="#" data-url="{{route('admin.graduate-achievements.up', ['id' => $item->id])}}" data-type="up" class="change-position"><i class="la la-sort-up"></i></a>
        <a href="#" data-url="{{route('admin.graduate-achievements.down', ['id' => $item->id])}}" data-type="down" class="change-position"><i class="la la-sort-down"></i></a>
    </td>

    <td class="text-center align-middle">
        <a href="#" data-url="{{ route($config('route.edit'), ['id' => $item->id ]) }}" class="handle-click" data-type="modal" data-modal="largeModal">
            <i class="la la-edit"></i>
        </a>

        <a href="#" class="handle-click" data-type="confirm"
           title="Удалить"
           data-title="Удаление"
           data-message="Вы уверены, что хотите удалить?"
           data-cancel-text="Нет"
           data-confirm-text="Да, удалить" data-url="{{ route($config('route.delete'), ['id' => $item->id ]) }}">
            <i class="la la-trash"></i>
        </a>
    </td>
</tr>
