<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use Tests\ModelTestCase;

class CommentTest extends ModelTestCase
{
    protected $comment;

    public function setUp(): void
    {
        parent::setUp();
        $this->comment = new Comment;
    }

    public function tearDown(): void
    {
        $this->comment = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'content',
            'user_id',
            'image_id',
            'user_name',
        ];
        $this->assertEquals($fillable, $this->comment->getFillable());
    }

    public function testImageRelation()
    {
        $relation = $this->comment->image();
        $this->assertBelongsToRelation($relation, $this->comment, 'image_id');
    }

    public function testUserRelation()
    {
        $relation = $this->comment->user();
        $this->assertBelongsToRelation($relation, $this->comment, 'user_id');
    }
}
