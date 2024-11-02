<?php

namespace Modules\Department\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected string $name = 'Department';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapDepartmentRoute();
        $this->mapRoomRoute();
        $this->mapClinicRoute();
        $this->mapSurgeryRoute();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')->group(module_path($this->name, '/routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes(): void
    {
        Route::middleware('api')->prefix('api')->name('api.')->group(module_path($this->name, '/routes/api.php'));
    }
    protected function mapDepartmentRoute(): void
    {
        Route::middleware('api')->prefix('api')->group(module_path($this->name,'/routes/department.php'));
    }
    protected function mapClinicRoute(): void
    {
        Route::middleware('api')->prefix('api')->group(module_path($this->name,'/routes/clinic.php'));
    }

    protected function mapRoomRoute(): void
    {
        Route::middleware('api')->prefix('api')->group(module_path($this->name,'/routes/room.php'));
    }

    protected function mapSurgeryRoute(): void
    {
        Route::middleware('api')->prefix('api')->group(module_path($this->name,'/routes/surgery.php'));
    }
}
