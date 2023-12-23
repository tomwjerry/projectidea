<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\ProjectPermissionService;
use App\Services\Permission;
use Illuminate\Support\Facades\Auth;

class MainDashboardController extends Controller
{
    public function viewMainDashboard()
    {
        $projectIds = ProjectPermissionService::projectsByPermission(
            Auth::id(),
            Permission::ProjectList->value
        );
        $allProjects = Project::whereIn('id', $projectIds)->get();

        return view('dashboard', ['projects' => $allProjects]);
    }
}
