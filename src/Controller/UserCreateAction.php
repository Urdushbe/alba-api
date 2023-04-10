<?php

declare(strict_types=1);

namespace App\Controller;

use App\Component\User\UserFactory;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserCreateAction extends AbstractController
{
    public function __construct(private UserFactory $userFactory)
    {
    }

    public function __invoke(User $data): void
    {
        $user = $this->userFactory->create(
            $data->getEmail(),
            $data->getPassword(),
            $data->getFullName(),
            $data->getTel()
        );

        print_r($user);
        exit;
    }

}