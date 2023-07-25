<?php

namespace App\Enums;

enum CurrencyEnum: string
{
    case TRY = 'Türk Lirası';
    case EUR = 'Euro';
    case USD = 'Amerikan Doları';

    public static function getValues(): array
    {
        $values = [];
        foreach (self::cases() as $case) {
            $values[$case->name] = $case->value;
        }

        return $values;
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
