<?php

namespace App\Filament\Resources;

use App\Models\Buy;
use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use App\Models\Supplier;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BuyResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BuyResource\RelationManagers;

class BuyResource extends Resource
{
    protected static ?string $model = Buy::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date')
                    ->label('Purchase Date')
                    ->default(now())
                    ->columnSpanFull()
                    ->required(),

                Select::make('supplier_id')
                    ->options(
                        Supplier::pluck('company_name', 'id')->toArray()
                    )
                    ->required()
                    ->label('Choose Supplier')
                    ->columnSpanFull()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('Contact Name'),
                        Forms\Components\TextInput::make('company_name')
                            ->required(),
                        Forms\Components\TextInput::make('phone')
                            ->unique(ignoreRecord: true)
                            ->type('number'),
                        Forms\Components\TextInput::make('email')
                            ->unique(ignoreRecord: true)
                            ->type('email'),
                        Forms\Components\Textarea::make('address')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->createOptionUsing(function (array $data): int {
                        return Supplier::create($data)->id;
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('supplier.company_name')
                    ->label('Supplier Name'),

                TextColumn::make('supplier.name')
                    ->label('Sales Name'),

                TextColumn::make('date')
                    ->dateTime('d-F-Y', 'Asia/Jakarta')
                    ->label('Purchase Date'),
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
            RelationManagers\BuyItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBuys::route('/'),
            'create' => Pages\CreateBuy::route('/create'),
            'edit' => Pages\EditBuy::route('/{record}/edit'),
        ];
    }
}
