<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Tests\ModelTestCase;
use App\Models\Image;

class ImageTest extends ModelTestCase
{
    protected $image;

    public function setUp(): void
    {
        parent::setUp();
        $this->image = new Image();
    }

    public function tearDown(): void
    {
        $this->image = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'name',
            'slug',
            'user_id',
            'category_id',
            'description',
            'original_link',
            'thumb_link',
            'download',
            'like',
        ];
        $this->assertEquals($fillable, $this->image->getFillable());
    }

    public function testCategoryRelation()
    {
        $relation = $this->image->category();
        $this->assertBelongsToRelation($relation, $this->image, 'category_id');
    }

    public function testCommentsRelation()
    {
        $relation = $this->image->comments();
        $this->assertHasManyRelation($relation, $this->image);
    }

    public function testUserRelation()
    {
        $relation = $this->image->user();
        $this->assertBelongsToRelation($relation, $this->image, 'user_id');
    }

    public function testSharesRelation()
    {
        $relation = $this->image->shares();
        $this->assertBelongsToManyRelation($relation, $this->image, new User());
    }

    public function testLikesRelation()
    {
        $relation = $this->image->likes();
        $this->assertBelongsToManyRelation($relation, $this->image, new User());
    }
}
