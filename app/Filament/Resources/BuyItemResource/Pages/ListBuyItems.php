<?php

namespace App\Filament\Resources\BuyItemResource\Pages;

use App\Filament\Resources\BuyItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBuyItems extends ListRecords
{
    protected static string $resource = BuyItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
