<tr class="row-{{ $item->id }}"  @if(isset($loop))data-index="{{$loop->iteration}}"@endif>
    <td class="text-center align-middle">{{ $item->id }}</td>

    <td class="align-middle">@isset($item->created_at){{ $item->created_at->format('Y.m.d H:i') }}@endisset</td>
    <td class="align-middle">{{ $item->last_name }}</td>
    <td class="align-middle">{{ $item->first_name }}</td>
    <td class="align-middle">{{ $item->date_of_birth }}</td>
    <td class="align-middle">{{ $item->grade }}</td>
    <td class="align-middle">{{ $item->language }}</td>
    <td class="align-middle">{{ $item->school }}</td>
    <td class="align-middle">{{ $item->phone }}</td>
    <td class="align-middle">{{ $item->email }}</td>
    <td class="align-middle">{{ $item->source }}</td>
    <td class="align-middle">{{ $item->parent_name }}</td>

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
