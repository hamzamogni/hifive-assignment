<?php

namespace App\Services;

use App\Exceptions\UserAlreadyExistsException;
use App\Repositories\Interfaces\UserRepositoryInterface;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return array
     */
    public function signUp(array $data): array
    {
        if ($this->userRepository->getByEmail($data["email"])) {
            throw new UserAlreadyExistsException();
        }

        $user = $this->userRepository->create($data);

        $token = $this->userRepository->createToken($user);

        return [
            "user" => $user,
            "token" => $token
        ];
    }
}
