<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enums\TaskStatusEnum;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_guest_cannot_access_task_routes()
    {
        $task = Task::factory()->create();

        $this->get(route('tasks.index'))->assertRedirect(route('login'));
        $this->get(route('tasks.create'))->assertRedirect(route('login'));
        $this->post(route('tasks.store'))->assertRedirect(route('login'));
        $this->get(route('tasks.show', $task))->assertRedirect(route('login'));
        $this->get(route('tasks.edit', $task))->assertRedirect(route('login'));
        $this->put(route('tasks.update', $task))->assertRedirect(route('login'));
        $this->delete(route('tasks.destroy', $task))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_view_tasks_index()
    {
        $task = Task::factory()->create(['assigned_to_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->get(route('tasks.index'));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.tasks.index');
        $response->assertSee($task->title);
    }

    public function test_authenticated_user_can_view_create_form()
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.tasks.create');
        $response->assertViewHas('users');
    }

    public function test_authenticated_user_can_store_task()
    {
        $data = [
            'title' => 'My Task',
            'description' => 'Some description',
            'status' => TaskStatusEnum::PENDING->value,
            'assigned_to_id' => $this->user->id,
        ];

        $response = $this->actingAs($this->user)->post(route('tasks.store'), $data);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_store_task_fails_with_invalid_data()
    {
        $response = $this->actingAs($this->user)->post(route('tasks.store'), []);

        $response->assertSessionHasErrors(['title', 'description', 'status', 'assigned_to_id']);
        $this->assertDatabaseCount('tasks', 0);
    }

    public function test_authenticated_user_can_view_task()
    {
        $task = Task::factory()->create(['assigned_to_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->get(route('tasks.show', $task));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.tasks.show');
        $response->assertSee($task->title);
    }

    public function test_authenticated_user_can_view_edit_form()
    {
        $task = Task::factory()->create(['assigned_to_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->get(route('tasks.edit', $task));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.tasks.edit');
        $response->assertViewHas(['task', 'users']);
    }

    public function test_authenticated_user_can_update_task()
    {
        $task = Task::factory()->create(['assigned_to_id' => $this->user->id]);

        $data = [
            'title' => 'Updated Task',
            'description' => 'Updated description',
            'status' => TaskStatusEnum::IN_PROGRESS->value,
            'assigned_to_id' => $this->user->id,
        ];

        $response = $this->actingAs($this->user)->put(route('tasks.update', $task), $data);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Task',
            'description' => 'Updated description',
            'status' => TaskStatusEnum::IN_PROGRESS->value,
            'assigned_to_id' => $this->user->id,
        ]);
    }

    public function test_authenticated_user_can_delete_task()
    {
        $task = Task::factory()->create(['assigned_to_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->delete(route('tasks.destroy', $task));

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_store_fails_when_title_is_not_unique()
    {
        Task::factory()->create([
            'title' => 'Duplicate Title',
            'assigned_to_id' => $this->user->id,
        ]);

        $data = [
            'title' => 'Duplicate Title',
            'description' => 'Some description',
            'status' => TaskStatusEnum::PENDING->value,
            'assigned_to_id' => $this->user->id,
        ];

        $response = $this->actingAs($this->user)->post(route('tasks.store'), $data);

        $response->assertSessionHasErrors('title');
        $this->assertDatabaseCount('tasks', 1);
    }

    public function test_store_fails_when_title_is_too_long()
    {
        $data = [
            'title' => str_repeat('A', 256),
            'description' => 'Some description',
            'status' => TaskStatusEnum::PENDING->value,
            'assigned_to_id' => $this->user->id,
        ];

        $response = $this->actingAs($this->user)->post(route('tasks.store'), $data);

        $response->assertSessionHasErrors('title');
        $this->assertDatabaseCount('tasks', 0);
    }

    public function test_store_fails_when_status_is_invalid()
    {
        $data = [
            'title' => 'Invalid Status Task',
            'description' => 'Some description',
            'status' => 999,
            'assigned_to_id' => $this->user->id,
        ];

        $response = $this->actingAs($this->user)->post(route('tasks.store'), $data);

        $response->assertSessionHasErrors('status');
        $this->assertDatabaseCount('tasks', 0);
    }

    public function test_store_fails_when_assigned_user_does_not_exist()
    {
        $data = [
            'title' => 'Task With Invalid User',
            'description' => 'Some description',
            'status' => TaskStatusEnum::PENDING->value,
            'assigned_to_id' => 9999,
        ];

        $response = $this->actingAs($this->user)->post(route('tasks.store'), $data);

        $response->assertSessionHasErrors('assigned_to_id');
        $this->assertDatabaseCount('tasks', 0);
    }
}
