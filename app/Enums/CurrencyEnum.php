<?php

namespace App\Enums;

enum CurrencyEnum: string
{
    case TRY = 'Türk Lirası';
    case EUR = 'Euro';
    case USD = 'Amerikan Doları';

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getNames(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function getRandomName(): string
    {
        $names = self::getNames();
        $randomIndex = array_rand($names);
        return $names[$randomIndex];
    }
}
