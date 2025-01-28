<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\WorkflowTemplate;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationLabel = 'Projects';

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Project Details')
                ->schema([
                    Forms\Components\Grid::make(2)->schema([
                        // Project Name
                        TextInput::make('name')
                            ->required()
                            ->label('Project Name')
                            ->maxLength(255),

                        // Client Select with Inline Creation
                        Select::make('client_id')
                            ->relationship('client', 'name')
                            ->required()
                            ->label('Client')
                            ->searchable()
                            ->preload()
                            ->placeholder('Select a Client')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->label('Client Name')
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->label('Email')
                                    ->maxLength(255),
                                TextInput::make('phone')
                                    ->label('Phone')
                                    ->maxLength(20),
                                // Add other necessary client fields here
                            ])
                            ->saveOptionUsing(function ($state, $record) {
                                return Client::create([
                                    'name' => $state['name'],
                                    'email' => $state['email'],
                                    'phone' => $state['phone'],
                                    // Add other fields as necessary
                                ])->id;
                            }),

                        // Project Type Select with Inline Creation
                        Select::make('project_type_id')
                            ->relationship('projectType', 'name')
                            ->required()
                            ->label('Project Type')
                            ->searchable()
                            ->preload()
                            ->placeholder('Select a Project Type')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->label('Type Name')
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                            ])
                            ->saveOptionUsing(function ($state, $record) {
                                return ProjectType::create(['name' => $state['name']])->id;
                            }),

                        // Workflow Template Select with Inline Creation
                        Select::make('workflow_template_id')
                            ->relationship('workflowTemplate', 'name')
                            ->required()
                            ->label('Workflow Template')
                            ->searchable()
                            ->preload()
                            ->placeholder('Select a Workflow Template')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->label('Template Name')
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                                Textarea::make('description')
                                    ->label('Description')
                                    ->rows(3)
                                    ->maxLength(1000),
                                // Add other necessary workflow template fields here
                            ])
                            ->saveOptionUsing(function ($state, $record) {
                                return WorkflowTemplate::create([
                                    'name' => $state['name'],
                                    'description' => $state['description'],
                                    // Add other fields as necessary
                                ])->id;
                            }),

                        // Budget Field with RM Currency
                        TextInput::make('budget')
                            ->numeric()
                            ->required()
                            ->label('Budget')
                            ->prefix('RM')
                            ->minValue(0),

                        // Start Date Picker
                        DatePicker::make('start_date')
                            ->required()
                            ->label('Start Date')
                            ->maxDate(now()->addYears(5)),

                        // End Date Picker (Optional)
                        DatePicker::make('end_date')
                            ->label('End Date')
                            ->afterOrEqual('start_date')
                            ->nullable(), // Make end_date optional

                        // Status Select
                        Select::make('status')
                            ->options([
                                'Pending' => 'Pending',
                                'Active' => 'Active',
                                'Completed' => 'Completed',
                                'On Hold' => 'On Hold',
                            ])
                            ->required()
                            ->label('Status'),
                    ]),
                ])
                ->columns(2),

            // Additional Information Section
            Forms\Components\Section::make('Additional Information')
                ->schema([
                    Textarea::make('project_description')
                        ->label('Project Description')
                        ->rows(3)
                        ->columnSpan(2),
                    // Add other sections or components as needed
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            // ID Column
            TextColumn::make('id')
                ->sortable()
                ->label('ID'),

            // Project Name Column
            TextColumn::make('name')
                ->sortable()
                ->searchable()
                ->label('Project Name'),

            // Client Column
            TextColumn::make('client.name')
                ->label('Client')
                ->sortable()
                ->searchable(),

            // Project Type Column with Badge
            TextColumn::make('projectType.name')
                ->label('Project Type')
                ->sortable()
                ->searchable(),

            // Budget Column in RM
            TextColumn::make('budget')
                ->money('myr') // 'myr' is the ISO code for Malaysian Ringgit
                ->sortable()
                ->label('Budget'),

            // Workflow Template Column
            TextColumn::make('workflowTemplate.name')
                ->label('Workflow Template')
                ->sortable()
                ->searchable(),

            // Start Date Column
            TextColumn::make('start_date')
                ->date()
                ->sortable()
                ->label('Start Date'),

            // End Date Column
            TextColumn::make('end_date')
                ->date()
                ->sortable()
                ->label('End Date'),

            // Status Column with Badge
            TextColumn::make('status')
                ->sortable()
                ->label('Status'),

            // Created At Column
            TextColumn::make('created_at')
                ->dateTime('M d, Y')
                ->label('Created At'),
        ])
        ->filters([
            // Status Filter
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'Pending' => 'Pending',
                    'Active' => 'Active',
                    'Completed' => 'Completed',
                    'On Hold' => 'On Hold',
                ])
                ->label('Status'),

            // Project Type Filter
            Tables\Filters\SelectFilter::make('project_type_id')
                ->relationship('projectType', 'name')
                ->label('Project Type'),

            // Client Filter
            Tables\Filters\SelectFilter::make('client_id')
                ->relationship('client', 'name')
                ->label('Client'),

            // Start Date Range Filter
            Tables\Filters\Filter::make('start_date')
                ->form([
                    DatePicker::make('start_from')->label('Start From'),
                    DatePicker::make('start_until')->label('Start Until'),
                ])
                ->query(function ($query, $data) {
                    return $query
                        ->when($data['start_from'], fn($q) => $q->whereDate('start_date', '>=', $data['start_from']))
                        ->when($data['start_until'], fn($q) => $q->whereDate('start_date', '<=', $data['start_until']));
                })
                ->label('Start Date Range'),

            // Budget Range Filter
            Tables\Filters\Filter::make('budget')
                ->form([
                    TextInput::make('min')->numeric()->label('Minimum Budget'),
                    TextInput::make('max')->numeric()->label('Maximum Budget'),
                ])
                ->query(function ($query, $data) {
                    return $query
                        ->when($data['min'], fn($q) => $q->where('budget', '>=', $data['min']))
                        ->when($data['max'], fn($q) => $q->where('budget', '<=', $data['max']));
                })
                ->label('Budget Range'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            // Add custom actions if necessary
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
