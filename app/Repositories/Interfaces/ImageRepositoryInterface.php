<?php

namespace App\Repositories\Interfaces;

interface ImageRepositoryInterface
{
    public function getImage($slug);

    public function getImageByUser($user_id);

    public function updateLike($request, $user_id);

    public function updateShare($request, $user_id);

    public function updateDownload($image);

    public function getMostLikeImage();

    public function getMostLikeImagePaginate($paginate);

    public function getMostDownloadImage();

    public function getMostDownloadImagePaginate($paginate);

    public function getRelatedImage($image_id, $user_id);

    public function checkLiked($image, $user_id);

    public function checkShared($image, $user_id);

    public function getSearch($request);

    public function getAdminSearch($query);

    public function saveUpload($request, $user_id);

    public function getImageFavorite($user_id);
}
