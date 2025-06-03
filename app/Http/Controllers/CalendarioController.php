<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
                'title' => $cita->cliente->nombre,
                'start' => $cita->fecha_inicio,
                'end' => $cita->fecha_fin,
            ];
        });

        return response()->json($eventos);
    }

    public function eventosdet(Request $request): JsonResponse
    {
        // Validar que venga el ID
        $id = $request->query('id');

        if (!$id) {
            return response()->json(['error' => 'ID no proporcionado'], 400);
        }

        // Buscar la cita con su cliente
        $cita = Cita::with('cliente')->find($id);

        if (!$cita) {
            return response()->json(['error' => 'Cita no encontrada'], 404);
        }

        // Retornar solo esa cita
        return response()->json([
            'id' => $cita->id,
            'cliente' => $cita->cliente->nombre,
            'asunto' => $cita->asunto,
            'start' => $cita->fecha_inicio,
            'end' => $cita->fecha_fin,
        ]);
    }
}
