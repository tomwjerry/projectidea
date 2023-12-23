<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

use App\Services\ProjectPermissionService;
use App\Services\Permission;
use App\Models\GlobalPermission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;

class AdminController extends Controller
{
    public function viewEditGlobalPermissions()
    {
        Gate::authorize('superadmin');

        $usersNPermissions = User::select(
            'users.name',
            'users.id',
            'global_permissions.permission_id'
            )
            ->leftJoin('global_permissions', function($q)
            {
                $q->on('global_permissions.user_id', 'users.id')
                    ->where('global_permissions.permission_id',
                    Permission::ProjectCreate->value);
            })
            ->get();
        
        return view('admin.global_permissions', [
            'userperms' => $usersNPermissions
        ]);
    }

    public function viewEditRolePermissions($role = null)
    {
        Gate::authorize('superadmin');

        // Roles
        $roles = Role::orderBy('name', 'ASC')
            ->orderBy('id', 'ASC')
            ->get()
            ->toArray();
        $roleMap = [];
        foreach ($roles as $rolekey => $role)
        {
            $roles[$rolekey]['permissions'] = [];
            $roleMap[$role['id']] = $rolekey;
        }

        // Permissions
        $permissions = RolePermission::orderBy('role_id', 'ASC')
            ->orderBy('permission_id', 'ASC')
            ->get()
            ->toArray();

        // Map roles to permissions
        foreach ($permissions as $perm)
        {
            if (!isset($roleMap[$perm['role_id']]))
            {
                continue;
            }

            $roles[$roleMap[$perm['role_id']]]['permissions'][] =
                $perm;
        }

        $allPermissions = Permission::cases();

        return view('admin.roles_permissions', [
            'roles' => $roles,
            'permissions' => $allPermissions
        ]);
    }

    public function postEditRolePermissions(Request $req)
    {
        Gate::authorize('superadmin');
        $role = null;
        $alreadyPermission = [];

        if ($req->has('role_id') && !empty($req->input('role_id')))
        {
            $role = Role::find($req->input('role_id'));
            $permissions = RolePermission::where(
                'role_id', $role->id)
                ->get();
            foreach ($permissions as $perm)
            {
                $alreadyPermission[$perm->permission_id] = $perm;
            }
        }
        else
        {
            $role = new Role;
            $role->organization_id = 0;
        }
        $role->name = $req->input('role_name');
        $role->description = $req->input('role_description');
        $role->save();

        if ($req->has('permission') && !empty($req->input('permission')))
        {
            foreach ($req->input('permission') as $permission)
            {
                if (empty($alreadyPermission[$permission]))
                {
                    $rp = new RolePermission;
                    $rp->organization_id = 0;
                    $rp->role_id = $role->id;
                    $rp->permission_id = $permission;
                    $rp->save();
                }
                else
                {
                    $alreadyPermission[$permission] = null;
                }
            }
        }

        foreach ($alreadyPermission as $permission)
        {
            if (!empty($permission))
            {
                $permission->delete();  
            }
        }

        //return redirect()->route('admin.view_role');
    }

    public function postEditGlobalPermissions(Request $req)
    {
        Gate::authorize('superadmin');

        foreach ($req->input('permission') as $user)
        {
            $existingEntries = GlobalPermission::where('global_permissions.user_id', $user['entry'])
                ->get();
            
            $alreadyCanCreate = false;
            foreach ($existingEntries as $entry)
            {
                if ($entry->permission_id == Permission::ProjectCreate->value)
                {
                    $alreadyCanCreate = $entry;
                    break;
                }
            }

            if ($alreadyCanCreate == false && !empty($user['project_create']) &&
                $user['project_create'] ==
                Permission::ProjectCreate->value)
            {
                $newEntry = new GlobalPermission;
                $newEntry->permission_id = Permission::ProjectCreate->value;
                $newEntry->user_id = $user['entry'];
                $newEntry->organization_id = 0;
                $newEntry->save();
                echo 'saved';
            }
            else if ($alreadyCanCreate != false)
            {
                $alreadyCanCreate->delete();
            }
        }

        //return redirect()->route('admin.view_glob_perm');
    }
}
