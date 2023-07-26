<?php

namespace App\Filament\Resources\ExpenseResource\Widgets;

use App\Models\Expense;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Bu Ayki En Yüksek Harcama', $this->getThisMonthHighestExpense() . ' TL'),

            Card::make('Bu Ayki Toplam Harcama', $this->getThisMonthExpenseTotal() . ' TL'),

            Card::make('Toplam Harcama', $this->getExpenseTotal() . ' TL'),
        ];
    }

    private function getThisMonthHighestExpense()
    {
        return Expense::whereMonth('created_at', date('m'))->max('amount');
    }

    private function getThisMonthExpenseTotal()
    {
        return Expense::whereMonth('created_at', date('m'))->sum('amount');
    }

    private function getExpenseTotal()
    {
        return Expense::sum('amount');
    }
}
