<?php
namespace App\Policies;

use App\Models\Project;
use App\Models\BoardLayout;
use App\Models\User;
use App\Models\GlobalPermission;
use App\Services\ProjectPermissionService;
use App\Services\Permission;
use Illuminate\Auth\Access\Response;

class ProjectBoardPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, $projectId): bool
    {
        //
        return ProjectPermissionService::userCanInProject(
            $user->id,
            $project_id,
            Permission::BoardLayoutList->value
        );
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BoardLayout $layout): bool
    {
        //
        return ProjectPermissionService::userCanInProject(
            $user->id,
            $layout->project_id,
            Permission::BoardLayoutRead->value
        );
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, $projectId): bool
    {   
        return ProjectPermissionService::userCanInProject(
            $user->id,
            $projectId,
            Permission::BoardLayoutCreate->value
        );
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BoardLayout $layout): bool
    {
        //
        return ProjectPermissionService::userCanInProject(
            $user->id,
            $layout->project_id,
            Permission::BoardLayoutEdit->value
        );
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BoardLayout $layout): bool
    {
        //
        return ProjectPermissionService::userCanInProject(
            $user->id,
            $layout->project_id,
            Permission::BoardLayoutDelete->value
        );
    }
}
