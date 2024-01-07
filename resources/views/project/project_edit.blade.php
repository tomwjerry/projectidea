<x-app-layout>
    <div class="container layout common form">
        <form action="{{ route('project.post_edit') }}" method="POST">
            @csrf
            
            @if (!empty($project->identification_name)):
                <input type="hidden" name="identification_name"
                    value="{{ $project->identification_name }}">
            @endif

            <div class="mb-3">
                <label for="name">{{ __('project.project_name') }}</label>
                <input type="text" class="input" name="name"
                    id="name" value="{{ $project->name }}">
            </div>

            <div class="mb-3">
                <label for="description">{{ __('common.description') }}</label>
                <textarea class="textarea" name="description" id="description"
                    value="{{ $project->description }}"></textarea>
            </div>

            <div class="mb-3">
                <label for="initial_role">{{ __('project.project_name') }}</label>
                <select class="select" name="initial_role"
                    id="initial_role">
                    @foreach ($roles as $role):
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
            </div>

            <button type="submit" class="btn primary">{{ __('common.save') }}</button>
        </form>
    </div>
</x-app-layout>
