<?php

namespace App\Repositories\Interfaces;

interface FollowRepositoryInterface
{
    public function getUserFollow($user_id);

    public function getUserFollowPaginate($user_id, $paginate);

    public function checkFollowed($user_id, $user_follow_id);

    public function updateFollow($request, $user_id);

    public function getFollowUser($user_id);
}
