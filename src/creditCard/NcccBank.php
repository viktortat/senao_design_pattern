<?php

namespace App\creditCard;

/**
 * Class NcccBank
 * @package App\creditCard
 */
class NcccBank extends AbstractBank
{
    /**
     * @return ResponseDTO
     */
    public function validate(): ResponseDTO
    {
        return $this->sendRequest($this->creditCardDTO);
    }
}
