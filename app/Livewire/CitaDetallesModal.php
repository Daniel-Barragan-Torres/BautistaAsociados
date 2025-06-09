<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cita;

class CitaDetallesModal extends Component
{


    public $cita;
    public $modalOpen = false;

    protected $listeners = ['mostrarCita'];

    public function mostrarCita($id)
    {
        $this->cita = Cita::with('cliente')->find($id);
        $this->modalOpen = true;
    }

    public function cerrarModal()
    {
        $this->modalOpen = false;
    }
    public function render()
    {
        return view('livewire.cita-detalles-modal');
    }
}
