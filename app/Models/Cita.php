<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [

        'asunto',
        'cliente_id',
        'fecha_inicio',
        'fecha_fin',

    ];




    public function cliente()
    {
        return $this->belongsTo(Cliente::class);

    }

    public $timestamps = false;
}
