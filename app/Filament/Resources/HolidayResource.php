<?php

namespace App\Filament\Resources;

use App\Enum\HolidayStatusEnum;
use App\Enum\LeaveStatusEnum;
use App\Filament\Resources\HolidayResource\Pages;
use App\Filament\Resources\HolidayResource\RelationManagers;
use App\Models\Holiday;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HolidayResource extends Resource
{
    protected static ?string $model = Holiday::class;

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    protected static ?string $activeNavigationIcon = 'heroicon-m-rocket-launch';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Employee\'s Holidays')
                    ->description('Add employee\'s holidays in the system')
                    ->icon('heroicon-o-rocket-launch')
                    ->schema([
                        Forms\Components\Select::make('employee_id')
                            ->relationship('employee', 'id')
                            ->native(false)
                            ->preload()
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('reason')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->default(0),
                        Forms\Components\Select::make('status')
                            ->options(HolidayStatusEnum::class)
                            ->native(false)
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.id')
                    ->numeric()
                    ->sortable()
                    ->size(TextColumnSize::Medium),
                Tables\Columns\TextColumn::make('reason')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable()
                    ->money('XAF')
                    ->size(TextColumnSize::Medium),
                Tables\Columns\TextColumn::make('status')
                    ->badge(fn(string $state): string => match ($state) {
                        LeaveStatusEnum::PENDING->value => 'warning',
                        LeaveStatusEnum::APPROVED->value => 'success',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        LeaveStatusEnum::PENDING->value => 'heroicon-o-arrow-path',
                        LeaveStatusEnum::APPROVED->value => 'heroicon-o-check-badge',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->size(TextColumnSize::Medium)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->size(TextColumnSize::Medium)
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
            'index' => Pages\ManageHolidays::route('/'),
        ];
    }
}
