<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * REGISTER: Aquí ocurre la magia de la Arquitectura Hexagonal.
     * Vinculamos las Interfaces (Domain) con las Implementaciones (Infrastructure).
     */
    public function register(): void
    {
        // Ejemplo para el módulo de Products:
        // Cuando un Use Case pida "ProductRepositoryInterface", Laravel le dará el "EloquentProductRepository"
        /*
        $this->app->bind(
            \App\Features\Products\Domain\Repositories\ProductRepositoryInterface::class,
            \App\Features\Products\Infrastructure\Repositories\EloquentProductRepository::class
        );
        */
    }

    /**
     * BOOT: Aquí ocurre la magia del Vertical Slicing.
     * Hacemos que Laravel cargue automáticamente las rutas de cada Feature.
     */
    public function boot(): void
    {
        $this->registerFeatureRoutes();
    }

    /**
     * Escanea la carpeta app/Features y registra los archivos 'routes.php' de cada Http.
     */
    protected function registerFeatureRoutes(): void
    {
        $featuresPath = app_path('Features');

        if (!File::isDirectory($featuresPath)) {
            return;
        }

        // Buscamos en cada subcarpeta de Features (Users, Products, etc.)
        foreach (File::directories($featuresPath) as $featureDir) {
            $routeName = basename($featureDir);
            $routeFile = $featureDir . '/Http/routes.php';

            if (File::exists($routeFile)) {
                Route::middleware('api')
                    ->prefix('api/' . strtolower($routeName))
                    ->group($routeFile);
            }
        }
    }
}
