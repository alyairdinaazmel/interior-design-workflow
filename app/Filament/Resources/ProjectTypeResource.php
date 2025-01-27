<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectTypeResource\Pages;
use App\Models\ProjectType;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class ProjectTypeResource extends Resource
{
    protected static ?string $model = ProjectType::class;

    protected static ?string $navigationLabel = 'Project Types';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->label('Type Name')
                ->unique(ignoreRecord: true)
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')
                ->sortable()
                ->label('ID'),
            TextColumn::make('name')
                ->sortable()
                ->searchable()
                ->label('Type Name'),
            TextColumn::make('created_at')
                ->dateTime('M d, Y')
                ->label('Created At'),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define relation managers if necessary
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjectTypes::route('/'),
            'create' => Pages\CreateProjectType::route('/create'),
            'edit' => Pages\EditProjectType::route('/{record}/edit'),
        ];
    }
}
