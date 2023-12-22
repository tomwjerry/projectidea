<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\ProjectPermissionService;
use App\Services\UniqueNameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function viewProjectList()
    {
        $projectIds = ProjectPermissionService::projectsByPermission(
            Auth::id(),
            ProjectPermissionService::ProjectList->value
        );
        $allProjects = Project::whereIn('id', $projectIds)->get();

        return view('project.list', ['projects' => $allProjects]);
    }

    public function view($projectname)
    {
        $project = Project::where(
            'identification_name', $projectname)->first();
        $this->authorize('view', $project);

        return view('project.view', ['project' => $project]);
    }

    public function viewEdit($projectname = null)
    {
        $project = null;
        if (empty($projectname) || $projectname == 'new')
        {
            $this->authorize('create', Project::class);
            $project = new Project;
        }
        else
        {
            $project = Project::where(
                'identification_name', $projectname)->first();
            $this->authorize('update', $project);
        }

        return view('project.edit', ['project' => $project]);
    }

    public function postEdit(Request $req)
    {
        $project = null;
        if ($req->has('identification_name') ||
            !empty($req->input('identification_name')))
        {
            $project = Project::where(
                'identification_name', $projectname)->first();
            $this->authorize('update', $project);
        }
        else
        {
            $this->authorize('create', Project::class);
            $project = new Project;
            $project->identification_name = UniqueNameService::generateUniqueName(
                Project::query(),
                $req->input('name'),
                []
            );
        }

        $project->name = $req->input('name');
        $project->description = $req->input('description');
        $project->save();

        return redirect()->route('project.view', [
            'projectname' => $project->identification_name]);
    }
}