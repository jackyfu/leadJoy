<?php
namespace App\Repositories;
use App\Models\User;

class DbUserRepository implements UserRepositoryInterface{

    public function saveUser()
    {
        // TODO: Implement saveUser() method.
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        return User::find($id);
    }

}