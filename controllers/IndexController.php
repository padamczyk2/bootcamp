<?php

namespace Controllers;

use Core\ViewLoader;
use Repositories\CustomersRepository;
use Models\Customer;

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
    /***    echo "<pre>";
        print_r($data);
    ***/
        $customer = new Customer();
        $customer->setFirstName($data["first_name"]);
        $customer->setLastName($data["last_name"]);
        $customer->setEmail($data["email"]);
        $customer->setPhone($data["phone"]);
        $customersRepository = CustomersRepository::getInstance()->createUser($customer);
    }

    public static function getUsers(): array {
        $customersRepository = CustomersRepository::getInstance();
        return $customersRepository->findAll();
    }
}
