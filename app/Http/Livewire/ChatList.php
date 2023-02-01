<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChatList extends Component
{
	public $mensajes;

	protected $listeners = ["mensajerecibido"];

	public function mount()
	{
		$this->mensajes=[];
	}

	public function mensajerecibido($mensaje){
		$this->mensajes[]=$mensaje;
	}
    public function render()
    {
        return view('livewire.chat-list');
    }
}
