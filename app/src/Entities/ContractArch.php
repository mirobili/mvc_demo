<?php

namespace App\Entities;

use App\Framework\Entity;


class ContractArch extends Entity{

    protected static string $_table_name = 'contract_arch';

    protected static array $_fillable = ['id','code','customer_id','valid_from','valid_to','status','created_at','updated_at',];

    protected static array $_readonly = ['created_at','updated_at',];

    protected static array $_relations = [
        'customer' => [
            'customer_id', 'hasOne', 'customer.id',
        ],

    ];


    protected $id = null;
    protected $code = null;
    protected $customer_id = null;
    protected $valid_from = null;
    protected $valid_to = null;
    protected $status = null;
    protected $created_at = null;
    protected $updated_at = null;

    public function __construct()
    {
        parent::__construct();


    }

    # Getters

    public function getId() { return $this->id; }
    public function getCode() { return $this->code; }
    public function getCustomerId() { return $this->customer_id; }
    public function getValidFrom() { return $this->valid_from; }
    public function getValidTo() { return $this->valid_to; }
    public function getStatus() { return $this->status; }
    public function getCreatedAt() { return $this->created_at; }
    public function getUpdatedAt() { return $this->updated_at; }

    # Setters

    public function setId($value):void { $this->id = $value; }
    public function setCode($value):void { $this->code = $value; }
    public function setCustomerId($value):void { $this->customer_id = $value; }
    public function setValidFrom($value):void { $this->valid_from = $value; }
    public function setValidTo($value):void { $this->valid_to = $value; }
    public function setStatus($value):void { $this->status = $value; }
    public function setCreatedAt($value):void { $this->created_at = $value; }
    public function setUpdatedAt($value):void { $this->updated_at = $value; }


}