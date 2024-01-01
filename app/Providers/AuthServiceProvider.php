<?php
namespace App\Providers;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectBoard;
use App\Models\BoardLayout;
use App\Policies\ProjectPolicy;
use App\Policies\ProjectBoardPolicy;
use App\Policies\BoardLayoutPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,
        ProjectBoard::class => ProjectBoardPolicy::class,
        BoardLayout::class => BoardLayoutPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('superadmin', function (User $user)
        {
            return $user->is_super_admin == 1;
        });
    }
}
