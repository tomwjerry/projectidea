<?php
namespace App\Http\Controllers;

use App\Models\BoardLayout;
use App\Models\Issue;
use App\Models\Project;
use App\Models\ProjectBoard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    public function postEdit(Request $req)
    {
        $project = Project::where(
            'identification_name', $req->input('project_identification_name'))
            ->first();
        $board = ProjectBoard::where(
            'identification_name', $req->input('board_identification_name'))
            ->where('project_id', $project->id)
            ->first();
        $issue = null;

        if ($req->has('issue_localid') && !empty($req->input('issue_localid')))
        {
            $issue = Issue::where(
                'local_id', $req->input('issue_localid')
                )
                ->where('project_id', $project->id)
                ->where('board_id', $board->id)
                ->first();
            $this->authorize('edit', $issue);
        }
        else
        {
            $layout = new BoardLayout;
            $layout->local_id = BoardLayout::where(
                'project_id', $project->id)
                ->where('board_id', $board->id)
                ->max('local_id') + 1;
            $layout->layout_position = BoardLayout::where(
                'project_id', $project->id)
                ->where('board_id', $board->id)
                ->max('layout_position') + 1; // Specific to lane
            $layout->lane = 0;
            $layout->defines_lane = 0;
            $layout->project_id = $project->id;
            $layout->board_id = $board->id;
            $this->authorize('create', [BoardLayout::class, $project->id]);
        }
    }
}
