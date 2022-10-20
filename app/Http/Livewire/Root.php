<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Root extends Component
{
    //TODO: implementasikan logic root
    public function render()
    {
        return view('livewire.admin.root')
            ->extends('layouts.app') //ini kodingannya jalan ya, cuma entah kenapa error
			->section('content');;
    }
}
