<?php

namespace App\Repositories\Eloquent;

use App\Models\Follow;
use App\Models\User;
use App\Repositories\Interfaces\FollowRepositoryInterface;

class FollowRepository implements FollowRepositoryInterface
{
    public function getUserFollow($user_id)
    {
        $follow_id = self::getFollow($user_id, 'user_follow_id', 'user_id');

        return User::withCount('images')
            ->whereIn('id', $follow_id)
            ->where('is_active', config('project.is_active'))
            ->limit(config('project.home_user_count'))
            ->get();
    }

    public function getFollowUserById($user_id)
    {
        $follow_id = self::getFollow($user_id, 'user_id', 'user_follow_id');

        return User::whereIn('id', $follow_id)->get();
    }

    public function checkFollowed($user_id, $user_follow_id)
    {
        return Follow::where('user_id', $user_id)
            ->where('user_follow_id', $user_follow_id)
            ->exists();
    }

    public function updateFollow($request, $user_id)
    {
        $user = User::findOrFail($request['id']);
        $follow = $this->checkFollowed($user_id, $user['id']);
        if (!$follow) {
            Follow::create([
                'user_id' => $user_id,
                'user_follow_id' => $user['id'],
            ]);
        } else {
            Follow::where('user_id', $user_id)
                ->where('user_follow_id', $user['id'])
                ->delete();
        }

        return $follow;
    }

    public static function getFollow($user_id, $key1, $key2)
    {
        $follows = Follow::select($key1)
            ->where($key2, $user_id)
            ->get();
        if (count($follows) <= 0) {
            return [];
        }
        $follow_id = [];

        foreach ($follows as $i => $value) {
            $follow_id[$i] = $value[$key1];
        }

        return $follow_id;
    }

    public function getUserFollowPaginate($user_id, $paginate)
    {
        $follow_id = self::getFollow($user_id, 'user_follow_id', 'user_id');

        return User::withCount('images')
            ->whereIn('id', $follow_id)
            ->where('is_active', config('project.is_active'))
            ->paginate($paginate);
    }
}
