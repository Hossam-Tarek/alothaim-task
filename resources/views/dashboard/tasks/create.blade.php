<x-admin.layouts.card>
    <x-slot name="pageTitle">{{ __('Tasks') }}</x-slot>
    <x-slot name="cardHeader">{{ __('Add Task') }}</x-slot>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <x-form.input name="title" value="{{ old('title') }}" maxlength="255">{{ __('Title') }}</x-form.input>
        <x-form.textarea name="description" value="{{ old('description') }}">{{ __('Description') }}</x-form.textarea>

        <div class="form-group">
            <label for="status">{{ __('Assign to') }}</label>
            <select name="status" id="status" class="form-control @error("status") is-invalid @enderror">
                @foreach(\App\Enums\TaskStatusEnum::cases() as $case)
                    <option value="{{ $case->value }}" {{ old('status') == $case->value ? 'selected': '' }}>{{ $case->label() }}</option>
                @endforeach
            </select>

            @error("status")
            <p class="help text-danger">{{ $errors->first("status") }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="assigned_to_id">{{ __('Assign to') }}</label>
            <select name="assigned_to_id" id="assigned_to_id" class="form-control @error("assigned_to_id") is-invalid @enderror">
                <option value="">{{ __('Select User') }}</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('assigned_to_id') == $user->id ? 'selected': '' }}>{{ $user->name }} - {{ $user->email }}</option>
                @endforeach
            </select>

            @error("assigned_to_id")
            <p class="help text-danger">{{ $errors->first("assigned_to_id") }}</p>
            @enderror
        </div>

        <x-form.submit redirectRoute="{{ route('tasks.store') }}">{{ __('Create') }}</x-form.submit>
    </form>
</x-admin.layouts.card>
