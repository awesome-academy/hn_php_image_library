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
    protected $categoryRepository;

    protected $imageRepository;

    protected $followRepository;

    protected $commentRepository;

    protected $userRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ImageRepositoryInterface $imageRepository,
        FollowRepositoryInterface $followRepository,
        CommentRepositoryInterface $commentRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->imageRepository = $imageRepository;
        $this->followRepository = $followRepository;
        $this->commentRepository = $commentRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $subcategories = $this->categoryRepository->getAllSubcategory();
        $like_images = $this->imageRepository->getMostLikeImage();
        $download_images = $this->imageRepository->getMostDownloadImage();
        $follow_users = [];
        if (Auth::check()) {
            $follow_users = $this->followRepository->getUserFollow(Auth::id());
        }

        return view('frontend.home', [
            'subcategories' => $subcategories,
            'like_images' => $like_images,
            'download_images' => $download_images,
            'follow_users' => $follow_users,
        ]);
    }

    public function category()
    {
        $categories = $this->categoryRepository->getAllCategory();

        return view('frontend.category', ['categories' => $categories]);
    }

    public function subcategory(Request $request)
    {
        $data = $this->categoryRepository->getImageBySubcategory($request['slug']);

        return view('frontend.subcategory', [
            'category' => $data['category'] ?? [],
            'subcategories' => $data['subcategories'] ?? [],
        ]);
    }

    public function image(Request $request)
    {
        $image = $this->imageRepository->getImage($request['slug']);
        $comments = $this->commentRepository->getComment($image['id'] ?? null);
        $related_images = $this->imageRepository->getRelatedImage(
            $image['id'] ?? null,
            $image['user_id'] ?? null
        );
        $liked = false;
        $addtofavorite = false;
        if (Auth::check()) {
            $liked = $this->imageRepository->checkLiked($image, Auth::id());
            $addtofavorite = $this->imageRepository->checkShared($image, Auth::id());
        }

        return view('frontend.image', [
            'image' => $image,
            'comments' => $comments,
            'liked' => $liked,
            'addtofavorite' => $addtofavorite,
            'related_images' => $related_images,
        ]);
    }

    public function download(Request $request)
    {

        $image = $this->imageRepository->getImage($request['slug']);

        return $this->imageRepository->download($image);
    }

    public function search(Request $request)
    {
        $images = $this->imageRepository->getSearch($request);

        return view('frontend.search', [
            'images' => $images,
        ]);
    }

    public function user(Request $request)
    {
        $user = $this->userRepository->getUser($request['id']);
        $images = $this->imageRepository->getImageByUser($user['id'] ?? null);
        $followed = false;
        if (Auth::check()) {
            $followed = $this->followRepository->checkFollowed(Auth::id(), $user['id'] ?? null);
        }

        return view('frontend.user', [
            'user' => $user,
            'images' => $images,
            'followed' => $followed,
        ]);
    }

    public function viewall(Request $request)
    {
        $type = $request['type'];
        $follow_users = [];
        $images = [];
        switch ($type) {
            case 'followed-user':
                if (Auth::check()) {
                    $user_count = config('project.home_user_count');
                    $follow_users = $this->followRepository->getUserFollowPaginate(Auth::id(), $user_count);
                }
                break;
            case 'most-download':
                $images = $this->imageRepository->getMostDownloadImagePaginate(config('project.search_image_count'));
                break;
            case 'most-like':
                $images = $this->imageRepository->getMostLikeImagePaginate(config('project.search_image_count'));
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
