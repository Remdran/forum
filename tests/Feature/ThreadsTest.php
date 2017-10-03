<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;

    protected $thread;

    public function setUp()
    {
        parent::setUp();
        
        $this->thread = factory('App\Thread')->create();
    }
    
    /** @test */
    public function a_user_can_view_all_threads()
    {
        $this->get('/threads')->assertSee($this->thread->title);
    }
    
    /** @test */
    public function a_user_can_read_a_single_thread()
    {
        $this->get($this->thread->path())->assertSee($this->thread->title);
    }
    
    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        // Given we have a thread (given to us by the setUp() method)
        
        // And that thread includes replies
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        
        // When we visit a thread page
        // We should see the replies
        $this->get($this->thread->path())->assertSee($reply->body);
    }


}
