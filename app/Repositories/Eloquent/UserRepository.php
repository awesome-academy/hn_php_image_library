<?php

namespace App\Repositories\Eloquent;

use App\Helpers\DataHelper;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface
{
    public function getUser($id)
    {
        return User::findOrFail($id);
    }

    public function delete($id)
    {
        return User::findOrFail($id)->delete();
    }

    public function getSearch($query)
    {
        return User::where('name', 'LIKE', '%' . $query . '%')
            ->with('role')
            ->orderBy('id', 'DESC')
            ->paginate(config('project.admin_page_count'));
    }

    public function adminCreate($request)
    {
        $request['password'] = Hash::make($request['password']);
        $user = User::create(array_merge($request->all(), ['api_token' => Str::random(60)]));
        self::saveAvatar($user, $request);
    }

    public static function saveAvatar($user, $request)
    {
        if ($request->hasFile('filepload')) {
            $avatar = DataHelper::getAsset($request, 'avatar');

            return $user->update([
                'avatar' => $avatar,
            ]);
        }
    }

    public function adminUpdate($user, $request)
    {
        if ($request['password'] && $request['password'] != '') {
            $request['password'] = Hash::make($request['password']);
            $user->update($request->all());
        } else {
            $user->update($request->except(['password']));
        }

        if ($request->hasFile('filepload')) {
            $avatar = DataHelper::getAsset($request, 'avatar');

            return $user->update([
                'avatar' => $avatar,
            ]);
        }
    }

    public function update($user, $request)
    {
        $user->update($request->only(['name', 'bio']));
        self::saveAvatar($user, $request);
    }
}
