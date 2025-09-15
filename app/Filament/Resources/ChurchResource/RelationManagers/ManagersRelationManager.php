<?php

namespace App\Filament\Resources\ChurchResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;

class ManagersRelationManager extends RelationManager
{
    protected static string $relationship = 'managers';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Attach a user as church manager/admin/assistant
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('users', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('role')
                    ->label('Role')
                    ->options([
                        'admin'     => 'Admin',
                        'manager'   => 'Manager',
                        'assistant' => 'Assistant',
                    ])
                    ->required()
                    ->native(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('pivot.role')
                    ->label('Role')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'admin'     => 'Admin',
                        'manager'   => 'Manager',
                        'assistant' => 'Assistant',
                        default     => ucfirst($state),
                    })
                    ->colors([
                        'danger'  => 'admin',     // 🟥 Red → Admin
                        'gray'    => 'manager',   // ⬛ Black → Manager
                        'warning' => 'assistant', // 🟨 Yellow → Assistant
                    ]),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->label('Add Manager')
                    ->preloadRecordSelect()
                    ->recordSelectSearchable()
                    ->recordSelectOptionsQuery(function ($query, $livewire) {
                        // Exclude users already attached as managers
                        $church = $livewire->ownerRecord;
                        return $query->whereNotIn('id', $church->managers()->pluck('users.id'));
                    })
                    ->form([
                        Forms\Components\Select::make('role')
                            ->label('Role')
                            ->options([
                                'admin'     => 'Admin',
                                'manager'   => 'Manager',
                                'assistant' => 'Assistant',
                            ])
                            ->required()
                            ->native(false),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}
