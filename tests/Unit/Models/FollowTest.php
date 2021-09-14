<?php

namespace Tests\Unit\Models;

use App\Models\Follow;
use Tests\ModelTestCase;

class FollowTest extends ModelTestCase
{
    protected $follow;

    public function setUp(): void
    {
        parent::setUp();
        $this->follow = new Follow();
    }

    public function tearDown(): void
    {
        $this->follow = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'user_id',
            'user_follow_id',
        ];
        $this->assertEquals($fillable, $this->follow->getFillable());
    }
}
