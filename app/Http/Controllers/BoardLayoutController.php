<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectBoard;
use App\Models\BoardLayout;

class BoardLayoutController extends Controller
{
    public function postEdit(Request $req)
    {
        $project = Project::where(
            'identification_name', $req->input('project_identification_name'))
            ->first();
        $board = ProjectBoard::where(
            'identification_name', $req->input('board_identification_name'))
            ->where('project_id', $board->project_id)
            ->first();
        
        $layout = null;
        if ($req->has('layout_localid') && !empty($req->input('layout_localid')))
        {
            $layout = ProjectBoard::where(
                'localid', $req->input('layout_localid')
                )
                ->where('project_id', $project->id)
                ->where('board_id', $board->id)
                ->first();
            $this->authorize('edit', $layout);
        }
        else
        {
            $layout = new ProjectBoard;
            $layout->local_id = ProjectBoard::where(
                'project_id', $project->id)
                ->where('board_id', $board->id)
                ->max('local_id') + 1;
            $layout->layout_position = ProjectBoard::where(
                'project_id', $project->id)
                ->where('board_id', $board->id)
                ->max('layout_position') + 1; // Specific to lane
            $layout->lane = 0;
            $layout->defines_lane = 0;
            $layout->project_id = $project->id;
            $layout->board_id = $board->id;
            $this->authorize('create', [ProjectBoard::class, $project->id]);
        }

        $layout->name = $req->input('layout_name');
        $layout->description = $req->input('layout_description');
        $layout->save();
        return redirect()->route('board.view', [
            'projectname' => $project->identification_name,
            'boardname' => $board->identification_name
        ]);
    }
}