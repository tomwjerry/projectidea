<x-app-layout>
    <div class="container">
        <a href="{{ route('board.new', ['projectname' => $project->identification_name]) }}">{{ __('board.new') }}</a>
    </div>
</x-app-layout>
