<x-app-layout>
    <div class="container">
        <div id="board_name_field">
            <div class="edit{{ empty($board->identification_name) ? '' : ' d-none' }}">
                <form id="board_form" action="{{ route('board.post_edit') }}"
                    method="POST">
                    @csrf
                    @if (!empty($board->identification_name))
                        <input type="hidden" name="identification_name"
                            value="{{ $board->identification_name }}">
                    @endif
                    <input type="hidden" name="project_identification_name"
                        value="{{ $project->identification_name }}">
                    <div>
                        <label for="board_name">{{ __('board.board_name') }}</label>
                        <input type="text" class="input"
                            name="board_name" id="board_name"
                            value="{{ $board->name }}">
                    </div>
                    <div>
                        <label for="board_description">{{ __('board.board_description') }}</label>
                        <textarea class="input" name="board_description"
                            id="board_description">{{ $board->description }}</textarea>
                    </div>
                    <button type="submit" class="btn">{{ __('common.save') }}</button>
                </form>
            </div>
            <div class="view">
                <h1>{{ $board->name }}</h1>
                <button type="button" class="btn toggle-edit">{{ __('common.edit') }}</button>
                <div>{{ $board->description }}</div>
            </div>
        </div>

        <div class="board_layout flex">
            @foreach ($layoutItemList as $layoutIndex => $layoutItem)
                <div class="mr-3 flex-grow">
                    <div id="layout_title_field">
                        <div class="edit d-none">
                            <form id="layout_form" action="{{ route('boardlayout.post_edit') }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="board_identification_name"
                                    value="{{ $board->identification_name }}">
                                <input type="hidden" name="project_identification_name"
                                    value="{{ $project->identification_name }}">
                                @if (!empty($layoutItem->local_id))
                                    <input type="hidden" name="layout_localid"
                                        value="{{ $layoutItem->local_id }}">
                                @endif
                                <div>
                                    <label for="layout_name_{{  $layoutIndex }}">{{ __('board.layout_name') }}</label>
                                    <input type="text" class="input"
                                        name="layout_name" id="layout_name_{{  $layoutIndex }}"
                                        value="{{ $layoutItem->name }}">
                                </div>
                                <div>
                                    <label for="layout_description">{{ __('board.layout_description') }}</label>
                                    <textarea class="input"
                                        name="layout_description_{{  $layoutIndex }}"
                                        id="layout_description_{{  $layoutIndex }}">{{ $layoutItem->description }}</textarea>
                                </div>
                                <button type="submit" class="btn">{{ __('common.save') }}</button>
                            </form>
                        </div>
                        <div class="view">
                            <h2>{{ $layoutItem->name }}</h2>
                            @if (empty($layoutItem->local_id))
                                <button type="button" class="btn toggle-edit">{{ __('common.new') }}</button>
                            @else
                                <button type="button" class="btn toggle-edit">{{ __('common.edit') }}</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <x-slot:script>
        <script>
            const toggleBtns = 
                document.querySelectorAll('.toggle-edit');
            function toggleEdit(e) {
                e.target.parentNode.parentNode.querySelector('.edit')
                    .classList.toggle('d-none');
            }
            for (let btn of toggleBtns) {
                btn.addEventListener('click', toggleEdit);
            }
        </script>
    </x-slot:script>
</x-app-layout>
