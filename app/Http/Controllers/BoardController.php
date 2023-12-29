<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectBoard;
use App\Models\BoardLayout;
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
            $board = ProjectBoard::where('project_id', $project->id)
                ->where('identification_name', $boardname)
                ->first();
            
            $this->authorize('edit', $board);
        }

        $layoutItemList = [];
        $layoutItemList[] = new BoardLayout;

        return view('board.board_view', [
            'board' => $board,
            'layoutItemList' => $layoutItemList
        ]);
    }

    public function postEdit()
    {
        
    }
}
