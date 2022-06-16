<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

use StarterKit\Categories\Services\CategoriesService\CategoryService;
use StarterKit\Core\Models\Media;
use StarterKit\Core\Services\MediaService\MediaService;
use StarterKit\News\Http\Requests\NewsRequest;

use StarterKit\News\Models\News;
use StarterKit\News\UseCases\NewsCase;

use StarterKit\Core\Ui\Attributes\Modal;
use StarterKit\Core\Http\Utils\ResponseBuilder;

/**
 * Class NewsController
 * @package StarterKit\Core\Http\Controllers
 */
class NewsController extends Controller
{

    private $newsCase;
    private $mediaService;
    private $categoryService;

    public function __construct(NewsCase $newsCase, CategoryService $categoryService)
    {
        $this->newsCase = $newsCase;
        $this->mediaService = new MediaService();
        $this->categoryService = $categoryService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->categoryService->categoriesForSelect('news');

        return view('admin.news.index', [
            'title' => 'Новости',
            'categories' => $categories,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getList(Request $request)
    {
        $items = $this->newsCase->order('published_at', 'desc')->getListWithDataFilter($request);

        return response()->json([
            'functions' => [
                'updateTableContent' => [
                    'params' => [
                        'selector' => '.ajax-content',
                        'content' => view('admin.news.list', [
                            'items' => $items,
                        ])->render(),
                        'pagination' => view('core::layouts.pagination', [
                            'links' => $items->appends($request->all())->links('core::pagination.bootstrap-4'),
                        ])->render(),
                    ]
                ]
            ]
        ]);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function create()
    {
        $categories = $this->categoryService->categoriesForSelect('news');

        return response()->json([
            'functions' => [
                'updateModal' => [
                    'params' => [
                        'modal' => 'superLargeModal',
                        'title' => 'Создание новости',
                        'content' => view('admin.news.form', [
                            'formAction' => route(config('news.routes.store.name')),
                            'buttonText' => 'Сохранить',
                            'categories' => $categories,
                        ])->render(),
                    ]
                ]
            ]
        ]);
    }

    public function store(NewsRequest $request)
    {
        $published = Carbon::parse($request->input('published_at'), 'Asia/Almaty')->setTimezone('UTC');

        $request->merge([
            'site_display' => ($request->has('site_display')) ? 1 : 0,
            'display_on_main_page' => ($request->has('display_on_main_page')) ? 1 : 0,
            'published_at' => $published
        ]);

        $news = $this->newsCase->store($request->all());

        if ($request->has('image')) {
            $file = $request->file('image');
            $media = $this->mediaService->upload($file, News::class, $news->id);
            $media->main_image = 1;
            $media->save();
        }

        return response()->json([
            'functions' => [
                'closeModal' => [
                    'params' => [
                        'modal' => 'superLargeModal',
                    ]
                ],
                'prependTableRow' => [
                    'params' => [
                        'selector' => '.ajax-content',
                        'content' => view('admin.news.item', ['item' => $news])->render()
                    ]
                ]
            ]
        ]);
    }

    /**
     * @param $newsId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function edit($newsId)
    {
        $item = News::with('mainImage', 'media')->find($newsId);
        $medias = $item->media->chunk(2);

        $categories = $this->categoryService->categoriesForSelect('news');

        $item = $this->newsCase->item($newsId);
        if (!$item) {
            $response = new ResponseBuilder();
            $response->showAlert('Ошибка!', 'Новость не найдена');
            $response->closeModal(Modal::LARGE);
            return $response->makeJson();
        }

        return response()->json([
            'functions' => [
                'updateModal' => [
                    'params' => [
                        'modal' => 'superLargeModal',
                        'title' => 'Редактирование новости',
                        'content' => view('admin.news.form', [
                            'formAction' => route(config('news.routes.update.name'), $newsId),
                            'buttonText' => 'Сохранить',
                            'medias' => $medias,
                            'item' => $item,
                            'categories' => $categories,
                        ])->render(),
                    ]
                ]
            ]
        ]);
    }

    public function update(NewsRequest $request, $newsId)
    {
        $published = Carbon::parse($request->input('published_at'), 'Asia/Almaty')->setTimezone('UTC');

        $request->merge([
            'site_display' => ($request->has('site_display')) ? 1 : 0,
            'display_on_main_page' => ($request->has('display_on_main_page')) ? 1 : 0,
            'published_at' => $published
        ]);

        if ($request->hasFile('image')) {
            // remove files and table entry
            $this->mediaService->deleteForModel(News::class, $newsId);
            Media::where('imageable_type', News::class)->where('imageable_id', $newsId)->delete();
            // save file and add record the table
            $file = $request->file('image');
            $media = $this->mediaService->upload($file, News::class, $newsId);
            $media->main_image = 1;
            $media->save();
        }

        $news = $this->newsCase->update($newsId, $request->all());

        return response()->json([
            'functions' => [
                'closeModal' => [
                    'params' => [
                        'modal' => 'superLargeModal',
                    ]
                ],
                'updateTableRow' => [
                    'params' => [
                        'selector' => '.ajax-content',
                        'row' => '.row-' . $newsId,
                        'content' => view('admin.news.item',['item' => $news])->render()
                    ]
                ]
            ]
        ]);
    }

    public function delete($id)
    {
        $item = $this->newsCase->item($id);

        if($item) {
            $media = $item->media->first();
            if(isset($media)){
                $this->mediaService->deleteById($item->media->first()->id);
            }
            $item->delete();
        }

        return response()->json([
            'functions' => [
                'deleteTableRow' => [
                    'params' => [
                        'selector' => '.ajax-content',
                        'row' => '.row-'.$id
                    ]
                ]
            ]
        ]);
    }

    public function media(Request $request, int $itemId)
    {
        foreach ($request->file('image') as $image) {
            $this->mediaService->upload($image, News::class, $itemId);
        }

        $items = News::find($itemId);

        return response()->json(([
            'media' => view('news::media.media_list', ['items' => $items])->render(), // DO NOT FORGET MAYBE WRONG
        ]));
    }

    public function mainMedia(int $itemId, int $mediaId)
    {
        $news = News::find($itemId);
        $this->mediaService->setMainById($mediaId, News::class, $news->id);
    }

    public function deleteMedia($mediaId)
    {
        $this->mediaService->deleteById($mediaId);
    }

    public function imageCrop($mediaId)
    {
        $media = $this->mediaService->getMedia($mediaId);

        return response()->json([
            'functions' => [
                'updateModal' => [
                    'params' => [
                        'modal' => 'editImageModal',
                        'title' => 'Обрезка изображения',
                        'content' => view('core::common.media.crop.index', [
                            'formAction' => route(config('news.routes.imageCrop.name'), ['newsId' => $media->id]),
                            'imgPath' => asset('storage/media/' . $media->getOriginal('original_file_name') . '?' . uniqid()),
                            'buttonText' => 'Сохранить',
                        ])->render(),
                    ]
                ]
            ]
        ]);
    }

    public function imageCropStore(Request $request, int $mediaId)
    {

        $media = $this->mediaServicegetMedia($mediaId);
        $path = storage_path('app/public/media/' . $media->getOriginal('original_file_name'));

        $this->mediaService->cropImage($path, $request->all());

        foreach ($media->conversions as $size => $conversion) {
            $target = storage_path('app/public/media/' .  $conversion['name']);
            $this->mediaService->resize($path, $target, $conversion['width'], $conversion['height']);
        }

        $news = News::find($media->imageable_id);

        return response()->json([
            'functions' => ['closeModal'],
            'type' => 'updateBlock',
            'blockForUpdate' => '.image-' . $mediaId,
            'blockForUpdateContent' => view('news::media.media_item', [
                'media' => $media,
                'items' => $news
            ])->render(),
            'modal_for_close' => 'editImageModal',

        ]);
    }
}
