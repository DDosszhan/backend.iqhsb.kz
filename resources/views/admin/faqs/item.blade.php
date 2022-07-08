<tr class="row-{{ $item->id }}"  @if(isset($loop))data-index="{{$loop->iteration}}"@endif>
    <td class="text-center align-middle">{{ $item->id }}</td>

    <td class="align-middle">{{ $item->question }}</td>
    <td class="align-middle">{{ $item->answer }}</td>
    <td class="align-middle text-center">
        <i class="la la-power-off" style="color:@if($item->active) green; @else red;@endif"></i>
    </td>
    <td class="align-middle text-center">
        <a href="#" data-url="{{route('admin.faqs.up', ['id' => $item->id])}}" data-type="up" class="change-position"><i class="la la-sort-up"></i></a>
        <a href="#" data-url="{{route('admin.faqs.down', ['id' => $item->id])}}" data-type="down" class="change-position"><i class="la la-sort-down"></i></a>
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
