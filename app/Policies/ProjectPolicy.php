<?php
namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use App\Models\GlobalPermission;
use App\Services\ProjectPermissionService;
use App\Services\Permission;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return count(ProjectPermissionService::projectsByPermission(
            Permission::ProjectList->value)) > 0;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        //
        return ProjectPermissionService::userCanInProject(
            $user->id,
            $project->id,
            Permission::ProjectRead->value
        );
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        $canCreate = GlobalPermission::where('user_id', $user->id)
            ->where('permission_id', Permission::ProjectCreate->value)
            ->first();
        
        return !empty($canCreate);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        //
        return ProjectPermissionService::userCanInProject(
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
        return ProjectPermissionService::userCanInProject(
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
