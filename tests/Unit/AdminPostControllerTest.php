<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;

class AdminPostControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['isAdmin' => true]);
    }

    public function test_admin_can_create_post()
    {
        $response = $this->actingAs($this->admin)
                         ->post(route('admin.posts.store'), $this->postData());
    
        $response->assertRedirect(route('admin.posts.index'));
        $this->assertDatabaseHas('posts', $this->postData());
    }
    
    public function test_admin_can_update_post()
    {
        $post = Post::factory()->create();
        $newPostData = [
            'title' => 'Updated Post Title',
            'content' => 'Updated Post Content',
        ];
    
        $response = $this->actingAs($this->admin)
                         ->put(route('admin.posts.update', $post), $newPostData);
    
        $response->assertRedirect(route('admin.posts.index'));
        $this->assertDatabaseHas('posts', $newPostData);
    }
    
    public function test_admin_can_delete_post()
    {
        $post = Post::factory()->create();
    
        $response = $this->actingAs($this->admin)
                         ->delete(route('admin.posts.destroy', $post));
    
        $response->assertRedirect(route('admin.posts.index'));
        $this->assertDeleted($post);
    }
    

    public function test_admin_can_import_posts()
    {
        Excel::fake();

        $file = UploadedFile::fake()->create('posts.xlsx');

        $response = $this->actingAs($this->admin)
                         ->post(route('admin.posts.import'), ['file' => $file]);

        $response->assertStatus(302);
        Excel::assertImported('posts.xlsx');
    }

    public function test_admin_can_export_posts()
    {
        Excel::fake();

        $response = $this->actingAs($this->admin)
                         ->get(route('admin.posts.export'));

        $response->assertStatus(200);
        Excel::assertDownloaded('posts.xlsx');
    }

    public function test_admin_can_download_posts_as_pdf()
    {
        $posts = Post::factory()->count(5)->create();

        Pdf::shouldReceive('loadView')
            ->once()
            ->with('admin.posts.download-pdf', ['posts' => $posts])
            ->andReturnSelf();
        Pdf::shouldReceive('download')->once();

        $response = $this->actingAs($this->admin)
                         ->get(route('admin.posts.download-pdf'));

        $response->assertStatus(200);
    }

    private function postData()
    {
        return [
            'title' => 'Test Post',
            'content' => 'Test Content',
        ];
    }
}
