<x-app-layout>
    <div class="container">
        @can('superadmin')
            <div>
                <a href="{{ route('admin.panel') }}" class="btn btn-primary">
                    {{ __('admin.admin_panel') }}
                </a>
            </div>
        @endcan

        @foreach ($projects as $proj)
            <div>
                <a href="{{ route('project.project_view', ['projectname' => $proj->identification_name]) }}"
                >{{ $proj->name }}</a>
            </div>
        @endforeach

        @can('create', \App\Models\Project::class)
            <div>
                <a href="{{ route('project.new') }}" class="btn btn-primary"
                >{{ __('project.create_project') }}</a>
            </div>
        @endcan
    </div>
</x-app-layout>
