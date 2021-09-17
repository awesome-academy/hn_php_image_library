<?php

namespace Tests\Unit\Models;

use Tests\ModelTestCase;
use App\Models\User;

class UserTest extends ModelTestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
    }

    public function tearDown(): void
    {
        $this->user = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'name',
            'email',
            'bio',
            'avatar',
            'password',
            'role_id',
            'is_active',
            'api_token',
        ];
        $this->assertEquals($fillable, $this->user->getFillable());
    }

    public function testHidden()
    {
        $hidden = [
            'password',
            'remember_token',
        ];
        $this->assertEquals($hidden, $this->user->getHidden());
    }

    public function testCast()
    {
        $casts = [
            'email_verified_at' => 'datetime',
            'id' => 'int',
            'deleted_at' => 'datetime',
        ];
        $this->assertEquals($casts, $this->user->getCasts());
    }

    public function testRoleRelation()
    {
        $relation = $this->user->role();
        $this->assertBelongsToRelation($relation, $this->user, 'role_id');
    }

    public function testImagesRelation()
    {
        $relation = $this->user->images();
        $this->assertHasManyRelation($relation, $this->user);
    }

    public function testFollowsRelation()
    {
        $relation = $this->user->follows();
        $this->assertHasManyRelation($relation, $this->user);
    }
}
