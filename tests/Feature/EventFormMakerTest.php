<?php

namespace Tests\Feature;

use App\Http\Livewire\EventFormMaker;
use App\Models\Event;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $event = Event::find(1);
        $component = Livewire::test(EventFormMaker::class, ['slug' => $event->slug]);
        $existedForm = $event->form->toArray();
        $component->assertSet('forms', $existedForm['format']);
    }

    public function test_should_renders_component_with_preset_forms()
    {
        $event = Event::find(20);
        $component = Livewire::test(EventFormMaker::class, ['slug' => $event->slug]);
        $presetForm = [
			[
				'form_type_id' => "1",
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
    }

    public function test_should_redirect_after_successfully_update_form()
    {
        
        $faker = Factory::create();
        $forms = [];
        for ($i=0; $i < 10; $i++) { 
            $forms[] = [
                'form_type_id' => "1",
                'judul' => $faker->sentence(),
                'placeholder' => $faker->sentence(),
                'required' => $faker->boolean(),
                'value_options' => [
                    ['text' => '','value' => '']
                    ]
                ];
            }
            
        $event = Event::find(1);
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
                'form_type_id' => "1",
                'judul' => $faker->sentence(),
                'placeholder' => $faker->sentence(),
                'required' => $faker->boolean(),
                'value_options' => [
                    ['text' => '','value' => '']
                ]
            ];
        }
            
        $event = Event::find(20);
        Livewire::test(EventFormMaker::class, ['slug' => $event->slug])
            ->set('forms', $forms)
            ->call('createForm')
            ->assertRedirect("/event/$event->slug");

    }
}
