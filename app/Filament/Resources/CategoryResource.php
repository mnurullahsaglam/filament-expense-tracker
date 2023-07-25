<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $slug = 'categories';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Kategori';

    protected static ?string $pluralLabel = 'Kategoriler';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Adı')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignorable: true)
                    ->autofocus(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Adı')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('incomes_count')
                    ->label('Gelir Sayısı')
                    ->counts('incomes')
                    ->sortable(),

                TextColumn::make('expenses_count')
                    ->label('Gider Sayısı')
                    ->counts('expenses')
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
}
