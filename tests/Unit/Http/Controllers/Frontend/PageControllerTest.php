<?php

namespace Tests\Unit\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\PageController;
use App\Http\Requests\ImagePutRequest;
use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Traits\Test\TestController;
use Tests\TestCase;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use Mockery as m;

class PageControllerTest extends TestCase
{
    use TestController;

    protected $categoryRepositoryMock;

    protected $imageRepositoryMock;

    protected $pageController;

    protected function setUp(): void
    {
        $this->afterApplicationCreated(function () {
            $this->imageRepositoryMock = m::mock(ImageRepositoryInterface::class);
            $this->categoryRepositoryMock = m::mock(CategoryRepositoryInterface::class);
            $this->pageController = new PageController(
                $this->categoryRepositoryMock,
                $this->imageRepositoryMock
            );
        });
        parent::setUp();
    }

    protected function tearDown(): void
    {
        m::close();
        unset($this->pageController);
        parent::tearDown();
    }

    public function testSaveUploadFunction()
    {
        $id = 1;
        $this->imageRepositoryMock->shouldReceive('saveUpload');
        $this->be($this->makeUser($id));
        $result = $this->pageController->saveUpload(new ImageRequest());
        $this->assertEquals(route('home.user', ['id' => $id]), $result->getTargetUrl());
    }

    public function testEditImageFailedFunction()
    {
        $image_id = 1;
        $this->be($this->makeUser(1));
        $image = $this->makeImage($image_id, 2);
        $result = $this->pageController->editImage($image);
        $this->assertEquals(404, $result->getStatusCode());
    }

    public function testEditImageSuccessFunction()
    {
        $user_id = 1;
        $image_id = 1;
        $this->categoryRepositoryMock->shouldReceive('getAllCategory');
        $this->categoryRepositoryMock->shouldReceive('getAllSubcategory');
        $this->be($this->makeUser($user_id));
        $image = $this->makeImage($image_id, $user_id);
        $result = $this->pageController->editImage($image);
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('frontend.edit', $result->getName());
        $this->assertArrayHasKey('image', $data);
        $this->assertArrayHasKey('categories', $data);
        $this->assertArrayHasKey('subcategories', $data);
    }

    public function testUpdateImageFunction()
    {
        $id = 1;
        $this->be($this->makeUser($id));
        $result = $this->pageController->updateImage(new ImagePutRequest(), new Image());
        $this->assertEquals(route('home.user', ['id' => $id]), $result->getTargetUrl());
    }

    public function testDeleteImageFunction()
    {
        $id = 1;
        $this->be($this->makeUser($id));
        $result = $this->pageController->deleteImage(new Image());
        $this->assertEquals(route('home.user', ['id' => $id]), $result->getTargetUrl());
    }
}
