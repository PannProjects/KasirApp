<?php

namespace App\Filament\Resources\BuyResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use App\Filament\Resources\BuyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBuy extends CreateRecord
{
    protected static string $resource = BuyResource::class;

    protected function getFormActions(): array
    {
        return [
            Action::make('create')
            ->label('Next')
            ->submit('create')
            ->keyBindings(['mod+s']),
        ];
    }

    protected function getRedirectUrl(): string
    {
        $id = $this->record->id;
        return route('filament.admin.resources.buy-items.create', ['buy_id' => $id]);
    }
}

