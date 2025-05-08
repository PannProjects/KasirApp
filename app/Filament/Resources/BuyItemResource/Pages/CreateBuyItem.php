<?php

namespace App\Filament\Resources\BuyItemResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\BuyItemResource;
use App\Filament\Resources\BuyItemResource\Widgets\BuyItemWidget;

class CreateBuyItem extends CreateRecord
{
    protected static string $resource = BuyItemResource::class;

    protected function getFormActions(): array
    {
        return [
            Action::make('create')
            ->label('Save')
            ->submit('create')
            ->keyBindings(['mod+s']),
        ];
    }

    protected function getRedirectUrl(): string
    {
        $id = $this->record->buy_id;
        return route('filament.admin.resources.buy-items.create', ['buy_id' => $id]);
    }

    public function getFooterWidgetsColumns(): int
    {
        return 1;
    }

    public function getFooterWidgets(): array
    {
        return [
            BuyItemWidget::make([
                'record' => request('buy_id')
            ]),
        ];
    }
}
