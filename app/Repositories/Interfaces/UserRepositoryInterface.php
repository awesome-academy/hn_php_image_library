<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getUser($id);

    public function delete($id);

    public function getSearch($query);

    public function adminCreate($request);

    public function update($user, $request);

    public function adminUpdate($user, $request);
}
