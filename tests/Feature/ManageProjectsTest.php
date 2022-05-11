<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    // use faker similar to factory, refreshdatabase to refresh every test run is execute
    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */


    /** @test */
    public function guest_cannot_manage_projects()
    {
       // $this->withoutExceptionHandling();

        $project = Project::factory()->create();
        
        $this->get('/projects')->assertRedirect('login');

        $this->get('/projects/create')->assertRedirect('login');

        $this->post('/projects', $project->toArray())->assertRedirect('login');
        
        $this->get($project->path())->assertRedirect('login');
        
    }

    /** @test */
    public function a_user_can_create_a_project()
    {

        // remove default exception handling of laravel to see further warnings/errors
        $this->withoutExceptionHandling();

        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);
        
        $attributes = Project::factory()->raw();


        // expect that we can do post method
        $this->post('/projects', $attributes);

        // expect that we have projects table
        //$this->assertDatabaseHas('projects', $attributes);

        // expect that we can view title field in a page
       // $this->get('/projects')->assertSee($attributes['title']);

    }

    /** @test */
    public function a_user_can_view_their_project()
    {
        $this->withoutExceptionHandling();
        
        $this->signIn();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title);
            //->assertSee($project->description);

    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
       // $this->withoutExceptionHandling();
        
        $this->signIn();

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);

    }


    /** @test */
    public function a_project_requires_a_title()
    {

        $this->signIn();
        
        $attributes = Project::factory()->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');

    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->signIn();
        $attributes = Project::factory()->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
        
    }


}
