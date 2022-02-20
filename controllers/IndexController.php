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
     * @param array $data
     */
    public function postIndex(array $data): void
    {
        if (isset($data['delete'])) {
            CustomersRepository::getInstance()->deleteByIds($data['users']);
            header('Location: /index');
        } elseif(isset($data['add'])) {
            header('Location: /user');
        } elseif (isset($data['save'])) {
            $customer = new Customer();
            $customer->setFirstName($data["first_name"]);
            $customer->setLastName($data["last_name"]);
            $customer->setEmail($data["email"]);
            $customer->setPhone($data["phone"]);
            CustomersRepository::getInstance()->createUser($customer);
            header('Location: /index');
        }
    }

    /**
     * @return array
     */
    public static function getUsers(): array
    {
        $customersRepository = CustomersRepository::getInstance();
        return $customersRepository->findAll();
    }

}
