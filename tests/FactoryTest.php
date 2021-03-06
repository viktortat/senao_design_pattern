<?php

use App\creditCard\CtbcBank;
use App\creditCard\NcccBank;
use App\creditCard\CathayBank;
use PHPUnit\Framework\TestCase;
use App\creditCard\CreditCardDTO;
use App\creditCard\BankFactory;
use App\creditCard\ResponseDTO;

/**
 * Class FactoryTest
 */
class FactoryTest extends TestCase
{
    public function test_呼叫NCCC驗證信用卡()
    {
        // arrange
        $creditCardDTO = new CreditCardDTO();

        $creditCardDTO->cardNo    = '1111222233334444';
        $creditCardDTO->cvc       = '567';
        $creditCardDTO->validThru = '1125';

        // act
        $bank = BankFactory::create($creditCardDTO);
        $resultDTO = $bank->validate();

        // assert
        static::assertInstanceOf(NcccBank::class, $bank);
        static::assertInstanceOf(ResponseDTO::class, $resultDTO);
    }

    public function test_呼叫國泰驗證信用卡()
    {
        // arrange
        $creditCardDTO = new CreditCardDTO();

        $creditCardDTO->cardNo    = '5555666677778888';
        $creditCardDTO->cvc       = '567';
        $creditCardDTO->validThru = '1125';

        // act
        $bank      = BankFactory::create($creditCardDTO);
        $resultDTO = $bank->validate();

        // assert
        static::assertInstanceOf(CathayBank::class, $bank);
        static::assertInstanceOf(ResponseDTO::class, $resultDTO);
    }

    public function test_呼叫中信驗證信用卡()
    {
        // arrange
        $creditCardDTO = new CreditCardDTO();

        $creditCardDTO->cardNo    = '9999888877776666';
        $creditCardDTO->cvc       = '567';
        $creditCardDTO->validThru = '1125';

        // act
        $bank      = BankFactory::create($creditCardDTO);
        $resultDTO = $bank->validate();

        // assert
        static::assertInstanceOf(CtbcBank::class, $bank);
        static::assertInstanceOf(ResponseDTO::class, $resultDTO);
    }

    public function test_查無發卡行會拋例外()
    {
        // assert
        static::expectException(Exception::class);

        // arrange
        $creditCardDTO = new CreditCardDTO();

        $creditCardDTO->cardNo    = 'abcd1234';
        $creditCardDTO->cvc       = '567';
        $creditCardDTO->validThru = '1125';

        // act
        $bank      = BankFactory::create($creditCardDTO);
        $bank->validate();
    }
}
