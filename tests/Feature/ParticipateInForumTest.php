<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_participate_in_forum_threads()
    {
        // Given we have an authenticated user
        $this->signIn();
        
        // And an existing thread
        $thread = create('App\Thread');
        
        // When the user adds a reply to the thread 
        $reply = factory('App\Reply')->make();
        $this->post($thread->path() . '/replies', $reply->toArray());
        
        // Then their reply should be visible on the page 
        $this->get($thread->path())->assertSee($reply->body);
    }

    /** @test */
    public function unauthenticated_user_cannot_add_replies_to_forum_threads()
    {
        $this->withExceptionHandling()
            ->post('/threads/some-channel/1/replies', [])
            ->assertRedirect('/login');
    }    

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }
}
