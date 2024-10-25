<?php

namespace App\Services;

use App\Models\User;

class UserCreateService {
    public function execute($data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
