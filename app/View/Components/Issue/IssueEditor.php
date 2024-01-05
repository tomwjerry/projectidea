<?php
namespace App\View\Components\Issue;

use Closure;
use App\Models\Issue;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IssueEditor extends Component
{
    public Issue $issue;

    /**
     * Create a new component instance.
     */
    public function __construct(Issue $issue)
    {
        //
        $this->issue = $issue;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.issue.issue-editor');
    }
}
