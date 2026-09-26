<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CapstoneFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** 1. User can register and authenticate */
    public function test_user_can_register_successfully(): void
    {
        $response = $this->post('/register', [
            'name' => 'Cap User',
            'email' => 'capstone@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');
    }

    /** 2. Authenticated user can create a post */
    public function test_authenticated_user_can_create_post(): void
    {
        $user = User::factory()->create();

        $post = Post::create([
            'user_id' => $user->id,
            'title' => 'Capstone Feature Post',
            'content' => 'This is a test post for the capstone project.',
        ]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Capstone Feature Post',
            'user_id' => $user->id,
        ]);
    }

    /** 3. Database returns correct post count */
    public function test_database_returns_posts_list(): void
    {
        $user = User::factory()->create();
        Post::factory()->count(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, Post::all());
    }

    /** 4. User can update an existing post */
    public function test_user_can_update_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $post->update([
            'title' => 'Updated Capstone Title',
            'content' => 'Updated content body.',
        ]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Capstone Title',
        ]);
    }

    /** 5. User can delete a post */
    public function test_user_can_delete_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $post->delete();

        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
    }
}