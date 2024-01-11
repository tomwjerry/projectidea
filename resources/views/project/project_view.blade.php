<x-app-layout>
    <div class="container">
        @can('create', [App\Models\ProjectBoard::class, $project->id])
            <a href="{{ route('board.new', ['projectname' => $project->identification_name]) }}">{{ __('board.new') }}</a>
        @endcan

        @foreach ($boardList as $board)
            <div>
                <a href="{{ route('board.view', ['projectname' => $project->identification_name, 'boardname' => $board->identification_name]) }}"
                >{{ $board->name }}</a>
            </div>
        @endforeach
    </div>
</x-app-layout>
