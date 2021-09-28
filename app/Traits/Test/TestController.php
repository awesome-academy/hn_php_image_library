<?php

namespace App\Traits\Test;

use App\Models\Image;
use App\Models\User;

trait TestController
{
    public static function makeUser($id)
    {
        $user = User::factory()->make();
        $user->id = $id;

        return $user;
    }

    public static function makeImage($id, $user_id)
    {
        $image = Image::factory()->make();
        $image->id = $id;
        $image->user_id = $user_id;

        return $image;
    }
}
