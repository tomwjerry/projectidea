<x-app-layout>
    <form action="{{ route('admin.post_glob_perm') }}" method="POST">
        @csrf

        <p>Check project creators here</p>

        @foreach ($userperms as $user)
            <div>
                <input type="hidden" name="permission[{{ $user->id }}][entry]"
                    value="{{ $user->id }}"{{ empty($user->permission_id) ? '' : ' checked' }}>
                <label><input type="checkbox"
                    name="permission[{{ $user->id }}][project_create]" value="3"
                    >{{ $user->name }}</label>
            </div>
        @endforeach
        <button type="submit" class="btn primary">Save</button>
    </form>
</x-app-layout>
