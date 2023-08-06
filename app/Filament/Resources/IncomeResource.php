<?php

namespace App\Filament\Resources;

use App\Enums\CurrencyEnum;
use App\Filament\Resources\IncomeResource\Pages;
use App\Filament\Resources\IncomeResource\Widgets\StatsOverview;
use App\Models\Income;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;

class IncomeResource extends Resource
{
    protected static ?string $model = Income::class;

    protected static ?string $slug = 'incomes';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Gelir';

    protected static ?string $pluralLabel = 'Gelirler';

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
            'index' => Pages\ListIncomes::route('/'),
            'create' => Pages\CreateIncome::route('/create'),
            'edit' => Pages\EditIncome::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }

    public static function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
}
