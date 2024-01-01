<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectBoard;
use App\Models\ProjectMember;
use App\Models\Role;
use App\Services\ProjectPermissionService;
use App\Services\Permission;
use App\Services\UniqueNameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function viewProjectList()
    {
        $projectIds = ProjectPermissionService::projectsByPermission(
            Auth::id(),
            Permission::ProjectList->value
        );
        $allProjects = Project::whereIn('id', $projectIds)->get();

        return view('project.project_list', ['projects' => $allProjects]);
    }

    public function viewProject($projectname)
    {
        $project = Project::where(
            'identification_name', $projectname)->first();
        $this->authorize('view', $project);

        $boardList = ProjectBoard::where('project_id', $project->id)
            ->get();
            
        $this->authorize('viewAny', [ProjectBoard::class, $project->id]);

        return view('project.project_view',
            ['project' => $project, 'boardList' => $boardList]);
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
        $roles = Role::orderBy('name', 'ASC')
            ->orderBy('id', 'ASC')
            ->get();

        return view('project.project_edit', [
            'project' => $project,
            'roles' => $roles
        ]);
    }

    public function postEdit(Request $req)
    {
        $shouldCreate = false;
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
                ['project', 'board', 'layout', 'boardlayout']
            );
            $shouldCreate = true;
        }

        $project->organization_id = 0;
        $project->name = $req->input('name');
        $project->description = $req->input('description') ?? '';
        $project->image = $req->input('image') ?? '';
        $project->created_by_user_id = Auth::id();
        $project->save();

        if ($shouldCreate)
        {
            $findRole = Role::where('id', $req->input('initial_role'))->first();
            // Create project memeber with your role

            $member = new ProjectMember;
            $member->project_id = $project->id;
            $member->user_id = Auth::id();
            $member->role_id = $findRole->id;
            $member->local_id = ProjectMember::where('project_id', $project->id)
                ->count();
            $member->save();
        }

        return redirect()->route('project.project_view', [
            'projectname' => $project->identification_name]);
    }
}