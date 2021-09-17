<?php

namespace Tests\Unit\Models;

use App\Models\Role;
use App\Models\User;
use Tests\ModelTestCase;

class RoleTest extends ModelTestCase
{
    protected $role;

    public function setUp(): void
    {
        parent::setUp();
        $this->role = new Role();
    }

    public function tearDown(): void
    {
        $this->role = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'name',
        ];
        $this->assertEquals($fillable, $this->role->getFillable());
    }

    public function testPermissionRelation()
    {
        $relation = $this->role->permissions();
        $this->assertBelongsToManyRelation($relation, $this->role, new User(), 'role_id', 'permission_id');
    }

    public function testUserRelation()
    {
        $relation = $this->role->user();
        $this->assertHasManyRelation($relation, $this->role, 'role_id');
    }
}
