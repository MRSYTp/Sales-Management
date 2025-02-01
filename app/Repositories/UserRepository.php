<?php 

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function findById(int $id) : object|null
    {
        return $this->userModel->findById($id);
    }

    public function findByEmail(string $email) : object|null
    {
        return $this->userModel->findByEmail($email);
    }

    public function create(array $data) : int|null
    {
        return $this->userModel->create($data);
    }
}
