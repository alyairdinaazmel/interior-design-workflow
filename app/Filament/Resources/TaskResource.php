<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Resources\Table;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;
    protected static ?string $navigationIcon = 'heroicon-o-check-circle';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')->required()->maxLength(255),
            Textarea::make('description')->required(),
            Select::make('workflow_instance_id')
                ->label('Workflow Instance')
                ->relationship('workflowInstance', 'id') // Adjust the display field as needed
                ->required(),
            Select::make('assigned_to')
                ->label('Assigned To')
                ->relationship('assignedUser', 'name')
                ->required(),
            DatePicker::make('start_date')->required(),
            DatePicker::make('deadline')->required(),
            Select::make('status')
                ->options([
                    'Pending'       => 'Pending',
                    'In Progress'   => 'In Progress',
                    'Completed'     => 'Completed',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->sortable()->searchable(),
            TextColumn::make('assignedUser.name')->label('Assigned To')->sortable()->searchable(),
            TextColumn::make('start_date')->date()->sortable(),
            TextColumn::make('deadline')->date()->sortable(),
            TextColumn::make('status')->sortable(),
        ])->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            // Optionally add relation managers for TaskComments and TaskDocuments.
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit'   => Pages\EditTask::route('/{record}/edit'),
            'view'   => Pages\ViewTask::route('/{record}'),
        ];
    }
}
