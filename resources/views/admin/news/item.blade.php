<tr class="row-{{ $item->id }}"  @if(isset($loop))data-index="{{$loop->iteration}}"@endif>
    <td class="text-center align-middle">{{ $item->id }}</td>

    <td class="align-middle">{{ $item->title }}</td>
{{--    @if(isset($item->category))--}}
{{--        <td class="text-center align-middle">{{ $item->category->getTranslation('name', config('project.locales')[0]) }}</td>--}}
{{--    @else--}}
{{--        <td class="text-center align-middle">-</td>--}}
{{--    @endif--}}
    @if(config('news.images_uploading_support'))
        <td class="text-center align-middle">
            @if(isset($item->mainImage))
                <img src="{{$item->mainImage->conversions['xxs']['url'] }}" alt="">
            @else
                Изображение отсутствует
            @endif
        </td>
    @endif
    <td class="text-center align-middle">
        <i class="la la-power-off" style="color:@if($item->site_display) green; @else red;@endif"></i>
    </td>
    <td class="text-center align-middle">{{ date('d.m.Y H:i', strtotime($item->published_at ?? "")) }}</td>
    <td class="text-center align-middle">
        <a href="#" data-url="{{ route('admin.news.edit', ['id' => $item->id ]) }}" class="handle-click" data-type="modal" data-modal="superLargeModal">
            <i class="la la-edit"></i>
        </a>

        <a href="#" class="handle-click" data-type="confirm"
           title="Удалить новость"
           data-title="Удаление"
           data-message="Вы уверены, что хотите удалить новость?"
           data-cancel-text="Нет"
           data-confirm-text="Да, удалить" data-url="{{ route('admin.news.delete', ['id' => $item->id ]) }}">
            <i class="la la-trash"></i>
        </a>
    </td>
</tr>
