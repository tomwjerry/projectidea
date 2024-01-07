<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\ProjectPermissionService;
use App\Services\Permission;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function viewWelcome()
    {
        $projectIds = ProjectPermissionService::projectsByPermission(
            Auth::id(),
            Permission::ProjectList->value
        );
        $allProjects = Project::where('is_public', 1)
            ->whereIn('id', $projectIds)
            ->get();

        return view('welcome', ['publicProjects' => $allProjects]);
    }
}
