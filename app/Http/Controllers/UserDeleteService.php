<?php

namespace App\Services;

use App\Models\User;

class UserDeleteService {
    public function execute($id) {
        $user = User::find($id);

        if (!$user) {
            return null;
        }

        $user->delete();

        return $user;
    }
}
