<?php

namespace App\Filament\Resources;

use App\Enums\CurrencyEnum;
use App\Filament\Resources\ExpenseResource\Pages;
use App\Models\Expense;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static ?string $slug = 'expenses';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Harcama';

    protected static ?string $pluralLabel = 'Harcamalar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->required(),

                DatePicker::make('date')
                    ->label('Tarih')
                    ->required()
                    ->default(now())
                    ->format('Y-m-d'),

                TextInput::make('name')
                    ->label('İsim')
                    ->required()
                    ->maxLength(255)
                    ->autofocus(),

                Select::make('currency')
                    ->label('Para Birimi')
                    ->required()
                    ->options(CurrencyEnum::getValues())
                    ->default(CurrencyEnum::TRY),

                TextInput::make('amount')
                    ->label('Tutar')
                    ->required()
                    ->minValue(0)
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('İsim')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('currency')
                    ->label('Para Birimi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('amount')
                    ->label('Tutar')
                    ->searchable()
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->bulkActions([
                DeleteBulkAction::make()
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
}
