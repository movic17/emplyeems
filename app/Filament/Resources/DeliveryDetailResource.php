<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeliveryDetailResource\Pages;
use App\Filament\Resources\DeliveryDetailResource\RelationManagers;
use App\Models\DeliveryDetail;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeliveryDetailResource extends Resource
{
    protected static ?string $model = DeliveryDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $activeNavigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Forms\Components\Select::make('delivery_id')
                        ->relationship('delivery', 'sales_date')
                        ->required()
                        ->numeric(),
                    Forms\Components\Select::make('product_id')
                        ->relationship('product', 'product_name')
                        ->required(),
                    Forms\Components\Select::make('warehouse_id')
                        ->relationship('warehouse', 'warehouse_name')
                        ->required(),
                    Forms\Components\TextInput::make('delivery_qty')
                        ->required()
                        ->numeric(),
                    Forms\Components\DatePicker::make('expected_date')
                        ->required(),
                    Forms\Components\DatePicker::make('actual_date')
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('delivery.sales_date')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.product_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('warehouse.warehouse_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('delivery_qty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expected_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('actual_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDeliveryDetails::route('/'),
        ];
    }
}
