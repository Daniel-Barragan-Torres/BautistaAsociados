<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Role;
use App\Models\User;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use League\Csv\Query\Row;
use PhpParser\Node\Stmt\Label;
use App\Traits\RolePermissions;

/* bulk mailing */

use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Facades\Notification as MailNotification;
use Filament\Notifications\Notification as ToastNotification;
use App\Notifications\UserDeletedNotification;

/*  */
class UserResource extends Resource
{

    use RolePermissions;

    //Permisos de rol
    public static function canViewAny(): bool
    {
        return self::hasPermission('can_view_users');
    }

    public static function canCreate(): bool
    {
        return self::hasPermission('can_edit_users');
    }

    public static function canEdit(Model $record): bool
    {
        return self::hasPermission('can_edit_users');
    }

    public static function canDelete(Model $record): bool
    {
        return self::hasPermission('can_delete_users');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return self::hasPermission('can_view_users');
    }

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Personal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Correo')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->label('Cambiar Contraseña')
                    ->password()
                    ->required(fn($livewire) => $livewire instanceof CreateUser)
                    ->afterStateUpdated(function ($state, $livewire) {
                        $livewire->rawPassword = $state; // 💾 Aquí guardas el valor antes del bcrypt
                    })
                    ->dehydrateStateUsing(fn($state) => bcrypt($state))
                    ->dehydrated(fn($state) => filled($state))
                    ->maxLength(45)
                    ->hint('Deja vacío para conservar la contraseña actual')
                    ->suffixIcon('heroicon-o-lock-closed'),


                Forms\Components\Select::make('role_id')
                    ->label('Rol')
                    ->options(Role::pluck('nombre', 'id'))
                    ->required()
                    ->preload()
                    ->hint('Define el rol del usuario')
                    ->suffixIcon('heroicon-o-shield-check'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('password')
                    ->label('Contraseña')
                    ->formatStateUsing(fn() => '************'),
                Tables\Columns\TextColumn::make('role.nombre')
                    ->label('Rol'),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
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
                DeleteBulkAction::make()
                    ->before(function ($records) {
                        $eliminadoPor = auth()->user();
                        $cantidad = count($records);


                        foreach ($records as $usuario) {
                            MailNotification::route('mail', 'adminpass@bautistaasociados.mx')
                                ->notify(new UserDeletedNotification($usuario, $eliminadoPor));
                        }
                        $plural = $cantidad === 1 ? '' : 's';
                        $titulo = $cantidad === 1 ? 'Usuario eliminado' : 'Usuarios eliminados';
                        $mensaje = $cantidad === 1
                            ? "El usuario {$records[0]->name} ha sido eliminado correctamente."
                            : "{$cantidad} usuarios han sido eliminados.";

                        ToastNotification::make()
                            ->title($titulo)
                            ->body($mensaje)
                            ->success()
                            ->send();
                    }),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    /*   public static function canViewAny(): bool
      {
          return auth()->user()?->role?->nombre === 'Admin';
      }

      public static function canCreate(): bool
      {
          return auth()->user()?->role?->nombre === 'Admin';
      } */

}
