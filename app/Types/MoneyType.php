<?php

namespace App\Types;

use App\ValueObject\Money;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class MoneyType extends Type
{
    const MONEY = 'money';

    public function getName()
    {
        return self::MONEY;
    }

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'VARCHAR(256) COMMENT "currency and amount"';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        [$currency, $amount] = explode(' ', $value);

        return new Money($amount, $currency);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof Money) {
            $value = $value->getCurrency() . ' ' . $value->getValue();
        }

        return $value;
    }
}