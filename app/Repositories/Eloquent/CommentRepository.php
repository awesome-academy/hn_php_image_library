<?php

namespace App\Repositories\Eloquent;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function getComment($image_id)
    {
        return Comment::where('image_id', $image_id)
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->paginate(config('project.comment_count'));
    }

    public function create($request, $image_id, $user)
    {
        return Comment::create([
            'content' => $request['content'],
            'user_id' => $user->getAuthIdentifier(),
            'image_id' => $image_id,
            'user_name' => $user->name,
        ]);
    }
}
