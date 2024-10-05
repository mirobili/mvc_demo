<?php

namespace App\Services;

use App\Models\UserModel;
use App\Repository;

class UserService
{
    public function __construct(private Repository $repository)
    {
    }
    public function getUser($userId) : UserModel
    {
        return $this->repository->getUser($userId);
    }

    public function getUsers()
    {
        return $this->repository->getUsers();
    }

    public function deleteUser($userId)
    {
        return $this->repository->deleteUser($userId);
    }

    public function createUser($user):UserModel
    {
        return $this->repository->createUser($user);
    }

    public function updateUser(UserModel $user)
    {
        return $this->repository->updateUser($user);
    }

    public function saveUser(UserModel $User)
    {

    }
}