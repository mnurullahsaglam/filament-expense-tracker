<?php

namespace App\Filament\Resources\IncomeResource\Widgets;

use App\Models\Income;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Bu Ayki En Yüksek Harcama', $this->getThisMonthHighestIncome() . ' TL'),

            Card::make('Bu Ayki Toplam Harcama', $this->getThisMonthIncomeTotal() . ' TL'),

            Card::make('Toplam Harcama', $this->getIncomeTotal() . ' TL'),
        ];
    }

    private function getThisMonthHighestIncome()
    {
        return Income::whereMonth('created_at', date('m'))->max('amount');
    }

    private function getThisMonthIncomeTotal()
    {
        return Income::whereMonth('created_at', date('m'))->sum('amount');
    }

    private function getIncomeTotal()
    {
        return Income::sum('amount');
    }
}
