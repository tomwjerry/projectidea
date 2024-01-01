<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectBoard;
use App\Models\BoardLayout;
use App\Services\UniqueNameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    public function viewBoard($projectname, $boardname = null)
    {
        $project = Project::where(
            'identification_name', $projectname)->first();

        $board = null;

        if (empty($boardname) || $boardname == 'new')
        {
            $board = new ProjectBoard;
            $this->authorize('create', [ProjectBoard::class, $project->id]);
        }
        else
        {
            $board = ProjectBoard::where('identification_name', $boardname)
                ->where('project_id', $project->id)
                ->first();
            
            $this->authorize('view', $board);
        }

        $layoutItemList = BoardLayout::where(
            'project_id', $project->id)
            ->where('board_id', $board->id)
            ->orderBy('layout_position', 'ASC')
            ->get();
        $layoutItemList[] = new BoardLayout;

        return view('board.board_view', [
            'board' => $board,
            'layoutItemList' => $layoutItemList,
            'project' => $project
        ]);
    }

    public function postEdit(Request $req)
    {
        $board = null;
        $project = Project::where(
            'identification_name', $req->input('project_identification_name'))
            ->first();
        $projectidname = $project->identification_name;

        if ($req->has('identification_name') ||
            !empty($req->input('identification_name')))
        {
            $board = ProjectBoard::where(
                'identification_name', $req->input('identification_name'))
                ->where('project_id', $board->project_id)
                ->first();
            
            $this->authorize('edit', $board);
        }
        else
        {
            $board = new ProjectBoard;
            $board->project_id = $project->id;
            $board->parent_board_id = 0;
            $board->identification_name = UniqueNameService::generateUniqueName(
                ProjectBoard::where('project_id', $board->project_id)
                    ->query(),
                $req->input('board_name'),
                ['project', 'board', 'layout', 'boardlayout']
            );

            $this->authorize('create', [ProjectBoard::class, $project->id]);
        }
        
        $board->name = $req->input('board_name');
        $board->description = $req->input('board_description');
        $board->save();

        return redirect()->route('board.view', [
            'projectname' => $project->identification_name,
            'boardname' => $board->identification_name
        ]);
    }
}
