<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use Tests\ModelTestCase;

class CategoryTest extends ModelTestCase
{
    protected $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->category = new Category();
    }

    public function tearDown(): void
    {
        $this->category = null;
        parent::tearDown();
    }

    public function testFillable()
    {
        $fillable = [
            'name',
            'slug',
            'description',
            'parent_id',
        ];
        $this->assertEquals($fillable, $this->category->getFillable());
    }

    public function testImageRelation()
    {
        $relation = $this->category->images();
        $this->assertHasManyRelation($relation, $this->category);
    }

    public function testParentRelation()
    {
        $relation = $this->category->parent();
        $this->assertBelongsToRelation($relation, $this->category, 'parent_id');
    }

    public function testSubcategoryImage()
    {
        $relation = $this->category->subcategories();
        $this->assertHasManyRelation($relation, $this->category, 'parent_id');
    }
}
