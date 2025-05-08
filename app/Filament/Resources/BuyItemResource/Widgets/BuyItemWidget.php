<?php

namespace App\Filament\Resources\BuyItemResource\Widgets;

use Filament\Tables;
use App\Models\BuyItem;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\Summarizers\Summarizer;

class BuyItemWidget extends BaseWidget
{

    public $buyId;

    public function mount($record)
    {
        $this->buyId = $record;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                BuyItem::query()->where('buy_id', $this->buyId),
            )
            ->columns([
                TextColumn::make('item.name')
                ->label('Item Name'),
                TextColumn::make('quantity')->alignCenter()
                ->label('Item Quantity'),
                TextColumn::make('price')->money('idr')->alignEnd()
                ->label('Item Price'),
                TextColumn::make('total')
                ->label('Total Price')
                ->getStateUsing(function ($record) {
                    return $record->quantity * $record->price;
                })->money('idr')->alignEnd()->summarize(Summarizer::make()->using(function ($query){
                    return $query->sum(DB::raw('quantity * price'));
                })->money('idr')),
            ])->actions([
                EditAction::make()->form([
                    TextInput::make('quantity')
                    ->label('Item Quantity')
                    ->required(),
                ]),
                    DeleteAction::make(),
            ]);
    }
}
