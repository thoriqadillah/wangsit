<?php

namespace Tests\Feature;

use App\Http\Livewire\Root;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RootTest extends TestCase
{
    //TODO: buat test root
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_see_root_admin_page()
    {
        $this->get('/admin/root')->assertOk();
    }
}
