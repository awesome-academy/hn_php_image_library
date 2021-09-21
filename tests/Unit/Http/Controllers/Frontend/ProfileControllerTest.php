<?php

namespace Tests\Unit\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Requests\ProfileRequest;
use Tests\TestCase;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Mockery as m;

class ProfileControllerTest extends TestCase
{
    protected $categoryRepositoryMock;

    protected $userRepositoryMock;

    protected $imageRepositoryMock;

    protected $profileController;

    protected function setUp(): void
    {
        $this->afterApplicationCreated(function () {
            $this->imageRepositoryMock = m::mock(ImageRepositoryInterface::class);
            $this->categoryRepositoryMock = m::mock(CategoryRepositoryInterface::class);
            $this->userRepositoryMock = m::mock(UserRepositoryInterface::class);
            $this->profileController = new ProfileController(
                $this->categoryRepositoryMock,
                $this->imageRepositoryMock,
                $this->userRepositoryMock
            );
        });
        parent::setUp();
    }

    public function testEditFunction()
    {
        $result = $this->profileController->edit();
        $this->assertEquals('frontend.profile', $result->getName());
    }

    public function testDeleteFunction()
    {
        $result = $this->profileController->delete();
        $this->assertEquals('frontend.delete', $result->getName());
    }

    public function testDestroyFunction()
    {
        $this->userRepositoryMock->shouldReceive('delete');
        $result = $this->profileController->destroy();
        $this->assertEquals(route('home'), $result->getTargetUrl());
    }

    public function testUpdateFunction()
    {
        $this->userRepositoryMock->shouldReceive('update');
        $result = $this->profileController->update(new ProfileRequest());
        $this->assertEquals(route('profile.edit'), $result->getTargetUrl());
    }

    public function testFavoritesFunction()
    {
        $this->imageRepositoryMock->shouldReceive('getImageFavorite');
        $result = $this->profileController->favorites();
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('frontend.favorites', $result->getName());
        $this->assertArrayHasKey('images', $data);
    }

    public function testUploadFunction()
    {
        $this->categoryRepositoryMock->shouldReceive('getAllCategory');
        $result = $this->profileController->upload();
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('frontend.upload', $result->getName());
        $this->assertArrayHasKey('categories', $data);
    }

    protected function tearDown(): void
    {
        m::close();
        unset($this->profileController);
        parent::tearDown();
    }
}
