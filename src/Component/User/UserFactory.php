<?php

declare(strict_types=1);

namespace App\Component\User;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {

    }
    public function create(string $email, string $password, string $fullName, string $tel): User
    {
             $user = new User();
             $user->setEmail($email);
             $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
             $user->setPassword($hashedPassword);
             $user->setFullName($fullName);
             $user->setTel($tel);

             return $user;

    }

}