<?php

namespace App\Services;

use App\Models\User;

class UserListService {
    public function execute() {
        return User::select('id', 'name', 'email', 'created_at')
            ->paginate(10);
    }

    public function find($id) {
        return User::find($id);
    }
}
