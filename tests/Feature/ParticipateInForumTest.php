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
        $user = factory('App\User')->create();
        $this->be($user);
        
        // And an existing thread
        $thread = factory('App\Thread')->create();
        
        // When the user adds a reply to the thread 
        $reply = factory('App\Reply')->make();
        $this->post('/threads/' . $thread->id . '/replies', $reply->toArray());
        
        // Then their reply should be visible on the page 
        $this->get('/threads/' . $thread->id)->assertSee($reply->body);
    }

    /** @test */
    public function unauthenticated_user_cannot_add_replies_to_forum_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        
        $this->post('/threads/1/replies', []);
    }    
}
