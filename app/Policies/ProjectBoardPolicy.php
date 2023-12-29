<?php
namespace App\Policies;

use App\Models\Project;
use App\Models\ProjectBoard;
use App\Models\User;
use App\Models\ProjectMember;
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
            Permission::ProjectBoardList->value
        );
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ProjectBoard $board): bool
    {
        //
        return ProjectPermissionService::userCanInProject(
            $user->id,
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
