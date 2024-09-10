<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Filament\Resources\AttendanceResource\RelationManagers;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $activeNavigationIcon = 'heroicon-m-clipboard-document-check';

    protected static ?int $navigationSort = 4;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Employee\'s Attendance')
                    ->description('Mark employees as present in the company')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->schema([
                        Forms\Components\Select::make('employee_id')
                            ->relationship('employee', 'id')
                            ->required()
                            ->native(false)
                            ->preload()
                            ->searchable()
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('entry_date')
                            ->required(),
                        Forms\Components\TimePicker::make('entry_time')
                            ->required(),
                        Forms\Components\TimePicker::make('exit_time')
                            ->required(),
                        Forms\Components\Toggle::make('registered')
                            ->required(),
                    ])
                    ->columns(3),
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
                Tables\Columns\TextColumn::make('entry_time')
                    ->dateTime()
                    ->sortable()
                    ->size(TextColumnSize::Medium),
                Tables\Columns\TextColumn::make('exit_time')
                    ->dateTime()
                    ->sortable()
                    ->size(TextColumnSize::Medium),
                Tables\Columns\IconColumn::make('registered')
                    ->boolean(),
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
            'index' => Pages\ManageAttendances::route('/'),
        ];
    }
}
