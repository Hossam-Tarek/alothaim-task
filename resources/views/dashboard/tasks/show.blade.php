<x-admin.layouts.card>
    <x-slot name="pageTitle">{{ __('Tasks') }}</x-slot>
    <x-slot name="cardHeader">{{ __('Task details') }}</x-slot>

    <p>title: {{ $task->title }}</p>
    <p>description: {{ $task->description }}</p>
    <p>status: {{ $task->status_label }}</p>

    <h4>Assigned to</h4>
    <p>name: {{ $task->assignedTo->name }}</p>
    <p>email: {{ $task->assignedTo->email }}</p>
</x-admin.layouts.card>
