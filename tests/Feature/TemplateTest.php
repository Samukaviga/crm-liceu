<?php

use App\Models\School;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('should create a new template', function () {


    $school = School::create([
        'name' => 'Escola Teste',
    ]);

    $this->post('/api/templates', ['name' => 'testing', 'number' => 1235488, 'id_school' => $school->id])
        ->assertStatus(201)
        ->assertJson([
            'message' => 'Template criado com sucesso!',
        ]);

    assertDatabaseCount('templates', 1);

    assertDatabaseHas('templates', ['name' => 'testing', 'number' => 1235488]);
});
