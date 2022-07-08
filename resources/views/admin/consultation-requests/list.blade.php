@foreach($items as $item)
    @include($config('view.item'), ['routeEdit' => $config('route.edit'), 'routeDelete' => $config('route.delete')])
@endforeach

@if(!$items->count())
    <tr>
        <td colspan="{{ $tableColumnCount }}" class="text-center">Данных не найдено</td>
    </tr>
@endif
