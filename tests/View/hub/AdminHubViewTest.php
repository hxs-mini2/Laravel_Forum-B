<?php

namespace Tests\View\hub;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminHubViewTest extends TestCase
{
    use RefreshDatabase;

    private $admin;
    private $threads;

    public function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();

        $this->threads = [
            array(
                'id' => 1,
                'thread_id' => 'hogehoge',
                'thread_name' => 'hoge',
                'user_email' => 'hoge@example.com',
                'created_at' => now(),
                'updated_at' => null
            ),
            array(
                'id' => 2,
                'thread_id' => 'fugafuga',
                'thread_name' => 'fuga',
                'user_email' => 'fuga@example.com',
                'created_at' => now(),
                'updated_at' => null
            ),
            array(
                'id' => 3,
                'thread_id' => 'piyopiyo',
                'thread_name' => 'piyo',
                'user_email' => 'piyo@example.com',
                'created_at' => now(),
                'updated_at' => null
            )
        ];
    }

    public function test_hub_view_have_hub_CreateThread_form()
    {
        $view = $this
            ->actingAs($this->admin)
            ->view('hub', [
                'tables' => $this->threads,
                'url' => url('/')
            ]);

        $view->assertSee('hub_CreateThread_form');
    }

    public function test_hub_view_have_hub_new_threadName_text()
    {
        $view = $this
            ->actingAs($this->admin)
            ->view('hub', [
                'tables' => $this->threads,
                'url' => url('/')
            ]);

        $view->assertSee('hub_new_threadName_text');
    }

    public function test_hub_view_have_hub_create_thread_btn()
    {
        $view = $this
            ->actingAs($this->admin)
            ->view('hub', [
                'tables' => $this->threads,
                'url' => url('/')
            ]);

        $view->assertSee('hub_create_thread_btn');
    }

    public function test_hub_view_have_hub_thread_actions_form()
    {
        $view = $this
            ->actingAs($this->admin)
            ->view('hub', [
                'tables' => $this->threads,
                'url' => url('/')
            ]);

        $view->assertSee('hub_thread_actions_form');
    }

    public function test_hub_view_have_hub_thread_id_text()
    {
        $view = $this
            ->actingAs($this->admin)
            ->view('hub', [
                'tables' => $this->threads,
                'url' => url('/')
            ]);

        $view->assertSee('hub_thread_id_text');
    }

    public function test_hub_view_have_hub_DeleteThread_Modal()
    {
        $view = $this
            ->actingAs($this->admin)
            ->view('hub', [
                'tables' => $this->threads,
                'url' => url('/')
            ]);

        $view->assertSee('hub_DeleteThread_Modal');
    }

    public function test_hub_view_have_hub_delete_thread_btn()
    {
        $view = $this
            ->actingAs($this->admin)
            ->view('hub', [
                'tables' => $this->threads,
                'url' => url('/')
            ]);

        $view->assertSee('hub_delete_thread_btn');
    }

    public function test_hub_view_have_hub_EditThread_Modal()
    {
        $view = $this
            ->actingAs($this->admin)
            ->view('hub', [
                'tables' => $this->threads,
                'url' => url('/')
            ]);

        $view->assertSee('hub_EditThread_Modal');
    }

    public function test_hub_view_have_hub_edit_thread_form()
    {
        $view = $this
            ->actingAs($this->admin)
            ->view('hub', [
                'tables' => $this->threads,
                'url' => url('/')
            ]);

        $view->assertSee('hub_edit_thread_form');
    }

    public function test_hub_view_have_hub_edit_ThreadName_text()
    {
        $view = $this
            ->actingAs($this->admin)
            ->view('hub', [
                'tables' => $this->threads,
                'url' => url('/')
            ]);

        $view->assertSee('hub_edit_ThreadName_text');
    }

    public function test_hub_view_have_hub_edit_thread_btn()
    {
        $view = $this
            ->actingAs($this->admin)
            ->view('hub', [
                'tables' => $this->threads,
                'url' => url('/')
            ]);

        $view->assertSee('hub_edit_thread_btn');
    }

    public function test_hub_view_have_jQuery()
    {
        $TextView = (string) $this
            ->actingAs($this->admin)
            ->view('hub', [
                'tables' => $this->threads,
                'url' => url('/')
            ]);

        if (strpos($TextView, '<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>') !== false) {
            $this->assertAuthenticated($this->admin = null);
        } else {
            $this->assertGuest($this->admin = null);
        }
    }

    public function test_hub_view_have_url()
    {
        $TextView = (string) $this
            ->actingAs($this->admin)
            ->view('hub', [
                'tables' => $this->threads,
                'url' => url('/')
            ]);

        $text = 'const url = "' . (string) url('/') . '";';

        if (strpos($TextView, $text) !== false) {
            $this->assertAuthenticated($this->admin = null);
        } else {
            $this->assertGuest($this->admin = null);
        }
    }

    public function test_hub_view_have_js()
    {
        $TextView = (string) $this
            ->actingAs($this->admin)
            ->view('hub', [
                'tables' => $this->threads,
                'url' => url('/')
            ]);

        $text = '<script src="/js/app_jquery.js"></script>';

        if (strpos($TextView, $text) !== false) {
            $this->assertAuthenticated($this->admin = null);
        } else {
            $this->assertGuest($this->admin = null);
        }
    }
}
