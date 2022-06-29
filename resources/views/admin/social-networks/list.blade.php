@foreach($items as $item)
    @include($viewItem, ['routeEdit' => $routeEdit, 'routeDelete' => $routeDelete])
@endforeach

@if(!$items->count())
    <tr>
        <td colspan="{{ $tableColumnCount }}" class="text-center">Данных не найдено</td>
    </tr>
@endif
