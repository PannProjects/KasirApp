<?php

namespace App\Filament\Resources\BuyItemResource\Pages;

use App\Filament\Resources\BuyItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBuyItem extends EditRecord
{
    protected static string $resource = BuyItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
