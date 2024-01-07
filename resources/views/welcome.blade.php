<x-guest-layout>
    <main class="container">
        @foreach ($publicProjects as $proj)
            <div>
                <a href="{{ route('project.project_view', ['projectname' => $proj->identification_name]) }}"
                >{{ $proj->name }}</a>
            </div>
        @endforeach
    </main>
</x-guest-layout>
