<?php

namespace App\ValueObject;

class Money
{

    /**
     * @param float $value
     * @param string $currency
     */
    public function __construct($value, $currency)
    {
        $this->value  = $value;
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}