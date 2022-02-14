<?php

namespace Controllers;

use Core\ViewLoader;
use Repositories\CustomersRepository;

class IndexController
{

    public function getIndex(): void
    {
        ViewLoader::getInstance()->render(
          'Layout/Layout.html',
          ['title' => 'Users:', 'users' => self::getUsers()]
        );
    }

    public function postIndex(): void
    {
        echo print_r($_POST);
    }

    public static function getUsers(): array {
        $customersRepository = CustomersRepository::getInstance();
        return $customersRepository->findAll();
    }
}
