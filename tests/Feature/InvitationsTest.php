<?php

namespace Tests\Feature;

use App\Models\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function a_project_can_invite_user()
    {
        // I have a project
        $project = ProjectFactory::create();

        // Project invites another user
        $project->invite($newUser = User::factory()->create());

        // invited user has permission to the project
        $this->signIn($newUser);
        $this->post($project->path(). '/tasks', $task= ['body' => 'Foo task']);

        $this->assertDatabaseHas('tasks', $task);


    }
}
