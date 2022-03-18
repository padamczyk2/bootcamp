<?php

namespace Controllers;

use Core\ViewLoader;
use http\Client\Curl\User;
use Repositories\CustomersRepository;
use Models\Customer;

class EditController
{

    /**
     *
     */
    public function getIndex(): void
    {
        ViewLoader::getInstance()->render(
          'Layout/User.html',
          ['title' => 'Users:', 'users' => self::getUsers()]
        );
    }

    /**
     * @param  array  $data
     */
    public function postIndex(array $data): void
    {
        $datauser = $this->getUserById($data["user_id"]);
        print_r($datauser);
        die;
        $customer = new Customer();
        $customer->setFirstName($data["first_name"]);
        $customer->setLastName($data["last_name"]);
        $customer->setEmail($data["email"]);
        $customer->setPhone($data["phone"]);
        $customersRepository = CustomersRepository::getInstance()->createUser($customer);

    }

    public function getUserById(int $id): User {
        $customersRepository = CustomersRepository::getInstance();
        return $customersRepository->findById($id);
    }

}
