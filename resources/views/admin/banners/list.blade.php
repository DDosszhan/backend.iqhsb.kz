@foreach($items as $item)
    @include($config('view.item'), ['config' => $config])
@endforeach

@if(!$items->count())
    <tr>
        <td colspan="100" class="text-center">Данных не найдено</td>
    </tr>
@endif
