<?php
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Models\RolePermission;

enum Permission: int
{
    case ProjectList = 1;
    case ProjectRead = 2;
    case ProjectCreate = 3;
    case ProjectEdit = 3;
    case ProjectDelete = 4;

    case MemberList = 21;
    case MemberRead = 22;
    case MemberCreate = 23;
    case MemberEdit = 23;
    case MemberDelete = 24;

    case IssueList = 41;
    case IssueRead = 42;
    case IssueCreate = 43;
    case IssueEdit = 43;
    case IssueDelete = 44;

    case DashboardList = 101;
    case DashboardRead = 102;
    case DashboardCreate = 103;
    case DashboardEdit = 103;
    case DashboardDelete = 104;
}

class ProjectPermissionService
{
    public static userCanInProject($userId, $projectId, $permission)
    {
        $projPerms = getProjectPermission($userId, $projectId);
        if (!empty($projPerms[$permission]))
        {
            return true;
        }

        return false;
    }

    public static projectsByPermission($userId, $permission)
    {
        $allPerms = $this->getAllProjectPermission();
        if (!empty($allPerms) && count($allPerms) > 0)
        {
            $projsWithPerm = [];
            foreach ($allPerms as $projectId => $perms)
            {
                if (!empty($perms[$permission]))
                {
                    $projsWithPerm[] = $projectId;
                }
            }
        }
        
        return [];
    }

    public static getProjectPermission($userId, $projectId)
    {
        $allPerms = $this->getAllProjectPermission();
        if (!empty($allPerms[$projectId]))
        {
            return $allPerms[$projectId];
        }
        
        return [];
    }

    public static getAllProjectPermissions($userId)
    {
        $cacheKey = 'project_perm_' . $userId;
        $projPermMap = [];

        if (Cache::has($cacheKey))
        {
            $projPermMap = json_decode(Cache::get($cacheKey));
        }
        else
        {
            $permissions = RolePermission::select(
                    'role_permission.permission_id',
                    'project_members.project_id'
                )->innerJoin(
                    'project_members',
                    function($jq) use($member)
                    {
                        $jq->on('project_members.role_id', 'role_permission.role_id')
                            ->on('project_members.user_id', $userId);
                    }
                )
                ->orderBy('project_members.project_id', 'ASC')
                ->orderBy('role_permission.permission_id', 'ASC')
                ->get();
            
            $projPermMap = [];
            foreach ($permissions as $perm)
            {
                if (empty($projPermMap[$perm->project_id]))
                {
                    $projPermMap[$perm->project_id] = [];
                }
                $projPermMap[$perm->project_id][$perm->permission_id] =
                    $perm->permission_id;
            }
            
            Cache::put($cacheKey, json_encode($projPermMap), 10);
        }

        return $projPermMap;
    }
}
