<?php
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Models\RolePermission;

class ProjectPermissionService
{
    public static function userCanInProject($userId, $projectId, $permission)
    {
        $projPerms = self::getProjectPermission($userId, $projectId);
        if (!empty($projPerms[$permission]))
        {
            return true;
        }

        return false;
    }

    public static function projectsByPermission($userId, $permission)
    {
        $allPerms = self::getAllProjectPermissions($userId);
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

            return $projsWithPerm;
        }
        
        return [];
    }

    public static function getProjectPermission($userId, $projectId)
    {
        $allPerms = self::getAllProjectPermissions($userId);
        if (!empty($allPerms[$projectId]))
        {
            return $allPerms[$projectId];
        }
        
        return [];
    }

    public static function getAllProjectPermissions($userId)
    {
        $cacheKey = 'project_perm_' . $userId;
        $projPermMap = [];

        /*if (Cache::has($cacheKey))
        {
            $projPermMap = json_decode(Cache::get($cacheKey));
        }
        else
        {*/
            $permissions = RolePermission::select(
                    'role_permissions.permission_id',
                    'project_members.project_id'
                )->join(
                    'project_members',
                    function($jq) use($userId)
                    {
                        $jq->on('project_members.role_id', 'role_permissions.role_id')
                            ->where('project_members.user_id', $userId);
                    }
                )
                ->orderBy('project_members.project_id', 'ASC')
                ->orderBy('role_permissions.permission_id', 'ASC')
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
        //}

        return $projPermMap;
    }
}
