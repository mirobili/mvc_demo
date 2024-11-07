<?php

namespace App\Services;

use App\Entities\Customer;

class CustomerService
{
    public function get($id)
    {
        $customer = EntityService::get('\App\Entities\Customer', $id);
        return $customer;
    }

    public function save( Customer $customer)
    {
        EntityService::save($customer);
    }
}