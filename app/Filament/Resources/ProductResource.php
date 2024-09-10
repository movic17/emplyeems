<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $activeNavigationIcon = 'heroicon-m-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Forms\Components\Select::make('category_id')
                        ->relationship('category', 'category_name')
                        ->native(false)
                        ->required()
                        ->numeric(),
                    Forms\Components\TextInput::make('product_code')
                        ->required()
                        ->maxLength(100),
                    Forms\Components\TextInput::make('barcode')
                        ->required()
                        ->maxLength(100),
                    Forms\Components\TextInput::make('product_name')
                        ->required()
                        ->maxLength(100),
                    Forms\Components\Textarea::make('product_description')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('reorder_qty')
                        ->required()
                        ->numeric(),
                    Forms\Components\TextInput::make('packed_weight')
                        ->required()
                        ->numeric(),
                    Forms\Components\TextInput::make('packed_height')
                        ->required()
                        ->numeric(),
                    Forms\Components\TextInput::make('packed_width')
                        ->required()
                        ->numeric(),
                    Forms\Components\TextInput::make('packed_depth')
                        ->required()
                        ->numeric(),
                    Forms\Components\TextInput::make('order_qty')
                        ->required()
                        ->numeric(),
                    Forms\Components\Toggle::make('refrigerated')
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.category_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('barcode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('product_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reorder_qty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('packed_weight')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('packed_height')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('packed_width')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('packed_depth')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_qty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('refrigerated')
                    ->boolean(),
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
            'index' => Pages\ManageProducts::route('/'),
        ];
    }
}
