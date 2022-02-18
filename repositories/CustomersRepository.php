<?php


namespace Repositories;

use Core\Database;
use Exception;
use http\Client\Curl\User;
use Models\Customer;

class CustomersRepository
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance(): CustomersRepository
    {
        if (!isset($instance)) {
            CustomersRepository::$instance = new CustomersRepository();
        }
        return CustomersRepository::$instance;
    }

    public function findByEmail($email): User
    {
        $pdo = Database::getInstance();

        $req = $pdo->prepare("SELECT * FROM customers WHERE email LIKE :email");
        $req->bindParam(":email", $email);
        $req->execute();
        $res = $req->fetchObject(User::class);
        if (!$res) {
            throw new Exception("Utilisateur introuvable", 404);
        }
        return $res;
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $pdo = Database::getInstance();

        $req = $pdo->prepare("SELECT first_name, last_name, email, phone FROM customers");
        $req->execute();
        $res = $req->fetchAll();
        $customers = [];
        foreach ($res as $row) {
            $customer= new Customer();
            $customer->first_name = $row['first_name'];
            $customer->last_name = $row['last_name'];
            $customer->email = $row['email'];
            $customer->phone = $row['phone'];
            array_push($customers, $customer);
        }
        return $customers;
    }

    /**
     * @param  \Models\Customer  $customer
     *
     * @return bool
     */
    public function createUser(Customer $customer): bool
    {
        $pdo = Database::getInstance();

        $req = $pdo->prepare("INSERT INTO customers(first_name, last_name, email, phone) VALUES(:first_name, :last_name, :email, :phone)");
        $req->bindParam(":first_name", $customer->first_name);
        $req->bindParam(":last_name", $customer->last_name);
        $req->bindParam(":email", $customer->email);
        $req->bindParam(":phone", $customer->phone);
        return $req->execute();
    }

    public function deleteByEmail(string $email): void
    {
        $pdo = Database::getInstance();
        $req = $pdo->prepare("DELETE FROM customers WHERE email LIKE :email");
        $req->bindParam(":email", $email);
        $req->execute();
    }

}