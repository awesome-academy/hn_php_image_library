<?php

namespace Tests\Unit\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\HomeController;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\FollowRepositoryInterface;
use App\Traits\Test\TestController;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Mockery as m;

class HomeControllerTest extends TestCase
{
    use TestController;

    protected $categoryRepositoryMock;

    protected $userRepositoryMock;

    protected $followRepositoryMock;

    protected $commentRepositoryMock;

    protected $imageRepositoryMock;

    protected $homeController;

    protected function setUp(): void
    {
        $this->afterApplicationCreated(function () {
            $this->imageRepositoryMock = m::mock(ImageRepositoryInterface::class);
            $this->categoryRepositoryMock = m::mock(CategoryRepositoryInterface::class);
            $this->userRepositoryMock = m::mock(UserRepositoryInterface::class);
            $this->commentRepositoryMock = m::mock(CommentRepositoryInterface::class);
            $this->followRepositoryMock = m::mock(FollowRepositoryInterface::class);
            $this->homeController = new HomeController(
                $this->categoryRepositoryMock,
                $this->imageRepositoryMock,
                $this->followRepositoryMock,
                $this->commentRepositoryMock,
                $this->userRepositoryMock
            );
        });
        parent::setUp();
    }

    protected function tearDown(): void
    {
        m::close();
        unset($this->homeController);
        parent::tearDown();
    }

    public function testIndexAuthenticatedFunction()
    {
        $id = 1;
        $this->categoryRepositoryMock->shouldReceive('getAllSubcategory');
        $this->imageRepositoryMock->shouldReceive('getMostLikeImage');
        $this->imageRepositoryMock->shouldReceive('getMostDownloadImage');
        $this->followRepositoryMock->shouldReceive('getUserFollow');
        $this->be($this->makeUser($id));
        $result = $this->homeController->index();
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('frontend.home', $result->getName());
        $this->assertArrayHasKey('subcategories', $data);
        $this->assertArrayHasKey('like_images', $data);
        $this->assertArrayHasKey('download_images', $data);
        $this->assertArrayHasKey('follow_users', $data);
    }

    public function testIndexUnauthenticatedFunction()
    {
        $this->categoryRepositoryMock->shouldReceive('getAllSubcategory');
        $this->imageRepositoryMock->shouldReceive('getMostLikeImage');
        $this->imageRepositoryMock->shouldReceive('getMostDownloadImage');
        $this->followRepositoryMock->shouldReceive('getUserFollow');
        $result = $this->homeController->index();
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('frontend.home', $result->getName());
        $this->assertArrayHasKey('subcategories', $data);
        $this->assertArrayHasKey('like_images', $data);
        $this->assertArrayHasKey('download_images', $data);
        $this->assertArrayHasKey('follow_users', $data);
    }

    public function testCategoryFunction()
    {
        $this->categoryRepositoryMock->shouldReceive('getAllCategory');
        $result = $this->homeController->category();
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('frontend.category', $result->getName());
        $this->assertArrayHasKey('categories', $data);
    }

    public function testSubcategoryFunction()
    {
        $this->categoryRepositoryMock->shouldReceive('getImageBySubcategory');
        $result = $this->homeController->subcategory(new Request(['slug' => 'image1']));
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('frontend.subcategory', $result->getName());
        $this->assertArrayHasKey('category', $data);
        $this->assertArrayHasKey('subcategories', $data);
    }

    public function testImageAuthenticatedFunction()
    {
        $id = 1;
        $this->imageRepositoryMock->shouldReceive('getImage');
        $this->commentRepositoryMock->shouldReceive('getComment');
        $this->imageRepositoryMock->shouldReceive('getRelatedImage');
        $this->be($this->makeUser($id));
        $this->imageRepositoryMock->shouldReceive('checkLiked');
        $this->imageRepositoryMock->shouldReceive('checkShared');
        $result = $this->homeController->image(new Request(['slug' => 'image1']));
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('frontend.image', $result->getName());
        $this->assertArrayHasKey('image', $data);
        $this->assertArrayHasKey('comments', $data);
        $this->assertArrayHasKey('liked', $data);
        $this->assertArrayHasKey('addtofavorite', $data);
        $this->assertArrayHasKey('related_images', $data);
    }

