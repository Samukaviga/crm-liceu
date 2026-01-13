<?php

use App\Models\School;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('should create a new template', function () {


    $user = User::factory()->create();

    actingAs($user);

    $school = School::create([
        'name' => 'Escola Teste',
    ]);

    $this->post(route('template.store', [
        'name' => 'testing',
        'number' => 1235488,
        'school_id' => $school->id,
        'type' => 'testing',
        'campaign' => 'testing',
        'category' => 'testing',
    ]))
        ->assertStatus(201)
        ->assertJson([
            'message' => 'Template criado com sucesso!',
        ]);

    assertDatabaseCount('templates', 1);

    assertDatabaseHas('templates', [
        'name' => 'testing',
        'number' => 1235488,
        'type' => 'testing',
        'campaign' => 'testing',
        'category' => 'testing',
    ]);

});
