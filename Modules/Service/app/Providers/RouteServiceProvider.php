<?php

namespace Modules\Service\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected string $name = 'Service';

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
        $this->mapTestRoutes();
        $this->mapPatientTestRoutes();
        $this->mapInspectionRoutes();
        $this->mapTestRoutes();
        $this->mapPatientTestRoutes();
        $this->mapRayRoute();
        $this->mapPatientRayRoute();
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
    protected function mapInspectionRoutes(): void
    {
        Route::middleware('api')->prefix('api')->group(module_path($this->name,'/routes/inspection.php'));
    }

    protected function mapTestRoutes(): void
    {
        Route::middleware('api')->prefix('api')->group(module_path($this->name,'/routes/test.php'));
    }

    protected function mapPatientTestRoutes(): void
    {
        Route::middleware('api')->prefix('api')->group(module_path($this->name,'/routes/patient_test.php'));
    }

    protected function mapRayRoute(): void
    {
        Route::middleware('api')->prefix('api')->group(module_path($this->name,'/routes/ray.php'));
    }

    protected function mapPatientRayRoute(): void
    {
        Route::middleware('api')->prefix('api')->group(module_path($this->name,'/routes/patient_ray.php'));
    }

}
