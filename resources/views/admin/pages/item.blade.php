<tr class="row-{{ $item->id }}"  @if(isset($loop))data-index="{{$loop->iteration}}"@endif>
    <td class="text-center align-middle">{{ $item->id }}</td>

    <td class="align-middle">{{ $item->title }}</td>

    <td class="text-center align-middle">
        <a href="#" data-url="{{ route($config('route.edit'), ['id' => $item->id ]) }}" class="handle-click" data-type="modal" data-modal="largeModal">
            <i class="la la-edit"></i>
        </a>

        @if ($item->settings['removable'])
            <a href="#" class="handle-click" data-type="confirm"
               title="Удалить"
               data-title="Удаление"
               data-message="Вы уверены, что хотите удалить?"
               data-cancel-text="Нет"
               data-confirm-text="Да, удалить" data-url="{{ route($config('route.delete'), ['id' => $item->id ]) }}">
                <i class="la la-trash"></i>
            </a>
        @endif
    </td>
</tr>
