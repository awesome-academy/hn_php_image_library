<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as ImageProcesing;

class DataHelper
{
    public static function getAsset($request, $key)
    {
        $image_path = config('project.' . $key) . self::getSlug($request->file('filepload')->getClientOriginalName());
        $img = ImageProcesing::make($request->file('filepload'));
        switch ($key) {
            case 'avatar':
                $img->resize(config('project.avatar_w'), config('project.avatar_h'));
                break;
            case 'thumbs':
                $img->resize(config('project.thumb_w'), config('project.thumb_h'));
                break;
            default:
                $img->resize(config('project.image_w'), config('project.image_h'));
                break;
        }
        $img->save(public_path($image_path));
        $img->destroy();

        return $image_path;
    }

    public static function getSlug($name)
    {
        return time() . '-' . Str::slug($name);
    }

    public static function checkRoute($name)
    {
        if (request()->route()->getName() == $name) {
            return true;
        }

        return false;
    }
}
