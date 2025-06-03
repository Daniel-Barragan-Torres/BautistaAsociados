<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{

    use HasFactory;

    protected $fillable = ['nombre', 'correo', 'lada', 'telefono'];


    protected $table =
        'clientes';

    public $timestamps = false;

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
