<tr class="row-{{ $item->id }}"  @if(isset($loop))data-index="{{$loop->iteration}}"@endif>
    <td class="text-center align-middle">{{ $item->id }}</td>

    <td class="align-middle">{{ $item->title }}</td>
    <td class="text-center align-middle">
        @if(isset($item) && $item->getFirstMedia('default'))
            <img width="100" src="{{ $item->getFirstMedia('default')->getFullUrl() }}">
        @else
            <img width="100" src="/core/adminLTE/assets/app/media/img/error/noimage.png">
        @endif
    </td>
    <td class="text-center align-middle">
        <i class="la la-power-off" style="color:@if($item->active) green; @else red;@endif"></i>
    </td>
    <td class="text-center align-middle">{{ date('d.m.Y H:i', strtotime($item->published_at ?? "")) }}</td>

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
