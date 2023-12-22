<x-app-layout>
    <form action="{{ route('admin.post_role') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="role_id">{{ __('admin.select_role') }}</label>
            <select name="role_id" id="role_id" class="select">
                <option value="">{{ __('admin.new_role') }}</option>
                @foreach ($roles as $role):
                    <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="role_name">{{ __('admin.role_name') }}</label>
            <input type="text" name="role_name" id="role_name" class="input">
        </div>

        <div class="mb-3">
            <label for="role_description">{{ __('admin.role_description') }}</label>
            <textarea name="role_description" id="role_description" class="textarea"></textarea>
        </div>

        <h2>{{ __('admin.permissions') }}</h2>
        <div id="permissionList">
            @foreach ($permissions as $permission)
                <div>
                    <label><input type="checkbox" name="permission[{{ $permission->value }}]"
                        value="{{ $permission->value }}"> {{ $permission->name }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn primary">{{ __('common.save') }}</button>
    </form>

    <x-slot:script>
        <script>
            const rolesPermissions = @json($roles);

            const roleSel = document.getElementById('role_id');
            roleSel.addEventListener('change', function() {
                const findRolePermssion = rolesPermissions.find(role => role.id == roleSel.value);
                const permissonList = document.querySelectorAll('#permissionList input[type="checkbox"]');
                for (let cb of permissonList) {
                    cb.checked = false;
                }

                if (findRolePermssion) {
                    document.getElementById('role_name').value = findRolePermssion.name;
                    document.getElementById('role_description').value = findRolePermssion.description;

                    if (findRolePermssion.permissions &&
                        findRolePermssion.permissions.length) {
                        for (let perm of findRolePermssion.permissions) {
                            document.querySelector('#permissionList input[type="checkbox"][value="' +
                                perm.permission_id + '"]').checked = true;
                        }
                    }
                } else {
                    document.getElementById('role_name').value = '';
                    document.getElementById('role_description').value = '';
                }
            });
        </script>
    </x-slot>
</x-app-layout>