    public function testImageUnauthenticatedFunction()
    {
        $id = 1;
        $this->imageRepositoryMock->shouldReceive('getImage');
        $this->commentRepositoryMock->shouldReceive('getComment');
        $this->imageRepositoryMock->shouldReceive('getRelatedImage');
        $this->be($this->makeUser($id));
        $this->imageRepositoryMock->shouldReceive('checkLiked');
        $this->imageRepositoryMock->shouldReceive('checkShared');
        $result = $this->homeController->image(new Request(['slug' => 'image1']));
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('frontend.image', $result->getName());
        $this->assertArrayHasKey('image', $data);
        $this->assertArrayHasKey('comments', $data);
        $this->assertArrayHasKey('liked', $data);
        $this->assertArrayHasKey('addtofavorite', $data);
        $this->assertArrayHasKey('related_images', $data);
    }

    public function testDownloadFunction()
    {
        $image = $this->makeImage(1, 1);
        $this->imageRepositoryMock->shouldReceive('getImage')->andReturn($image);
        $this->imageRepositoryMock->shouldReceive('download')->andReturn(response()->json([], 200));
        $result = $this->homeController->download(new Request(['slug' => $image['slug']]));
        $this->assertEquals(200, $result->getStatusCode());
    }

    public function testSearchFunction()
    {
        $this->imageRepositoryMock->shouldReceive('getSearch');
        $result = $this->homeController->search(new Request(['slug' => 'image1']));
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('frontend.search', $result->getName());
        $this->assertArrayHasKey('images', $data);
    }

    public function testUserAuthenticatedFunction()
    {
        $id = 1;
        $this->imageRepositoryMock->shouldReceive('getImageByUser');
        $this->userRepositoryMock->shouldReceive('getUser');
        $this->be($this->makeUser($id));
        $this->followRepositoryMock->shouldReceive('checkFollowed');
        $result = $this->homeController->user(new Request(['id' => $id]));
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('frontend.user', $result->getName());
        $this->assertArrayHasKey('images', $data);
        $this->assertArrayHasKey('user', $data);
        $this->assertArrayHasKey('followed', $data);
    }

    public function testUserUnauthenticatedFunction()
    {
        $id = 1;
        $this->imageRepositoryMock->shouldReceive('getImageByUser');
        $this->userRepositoryMock->shouldReceive('getUser');
        $this->followRepositoryMock->shouldReceive('checkFollowed');
        $result = $this->homeController->user(new Request(['id' => $id]));
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('frontend.user', $result->getName());
        $this->assertArrayHasKey('images', $data);
        $this->assertArrayHasKey('user', $data);
        $this->assertArrayHasKey('followed', $data);
    }

    public function testViewallDefaultFunction()
    {
        $result = $this->homeController->viewall(new Request());
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('frontend.viewall', $result->getName());
        $this->assertArrayHasKey('follow_users', $data);
        $this->assertArrayHasKey('images', $data);
    }

    public function testViewallFollowedUserFunction()
    {
        $id = 1;
        $this->followRepositoryMock->shouldReceive('getUserFollowPaginate');
        $this->be($this->makeUser($id));
        $result = $this->homeController->viewall(new Request(['type' => 'followed-user']));
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('frontend.viewall', $result->getName());
        $this->assertArrayHasKey('follow_users', $data);
        $this->assertArrayHasKey('images', $data);
    }

    public function testViewallMostDownloadFunction()
    {
        $this->imageRepositoryMock->shouldReceive('getMostDownloadImagePaginate');
        $result = $this->homeController->viewall(new Request(['type' => 'most-download']));
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('frontend.viewall', $result->getName());
        $this->assertArrayHasKey('follow_users', $data);
        $this->assertArrayHasKey('images', $data);
    }

    public function testViewallMostLikeFunction()
    {
        $this->imageRepositoryMock->shouldReceive('getMostLikeImagePaginate');
        $result = $this->homeController->viewall(new Request(['type' => 'most-like']));
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('frontend.viewall', $result->getName());
        $this->assertArrayHasKey('follow_users', $data);
        $this->assertArrayHasKey('images', $data);
    }
}
