<x-app-layout>
    <form action="" method="{{ route('post_edit_project') }}">
        @csrf
        
        @if (!empty($project->identification_name)):
            <input type="hidden" name="identification_name"
                value="{{ $project->identification_name }}">
        @endif

        <div class="mb-3">
            <label for="name">{{ __('common.name') }}</label>
            <input type="text" class="input" name="name"
                id="name" value="{{ $project->name }}">
        </div>

        <div class="mb-3">
            <label for="description">{{ __('common.description') }}</label>
            <textarea class="textarea" name="description" id="description"
                value="{{ $project->description }}">
        </div>

        <button type="submit" class="btn primary">{{ __('common.save') }}</button>
    </form>
</x-app-layout>
