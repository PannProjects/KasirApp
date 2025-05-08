<?php

namespace App\Filament\Resources;

use App\Models\Buy;
use Filament\Forms;
use App\Models\Item;
use Filament\Tables;
use App\Models\BuyItem;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BuyItemResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BuyItemResource\RelationManagers;

class BuyItemResource extends Resource
{
    protected static ?string $model = BuyItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $buy = new Buy();
        if(request()->filled('buy_id')){
            $buy = Buy::find(request('buy_id'));
        }

        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        DatePicker::make('date')
                            ->label('Purchase Date')
                            ->default($buy->date)
                            ->disabled()
                            ->required(),

                        TextInput::make('supplier_id')
                            ->label('Supplier')
                            ->disabled()
                            ->required()
                            ->default($buy->supplier?->name),

                        TextInput::make('supplier_email')
                            ->label('Email Supplier')
                            ->disabled()
                            ->required()
                            ->default($buy->supplier?->email),
                    ])
                    ->columns(3),

                Grid::make()
                    ->schema([
                        Select::make('item_id')
                            ->label('Item')
                            ->required()
                            ->options(Item::all()->pluck('name', 'id'))
                            ->reactive()
                            ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                $item = Item::find($state);
                                $set('price', $item->price ?? null);
                                $quantity = $get('quantity');
                                $total = $quantity * $item->price;
                                $set('total', $total);
                            }),

                        TextInput::make('price')
                            ->label('Price')
                            ->required()
                            ->numeric(),

                        TextInput::make('quantity')
                            ->reactive()
                            ->afterStateUpdated(function($state, Set $set, Get $get){
                                $quanity = $state;
                                $price = $get('price');
                                $total = $quanity * $price;
                                $set('total', $total);
                            })
                            ->label('Quantity')
                            ->required()
                            ->default(1),

                        TextInput::make('total')
                            ->disabled()
                            ->label('Total Price')
                    ])
                    ->columns(4),

                Hidden::make('buy_id')
                    ->default(request('buy_id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListBuyItems::route('/'),
            'create' => Pages\CreateBuyItem::route('/create'),
            'edit' => Pages\EditBuyItem::route('/{record}/edit'),
        ];
    }
}
