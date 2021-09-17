<?php

namespace Tests\Unit\Models;

use App\Models\Permission;
use App\Models\Role;
use Tests\ModelTestCase;

class PermissionTest extends ModelTestCase
{
    protected $permission;

    public function setUp(): void
    {
        parent::setUp();
        $this->permission = new Permission();
    }

    public function tearDown(): void
    {
        $this->permission = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'name',
        ];
        $this->assertEquals($fillable, $this->permission->getFillable());
    }

    public function testRoleRelation()
    {
        $relation = $this->permission->roles();
        $this->assertBelongsToManyRelation($relation, $this->permission, new Role());
    }
}
