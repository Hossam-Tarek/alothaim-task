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
            <th>{{ __("Name") }}</th>
            <th>{{ __("Email") }}</th>
            <th>{{ __("Tasks count") }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->tasks_count }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-admin.layouts.card>
