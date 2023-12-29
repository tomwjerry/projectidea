<?php
namespace App\Providers;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectBoard;
use App\Policies\ProjectPolicy;
use App\Policies\ProjectBoardPolicy;
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
        ProjectBoard::class => ProjectBoardPolicy::class
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
