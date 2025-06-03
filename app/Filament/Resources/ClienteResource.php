<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClienteResource\Pages;
use App\Filament\Resources\ClienteResource\RelationManagers;
use App\Models\Cliente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationGroup = 'Agenda';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('correo')
                    ->required()
                    ->maxLength(100),


                /*  Forms\Components\TextInput::make('telefono')
                      ->tel()
                      ->required()
                      ->numeric(),*/



                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\Select::make('lada')
                        ->label('País')
                        ->required()
                        ->options([
                            '+52' => '🇲🇽 México (+52)',
                            '+1' => '🇺🇸 Estados Unidos (+1)',
                            '+54' => '🇦🇷 Argentina (+54)',
                            '+34' => '🇪🇸 España (+34)',
                            '+44' => '🇬🇧 Reino Unido (+44)',
                        ])
                        ->default('+52'),

                    Forms\Components\TextInput::make('telefono')
                        ->label('Teléfono')
                        ->required()
                        ->tel()
                        ->numeric(),
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('correo')
                    ->label('Correo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->formatStateUsing(function ($state, $record) {
                        $numero = preg_replace('/\D/', '', $record->telefono);
                        $lada = $record->lada;

                        // Aplica formato: +52 331-001-0000
                        if (strlen($numero) === 10) {
                            $formateado = substr($numero, 0, 3) . '-' . substr($numero, 3, 3) . '-' . substr($numero, 6);
                            return "{$lada} {$formateado}";
                        }

                        // Si no son 10 dígitos, solo concatena
                        return "{$lada} {$numero}";
                    })

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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateCliente::route('/create'),
            'edit' => Pages\EditCliente::route('/{record}/edit'),
        ];
    }
}
