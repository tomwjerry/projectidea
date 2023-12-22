<x-app-layout>
    <form action="" method="{{ route('post_edit_project') }}">
        @csrf

        <p>Check project creators here</p>

        @foreach ($userList as $user):
            <div>
                <input type="hidden" name="permission[{{ $user->id }}][entry]"
                    value="{{ $user->id }}">
                <label><input type="checkbox"
                    name="permission[{{ $user->id }}][project_create]" value="1"
                    >{{ $user->name }}</label>
            </div>
        @endforeach
        <button type="submit" class="btn primary">Save</button>
    </form>
</x-app-layout>
