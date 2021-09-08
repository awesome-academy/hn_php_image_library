<?php

namespace App\Repositories\Eloquent;

use App\Helpers\DataHelper;
use App\Models\Image;
use App\Repositories\Interfaces\ImageRepositoryInterface;

class ImageRepository implements ImageRepositoryInterface
{
    public function updateLike($request, $user_id)
    {
        $image = Image::where('slug', $request['slug'])->firstOrFail();
        $liked = $this->checkLiked($image, $user_id);
        $like_count = $image->like - 1;
        if ($liked) {
            if ($like_count < 0) {
                $image->update(['like' => 0]);
            } else {
                $image->update(['like' => $like_count]);
            }
            $image->likes()->detach($user_id);

            return $like_count;
        }
        $like_count = $image->like + 1;
        $image->update(['like' => $like_count]);
        $image->likes()->attach($user_id);

        return $like_count;
    }

    public function updateShare($request, $user_id)
    {
        $image = Image::where('slug', $request['slug'])->firstOrFail();
        $shared = $this->checkShared($image, $user_id);
        if ($shared) {
            $image->shares()->detach($user_id);
        } else {
            $image->shares()->attach($user_id);
        }

        return $shared;
    }

    public function getMostLikeImage()
    {
        return Image::orderBy('like', 'DESC')
            ->orderBy('updated_at', 'DESC')
            ->limit(config('project.feature_image_count'))
            ->get();
    }

    public function getMostDownloadImage()
    {
        return Image::orderBy('download', 'DESC')
            ->orderBy('updated_at', 'DESC')
            ->limit(config('project.feature_image_count'))
            ->get();
    }

    public function getImage($slug)
    {
        return Image::where('slug', $slug)
            ->with('user')->firstOrFail();
    }

    public function getRelatedImage($image_id, $user_id)
    {
        return Image::where('id', '!=', $image_id)
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->limit(config('project.related_image_count'))->get();
    }

    public function checkLiked($image, $user_id)
    {
        return $image->likes()->where('id', $user_id)->exists();
    }

    public function checkShared($image, $user_id)
    {
        return $image->shares()->where('id', $user_id)->exists();
    }

    public function updateDownload($image)
    {
        return $image->update(['download' => $image->download + 1]);
    }

    public function getSearch($request)
    {
        $q = $request['q'];
        $images = Image::where(function ($query) use ($q) {
            $query->where('name', 'LIKE', '%' . $q . '%')
                ->orWhere('description', 'LIKE', '%' . $q . '%');
        });
        if (isset($request['subcate'])) {
            $images->where('category_id', $request['subcate']);
        }

        return $images->paginate(config('project.search_image_count'));
    }

    public function getAdminSearch($query)
    {
        return Image::where(function ($q) use ($query) {
            $q->where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('description', 'LIKE', '%' . $query . '%');
        })->with('user')->paginate(config('project.admin_page_count'));
    }

    public function getImageByUser($user_id)
    {
        return Image::where('user_id', $user_id)
            ->orderBy('created_at', 'DESC')
            ->paginate(config('project.user_image_count'));
    }

    public function saveUpload($request, $user_id)
    {
        if ($request->hasFile('filepload')) {
            $original = DataHelper::getAsset($request, 'original');
            $thumb = DataHelper::getAsset($request, 'thumbs');

            return Image::create(array_merge($request->all(), [
                'slug' => DataHelper::getSlug($request['name']),
                'category_id' => $request['category_id'],
                'user_id' => $user_id,
                'original_link' => $original,
                'thumb_link' => $thumb,
                'download' => 0,
                'like' => 0,
            ]));
        }
    }

    public function getImageFavorite($user_id)
    {
        return Image::whereHas('shares', function ($q) use ($user_id) {
            $q->where('user_share.user_id', $user_id);
        })->get();
    }

    public function getMostLikeImagePaginate($paginate)
    {
        return Image::orderBy('like', 'DESC')
            ->orderBy('updated_at', 'DESC')
            ->paginate($paginate);
    }

    public function getMostDownloadImagePaginate($paginate)
    {
        return Image::orderBy('download', 'DESC')
            ->orderBy('updated_at', 'DESC')
            ->paginate($paginate);
    }
}
