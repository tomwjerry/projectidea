<?php
namespace App\Policies;

use App\Models\Project;
use App\Models\ProjectBoard;
use App\Models\User;
use App\Services\ProjectPermissionService;
use App\Services\Permission;

class ProjectBoardPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user, $projectId): bool
    {
        //
        return ProjectPermissionService::userCanInProject(
            $user->id ?? null,
            $projectId,
            Permission::ProjectBoardList->value
        );
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, ProjectBoard $board): bool
    {
        //
        return ProjectPermissionService::userCanInProject(
            $user->id ?? null,
            $board->project_id,
            Permission::ProjectBoardRead->value
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
            Permission::ProjectBoardCreate->value
        );
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ProjectBoard $board): bool
    {
        //
        return ProjectPermissionService::userCanInProject(
            $user->id,
            $board->project_id,
            Permission::ProjectBoardEdit->value
        );
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ProjectBoard $board): bool
    {
        //
        return ProjectPermissionService::userCanInProject(
            $user->id,
            $board->project_id,
            Permission::ProjectBoardDelete->value
        );
    }
}
