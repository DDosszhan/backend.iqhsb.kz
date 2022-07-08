@foreach($items as $item)
    @include($config('view.item'))
@endforeach

@if(!$items->count())
    <tr>
        <td colspan="{{ $tableColumnCount }}" class="text-center">Данных не найдено</td>
    </tr>
@endif
