<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(5)->create();

        User::insert([
            [
                'name' => 'admin',
                'email' => 'admin1@gmail.com',
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
            ],
        ]);

        User::factory(4)->create();

        Image::factory(100)->create();

        Permission::insert([
            ['name' => 'crud_category'],
            ['name' => 'crud_image'],
            ['name' => 'crud_user'],
        ]);

        Role::insert(['name' => 'admin']);

        DB::table('role_permission')->insert([
            ['permission_id' => 1, 'role_id' => 1],
            ['permission_id' => 2, 'role_id' => 1],
            ['permission_id' => 3, 'role_id' => 1],
        ]);
    }
}
