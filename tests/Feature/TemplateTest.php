<?php

use App\Models\School;
use App\Models\Template;
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
        ->assertRedirect();

    assertDatabaseCount('templates', 1);

    assertDatabaseHas('templates', [
        'name' => 'testing',
        'number' => 1235488,
        'type' => 'testing',
        'campaign' => 'testing',
        'category' => 'testing',
    ]);

});

it('should delete a template', function () {

    $user = User::factory()->create();

    actingAs($user);

    $school = School::create(['name' => 'Escola Teste']);

    $template = Template::create([
        'school_id' => $school->id,
        'name' => 'to be deleted',
        'number' => 987654,
        'type' => 'delete',
        'campaign' => 'delete',
        'category' => 'delete',
    ]);

    $this->delete(route('template.destroy', ['id' => $template->id]))
        ->assertRedirect();

    assertDatabaseCount('templates', 0);

});

it('should update a template', function () {

    $user = User::factory()->create();

    actingAs($user);

    $school = School::create(['name' => 'Escola Teste']);

    $template = Template::create([
        'school_id' => $school->id,
        'name' => 'to be deleted',
        'number' => 987654,
        'type' => 'delete',
        'campaign' => 'delete',
        'category' => 'delete',
    ]);

    $this->put(route('template.update', ['id' => $template->id]), [
        'name' => 'updated name',
        'number' => 111222,

        'campaign' => 'teste',
        'category' => 'updated category',
    ])->assertRedirect();


    assertDatabaseHas('templates', [
        'id' => $template->id,
        'name' => 'updated name',
        'number' => 111222,

        'campaign' => 'teste',
        'category' => 'updated category',
    ]);

    assertDatabaseCount('templates', 1);

});
