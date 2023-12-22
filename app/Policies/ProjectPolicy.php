<?php
namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use App\Models\ProjectMember;
use App\Models\GlobalPermission;
use App\Services\ProjectsService;
use App\Services\Permission;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return count(ProjectsService::projectsByPermission(
            Permission::ProjectList->value)) > 0;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        //
        return ProjectsService::userCanInProject(
            $user->id,
            $project->id,
            Permission::ProjectView->value
        );
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        $canCreate = GlobalPermission::where('user_id', $user->id)
            ->where('permission', Permission::ProjectCreate->value)
            ->first();
        
        return !empty($canCreate);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        //
        return ProjectsService::userCanInProject(
            $user->id,
            $project->id,
            Permission::ProjectEdit->value
        );
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
        //
        return ProjectsService::userCanInProject(
            $user->id,
            $project->id,
            Permission::ProjectDelete->value
        );
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $project): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        //
    }
}
