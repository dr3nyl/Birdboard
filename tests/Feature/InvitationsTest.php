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
    public function non_owners_may_not_invite_users()
    {
        // I have a project
        $project = ProjectFactory::create();

        $user = User::factory()->create(); // create random user

        $assertInvitationForbidden = function () use($user, $project){

            $this->actingAs($user)
            ->post($project->path(). '/invitations')
            ->assertStatus(403);

        };

        $assertInvitationForbidden();

        $project->invite($user);

        $assertInvitationForbidden();
      
    }


    /** @test */
    public function a_project_owner_can_invite_a_user()
    {
        //$this->withoutExceptionHandling();

        // I have a project
        $project = ProjectFactory::create();

        $userToInvite = User::factory()->create(); // create random user
        
        $this->actingAs($project->owner)->post($project->path(). '/invitations', [

            'email' => $userToInvite->email

        ]); // invite a user

        $this->assertTrue($project->members->contains($userToInvite));

    }

    /** @test */
    public function the_email_address_must_be_associated_with_a_valid_birdboard_account()
    {

        // I have a project
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->post($project->path(). '/invitations', [

            'email' => 'sample@mail.com'

        ])->assertSessionHasErrors([

                'email' => 'the user email is not associated with the system'
            ], null, 'invitations');


    }

    /** @test */
    public function invited_users_may_update_project_details()
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
