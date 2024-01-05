<?php
namespace App\Policies;

use App\Models\Project;
use App\Models\Issue;
use App\Models\User;
use App\Models\GlobalPermission;
use App\Services\ProjectPermissionService;
use App\Services\Permission;
use Illuminate\Auth\Access\Response;

class IssuePolicy
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
            Permission::IssueList->value
        );
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Issue $issue): bool
    {
        //
        return ProjectPermissionService::userCanInProject(
            $user->id,
            $issue->project_id,
            Permission::IssueRead->value
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
            Permission::IssueCreate->value
        );
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Issue $issue): bool
    {
        //
        return ProjectPermissionService::userCanInProject(
            $user->id,
            $issue->project_id,
            Permission::IssueEdit->value
        );
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Issue $issue): bool
    {
        //
        return ProjectPermissionService::userCanInProject(
            $user->id,
            $issue->project_id,
            Permission::IssueDelete->value
        );
    }
}
