
namespace App\Services;

use App\Models\User;

class UserUpdateService {
    public function execute($id, $data) {
        $user = User::find($id);

        if (!$user) {
            return null;
        }

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return $user;
    }
}
