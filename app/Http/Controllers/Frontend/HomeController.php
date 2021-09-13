<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\FollowRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(
        CategoryRepositoryInterface $categoryRepository,
        ImageRepositoryInterface $imageRepository,
        FollowRepositoryInterface $followRepository
    ) {
        $subcategories = $categoryRepository->getAllSubcategory();
        $like_images = $imageRepository->getMostLikeImage();
        $download_images = $imageRepository->getMostDownloadImage();
        $follow_users = [];
        if (Auth::check()) {
            $follow_users = $followRepository->getUserFollow(Auth::user()->getAuthIdentifier());
        }

        return view('frontend.home', [
            'subcategories' => $subcategories,
            'like_images' => $like_images,
            'download_images' => $download_images,
            'follow_users' => $follow_users,
        ]);
    }

    public function category(CategoryRepositoryInterface $categoryRepository)
    {
        $categories = $categoryRepository->getAllCategory();

        return view('frontend.category', ['categories' => $categories]);
    }

    public function subcategory(Request $request, CategoryRepositoryInterface $categoryRepository)
    {
        $data = $categoryRepository->getImageBySubcategory($request['slug']);

        return view('frontend.subcategory', [
            'category' => $data['category'],
            'subcategories' => $data['subcategories'],
        ]);
    }

    public function image(
        ImageRepositoryInterface $imageRepository,
        CommentRepositoryInterface $commentRepository,
        Request $request
    ) {
        $image = $imageRepository->getImage($request['slug']);
        $comments = $commentRepository->getComment($image['id']);
        $related_images = $imageRepository->getRelatedImage($image['id'], $image['user_id']);
        $liked = false;
        $addtofavorite = false;
        if (Auth::check()) {
            $liked = $imageRepository->checkLiked($image, Auth::user()->getAuthIdentifier());
            $addtofavorite = $imageRepository->checkShared($image, Auth::user()->getAuthIdentifier());
        }

        return view('frontend.image', [
            'image' => $image,
            'comments' => $comments,
            'liked' => $liked,
            'addtofavorite' => $addtofavorite,
            'related_images' => $related_images,
        ]);
    }

    public function download(ImageRepositoryInterface $imageRepository, Request $request)
    {
        $image = $imageRepository->getImage($request['slug']);
        if (!$image) {
            return redirect()->back();
        }
        $imageRepository->updateDownload($image);
        $filename = $image['name'];
        $tempImage = tempnam(sys_get_temp_dir(), $filename);
        copy(asset($image['original_link']), $tempImage);

        return response()->download($tempImage, $filename);
    }

    public function search(ImageRepositoryInterface $imageRepository, Request $request)
    {
        $images = $imageRepository->getSearch($request);

        return view('frontend.search', [
            'images' => $images,
        ]);
    }

    public function user(
        ImageRepositoryInterface $imageRepository,
        UserRepositoryInterface $userRepository,
        FollowRepositoryInterface $followRepository,
        Request $request
    ) {
        $user = $userRepository->getUser($request['id']);
        $images = $imageRepository->getImageByUser($user['id']);
        $followed = false;
        if (Auth::check()) {
            $followed = $followRepository->checkFollowed(Auth::user()->getAuthIdentifier(), $user['id']);
        }

        return view('frontend.user', [
            'user' => $user,
            'images' => $images,
            'followed' => $followed,
        ]);
    }

    public function viewall(
        ImageRepositoryInterface $imageRepository,
        FollowRepositoryInterface $followRepository,
        Request $request
    ) {
        $type = $request['type'];
        $follow_users = [];
        $images = [];
        switch ($type) {
            case 'followed-user':
                if (Auth::check()) {
                    $user_id = Auth::user()->getAuthIdentifier();
                    $user_count = config('project.home_user_count');
                    $follow_users = $followRepository->getUserFollowPaginate($user_id, $user_count);
                }
                break;
            case 'most-download':
                $images = $imageRepository->getMostDownloadImagePaginate(config('project.search_image_count'));
                break;
            case 'most-like':
                $images = $imageRepository->getMostLikeImagePaginate(config('project.search_image_count'));
                break;
            default:
                break;
        }

        return view('frontend.viewall', [
            'follow_users' => $follow_users,
            'images' => $images,
        ]);
    }
}
