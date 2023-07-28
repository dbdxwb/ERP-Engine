<?php

namespace DevEngine\Core\Providers;

use Closure;
use DevEngine\Core\Util\Build;
use DevEngine\Core\Util\MenuStore;
use DevEngine\Core\Util\Permission;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        // 异常级别
        error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);

        // 注册核心配置
        foreach (glob(__DIR__ . '/../../config/*.php') as $vo) {
            $this->mergeConfigFrom($vo, basename($vo, '.php'));
        }

        // 注册组件
        $this->app->singleton(Build::class);

        $this->app->singleton('Menu', function () {
            return new MenuStore();
        });

        $this->app->singleton('Permission', function () {
            return new Permission();
        });

        // 编译包
        $providers = app(Build::class)->getData('providers');
        $config = app(Build::class)->getData('config');

        // 扩展路由方法
        Route::macro('manage', function ($class, $name = '') {
            return (new \DevEngine\Core\Util\Route($class, $name));
        });

        $this->app->register(AuthServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(CoreServiceProvider::class);
        $this->app->register(UIServiceProvider::class);
        $this->app->register(AdminServiceProvider::class);

        foreach ($providers as $vo) {
            $this->app->register($vo);
        }

        foreach ($config as $vo) {
            $this->mergeConfigFrom(base_path($vo), lcfirst(basename($vo, '.php')));
        }
    }

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {

        // 注册模板组件
        Blade::component('app-loading', \DevEngine\Core\UI\Components\Loading::class);
        Blade::component('app-nodata', \DevEngine\Core\UI\Components\NoData::class);
        Blade::component('app-trend', \DevEngine\Core\UI\Components\Trend::class);
        Blade::directive('paginate', function ($label) {
            return '<?php echo $pageData ? $pageData->links(' . $label . ') : "" ?>';
        });

        // 扩展数据库方法
        Builder::macro('findInSet', function ($field, $value) {
            return $this->whereRaw("FIND_IN_SET(?, {$field})", $value);
        });
        Builder::macro('orFindInSet', function ($field, $value) {
            return $this->orWhereRaw("FIND_IN_SET(?, {$field})", $value);
        });
        Builder::macro('orderByWith', function ($relation, $column, $direction = 'asc'): Builder {
            if (is_string($relation)) {
                $relation = $this->getRelationWithoutConstraints($relation);
            }
            return $this->orderBy(
                $relation->getRelationExistenceQuery(
                    $relation->getRelated()->newQueryWithoutRelationships(),
                    $this,
                    $column
                ),
                $direction
            );
        });

        $this->bootedCallbacks[] = function () {
        };

        $this->registerViews();
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/application/core');

        $sourcePath = __DIR__ . '/../../resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/application/core';
        }, Config::get('view.paths')), [$sourcePath]), 'application-core');
    }
}
