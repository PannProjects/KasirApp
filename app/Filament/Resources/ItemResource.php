<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Item;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ItemResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ItemResource\RelationManagers;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'Data Item';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        TextInput::make('code')
                            ->label('Item Code')
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('name')
                            ->label('Item Name')
                            ->required(),

                        TextInput::make('price')
                            ->label('Price')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),

                        TextInput::make('stock')
                            ->label('Stock')
                            ->required()
                            ->numeric()
                            ->disabledOn('edit'),

                        Select::make('unit')
                            ->label('Unit')
                            ->options([
                                'pcs' => 'Pcs',
                                'kg' => 'Kg',
                                'gr' => 'Gr',
                                'l' => 'L',
                                'ml' => 'Ml',
                            ])
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Item Code')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Item Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Price')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('unit')
                    ->label('Unit')
                    ->sortable(),

                TextColumn::make('stock')
                    ->label('Stock')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
