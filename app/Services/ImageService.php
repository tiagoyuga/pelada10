<?php
/**
 * Criado por TTeixeira
 * Tiago Teixeira de Sousa tiagoteixeira2214@gmail.com
 * Date: 17/12/2019
 * Time: 17:01:54
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\Image;
use App\Models\Product;
use App\Rlustosa\GenericImageUpload;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ImageService
{

    public function paginate(int $limit): LengthAwarePaginator
    {

        return $this->buildQuery()->paginate($limit);
    }

    private function buildQuery(): Builder
    {

        $query = Image::query();

        $query->when(request('id'), function ($query, $id) {

            return $query->whereId($id);
        });

        $query->when(request('search'), function ($query, $search) {

            return $query->where('id', 'LIKE', '%' . $search . '%');
        });

        return $query->orderBy('name');
    }

    public function all(): Collection
    {

        return $this->buildQuery()->get();
    }

    public function find(int $id): ?Image
    {

        //return Cache::remember('Image_find_' . $id, config('cache.cache_time'), function () use ($id) {
        return Image::find($id);
        //});
    }

    public function create(array $data): Image
    {

        return DB::transaction(function () use ($data) {

            $model = new Image();
            $model->fill($data);
            $model->save();

            return $model;
        });
    }

    public function update(array $data, Image $model): Image
    {
        $model->fill($data);
        #$model->user_updater_id = \Auth::id();
        $model->save();

        return $model;
    }

    public function delete(Image $model): ?bool
    {
        #$model->user_eraser_id = \Auth::id();
        $model->save();

        return $model->delete();
    }

    public function lists(): array
    {
        //return Cache::remember('Image_lists', config('cache.cache_time'), function () {

        return Image::orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
        //});
    }

    public function productMainImage(Product $product, Image $image): bool
    {
        #$model->user_eraser_id = \Auth::id();

        $images = Image::whereProductId($product->id);
        $images->update(['main' => 0]);
        $images->whereId($image->id)->update(['main' => 1]);

        return (Bool)$images;
    }

    public function deleteImage(Product $product, Image $image): bool
    {
        if ($image->main) {
            $newImageMain = Image::where('id', '<>', $image->id)->whereProductId($product->id)->first();
            if($newImageMain) $newImageMain->update(['main' => 1]);
        }

        #$model->user_eraser_id = \Auth::id();
        return (Bool)Image::whereId($image->id)->whereProductId($product->id)->delete();
    }

    public function storeImage(array $data, Product $product): Collection
    {
        $main = Image::where('product_id', '=', $product->id)->whereMain('1')->count();
        //if (!$main > 0) $main = 1;
        $main = ($main > 0) ? 0 : 1;

        if (isset($data['files'])) {

            foreach ($data['files'] as $image) {

                $newImage = $this->upload($image);

                Image::create([
                    'product_id' => $product->id,
                    'image' => $newImage,
                    'main' => $main,
                ]);

                if ($main > 0) {
                    $main = 0;
                }
            }
        }

        return Image::where('product_id', '=', $product->id)->get(['id', 'product_id', 'name', 'image', 'main']);
    }

    /**
     * @param null $files
     * @return string|null
     */
    private function upload($files = null): ?string
    {

        $images = $files ? $files : request()->file('image');

        if ($images) {

            return 'images/' . GenericImageUpload::store($images, 'images');

        } else {

            return null;
        }
    }

    public function getImages(Product $product): Collection
    {
        return Image::where('product_id', '=', $product->id)
            ->orderByDesc('main')
            ->get(['id', 'product_id', 'name', 'image', 'main']);
    }
}
