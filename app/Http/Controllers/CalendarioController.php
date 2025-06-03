<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\JsonResponse;

class CalendarioController extends Controller
{
    public function eventos(): JsonResponse
    {
        // Obtener todas las citas con relación al cliente
        $citas = Cita::with('cliente')->get();

        // Formatear cada cita para FullCalendar
        $eventos = $citas->map(function (Cita $cita) {
            return [
                'id' => $cita->id,
               // 'title' => $cita->asunto . ' - ' . $cita->cliente->nombre,
                'title' =>$cita->cliente->nombre,
                'start' => $cita->fecha_inicio,
                'end' => $cita->fecha_fin,
            ];
        });

        return response()->json($eventos);
    }
}
