<div>
    <form method="POST" action="{{ route('issue.postEdit') }}">
        @csrf
        <input type="hidden" name="board_identification_name"
            value="{{ $board_identification_name }}">
        <input type="hidden" name="project_identification_name"
            value="{{ $project_identification_name }}">
        <input type="hidden" name="issue_status_position"
            value="{{ $issue->status_position }}">
        <input type="hidden" name="issue_status_lane"
            value="{{ $issue->status_position }}">
        
        @if (!empty($issue->local_id)):
            <input type="hidden" name="issue_localid"
                value="{{ $issue->local_id }}">
        @endif

        <div class="mb-3">
            <label for="issue_name">{{ __('project.project_name') }}</label>
            <input type="text" class="input" name="issue_name"
                id="issue_name" value="{{ $issue->name }}">
        </div>

        <div class="mb-3">
            <label for="issue_description">{{ __('common.description') }}</label>
            <textarea class="textarea" name="issue_description" id="issue_description"
                value="{{ $issue->description }}"></textarea>
        </div>
    
        <button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>
    </form>
</div>