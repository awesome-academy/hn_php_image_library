<?php

namespace App\Repositories\Interfaces;

interface CommentRepositoryInterface
{
    public function getComment($image_id);

    public function create($request, $image_id, $user);
}
