<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavouritesTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function guests_can_not_favourite_anything()
    {
        $this->withExceptionHandling()
            ->post('replies/1/favourites')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_favourite_any_reply()
    {
        $this->signIn();
        $reply = create('App\Reply');

        $this->post('replies/' . $reply->id . '/favourites');

        $this->assertCount(1, $reply->favourites);
    }

    /** @test */
    public function an_authenticated_user_may_only_favourite_a_reply_once()
    {
        $this->signIn();
        $reply = create('App\Reply');

        try {
            $this->post('replies/' . $reply->id . '/favourites');
            $this->post('replies/' . $reply->id . '/favourites');
        } catch (\Exception $e) {
            $this->fail('Cant enter the same record twice');
        }

        $this->assertCount(1, $reply->favourites);
    }
}