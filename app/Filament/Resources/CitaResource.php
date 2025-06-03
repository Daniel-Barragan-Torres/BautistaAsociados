<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CitaResource\Pages;
use App\Filament\Resources\CitaResource\RelationManagers;
use App\Models\Cita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CitaResource extends Resource
{
    protected static ?string $model = Cita::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Agenda';



    /* Calendar caliz */
    public static function getWidgets(): array
    {
        return [
            \App\Filament\Resources\CitaResource\Widgets\CalendarioCitas::class,
        ];
    }


    /* End of Calendar cañoz */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('asunto')
                    ->label('Asunto')
                    ->required()
                    ->maxLength(150),
                Forms\Components\Select::make('cliente_id')
                    ->label('Cliente')
                    ->relationship('cliente', 'nombre')
                    ->searchable()
                    ->required(),
                Forms\Components\DateTimePicker::make('fecha_inicio')
                    ->label('Fecha y Hora de Inicio')
                    ->required(),
                Forms\Components\DateTimePicker::make('fecha_fin')
                    ->label('Fecha y Hora de Fin')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('asunto')
                    ->label('Asunto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cliente.nombre')
                    ->label('Cliente')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cliente.correo')->label('Correo del Cliente'),
                Tables\Columns\TextColumn::make('cliente.telefono')->label('Teléfono del Cliente')
                    ->formatStateUsing(function ($state, $record) {
                        $numero = preg_replace('/\D/', '', $record->cliente->telefono);
                        $lada = $record->cliente->lada;

                        // Aplica formato: +52 331-001-0000
                        if (strlen($numero) === 10) {
                            $formateado = substr($numero, 0, 3) . '-' . substr($numero, 3, 3) . '-' . substr($numero, 6);
                            return "{$lada} {$formateado}";
                        }

                        // Si no son 10 dígitos, solo concatena
                        return "{$lada} {$numero}";
                    }),

                Tables\Columns\TextColumn::make('fecha_inicio')
                    ->label('Fecha y Hora de Inicio')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_fin')
                    ->label('Fecha y Hora de Fin')
                    ->dateTime()
                    ->sortable(),

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
            'index' => Pages\ListCitas::route('/'),
            'create' => Pages\CreateCita::route('/create'),
            'edit' => Pages\EditCita::route('/{record}/edit'),
        ];
    }
}
