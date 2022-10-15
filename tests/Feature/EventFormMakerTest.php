<?php

namespace Tests\Feature;

use App\Http\Livewire\EventFormMaker;
use App\Models\Event;
use App\Models\EventForm;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EventFormMakerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_should_renders_component_with_existed_forms()
    {
        $event = Event::first();

        $existedForm = $event->form['format'];
        $component = Livewire::test(EventFormMaker::class, ['slug' => $event->slug]);
        $component->assertSet('forms', $existedForm);
    }

    public function test_should_renders_component_with_preset_forms()
    {
        Event::factory()->create();
        $event = Event::latest()->first();
        $component = Livewire::test(EventFormMaker::class, ['slug' => $event->slug]);
        $presetForm = [
			[
				'form_type' => "Text",
				'judul' => '',
				'placeholder' => '',
				'required' => false,
				'value_options' => [
					[
						'text' => '',
						'value' => ''
					]
				]
			]
        ];
        $component->assertSet('forms', $presetForm);

        $event->delete(); //biar gak kesimpen di db aja, jadi didelete
    }

    public function test_should_redirect_after_successfully_update_form()
    {
        $faker = Factory::create();
        $forms = [];
        for ($i=0; $i < 10; $i++) { 
            $forms[] = [
                'form_type' => "Text",
                'judul' => $faker->sentence(),
                'placeholder' => $faker->sentence(),
                'required' => $faker->boolean(),
                'value_options' => [
                    ['text' => '','value' => '']
                    ]
                ];
            }
            
        $event = Event::first();
        Livewire::test(EventFormMaker::class, ['slug' => $event->slug])
            ->set('forms', $forms)
            ->call('updateForm')
            ->assertRedirect("/event/$event->slug");

    }

    public function test_should_redirect_after_successfully_create_form()
    {
        $faker = Factory::create();
        $forms = [];
        for ($i=0; $i < 10; $i++) { 
            $forms[] = [
                'form_type' => "Text",
                'judul' => $faker->sentence(),
                'placeholder' => $faker->sentence(),
                'required' => $faker->boolean(),
                'value_options' => [
                    ['text' => '','value' => '']
                ]
            ];
        }
        
        Event::factory()->create();
        $event = Event::latest()->first();
        Livewire::test(EventFormMaker::class, ['slug' => $event->slug])
            ->set('forms', $forms)
            ->call('createForm')
            ->assertRedirect("/event/$event->slug");

        //biar gak kesimpen di db aja, jadi didelete
        EventForm::latest()->first()->delete(); 
        $event->delete();
    }
}
