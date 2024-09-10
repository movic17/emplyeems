<?php

namespace App\Filament\Resources;

use App\Enum\EmployeeGenderEnum;
use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $activeNavigationIcon = 'heroicon-m-identification';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Employee\'s Credentials')
                    ->description('Add employee\'s credentials in the system')
                    ->icon('heroicon-o-identification')
                    ->schema([
                        Forms\Components\Select::make('department_id')
                            ->relationship('department', 'name')
                            ->required()
                            ->native(false),
                        Forms\Components\Select::make('designation_id')
                            ->relationship('designation', 'name')
                            ->required()
                            ->native(false),
                        Forms\Components\TextInput::make('first_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('last_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('dob')
                            ->label('Date of birth')
                            ->required(),
                        Forms\Components\Select::make('gender')
                            ->options(EmployeeGenderEnum::class)
                            ->native(false)
                            ->required(),
                        Forms\Components\DatePicker::make('join_date')
                            ->required(),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('department.name')
                    ->numeric()
                    ->sortable()
                    ->size(TextColumnSize::Medium)
                    ->badge(),
                Tables\Columns\TextColumn::make('designation.name')
                    ->numeric()
                    ->sortable()
                    ->size(TextColumnSize::Medium)
                    ->badge(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()
                    ->size(TextColumnSize::Medium),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()
                    ->size(TextColumnSize::Medium),
                Tables\Columns\TextColumn::make('dob')
                    ->label('Birth')
                    ->date()
                    ->sortable()
                    ->size(TextColumnSize::Medium),
                Tables\Columns\TextColumn::make('gender')
                    ->size(TextColumnSize::Medium)
                    ->badge(),
                Tables\Columns\TextColumn::make('join_date')
                    ->date()
                    ->sortable()
                    ->size(TextColumnSize::Medium),
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
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                        ->color('info'),
                    Tables\Actions\DeleteAction::make(),
                ])
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
            'index' => Pages\ManageEmployees::route('/'),
        ];
    }
}
