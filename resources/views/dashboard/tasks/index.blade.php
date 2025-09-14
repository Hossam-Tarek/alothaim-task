<x-admin.layouts.card>
    <x-slot name="pageTitle">{{ __('Tasks') }}</x-slot>
    <x-slot name="cardHeader">
        <a href="{{ route('admin.tasks.create') }}" class="btn btn-secondary float-right"><i class="fas fa-plus"></i><span class="mx-2"> {{ __('Add Task') }}</span></a>
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item active">{{ __('Tasks') }}</li>
    </x-slot>


    <table class="table table-bordered table-hover table-striped">
        <thead>
        <tr>
            <th>{{ __("Title") }}</th>
            <th>{{ __("Description") }}</th>
            <th>{{ __("Assigned name") }}</th>
            <th>{{ __("Admin name") }}</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->assignedTo->name }}</td>
                <td>{{ $task->assignedBy->name }}</td>
                <td>
                    <a href="{{ route("admin.tasks.edit", $task) }}" class="btn btn-secondary"
                    >{{ __("Edit") }}</a>
                </td>
                <td>
                    <form action="{{ route("admin.tasks.destroy", $task) }}" method="POST">
                        @csrf
                        @method("delete")
                        <input type="submit" name="delete" value="{{ __("Delete") }}" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="my-2">
        {{ $tasks->links('pagination::bootstrap-4') }}
    </div>

</x-admin.layouts.card>
