<?php

declare(strict_types=1);


use App\Entities\Contract;
use App\Framework\DB;
use PHPUnit\Framework\TestCase;

class ContractTests extends TestCase
{

    public function setUp(): void
    {
      ///  DB::reset();
    }

    public function tearDown(): void
    {

    }

    public function testContract(): void
    {
        $contract = Contract::get(1);
        trace($contract);
        $contract->setVar('id', null);
        //$contract->setId(null);
        $contract->save();

//        $this->assertInstanceOf(Contract::class, $contract);

    }

    public function test_update_Contract(): void
    {
        $contract = Contract::get(2);
        // trace($contract);

        $new_contract_code = 'CDSM1000-050-1002222';
        $contract->setCode($new_contract_code);
        $contract->save();
        $contract2 = Contract::get(2);
      //   trace($contract);

        $this->assertEquals($new_contract_code, $contract2->getCode());

//        $this->assertInstanceOf(Contract::class, $contract);

    }




}