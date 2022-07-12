<tr class="row-{{ $item->id }}"  @if(isset($loop))data-index="{{$loop->iteration}}"@endif>
    <td class="text-center align-middle">{{ $item->id }}</td>

    <td class="align-middle">@isset($item->created_at){{ $item->created_at->format('d.m.Y H:i') }}@endisset</td>
    <td class="align-middle">{{ $item->name }}</td>
    <td class="align-middle">{{ $item->phone }}</td>

    <td class="text-center aliggn-middle">
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
