<?php

namespace Controllers;

use Core\ViewLoader;
use Repositories\CustomersRepository;

class IndexController
{

    /**
     *
     */
    public function getIndex(): void
    {
        ViewLoader::getInstance()->render(
          'Layout/Layout.html',
          ['title' => 'Users:', 'users' => self::getUsers()]
        );
    }

    /**
     * @param  array  $data
     */
    public function postIndex(array $data): void
    {
        echo "<pre>";
        print_r($data);
    }

    public static function getUsers(): array {
        $customersRepository = CustomersRepository::getInstance();
        return $customersRepository->findAll();
    }
}
