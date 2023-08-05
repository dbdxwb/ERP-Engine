<?php

namespace Modules\Member\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Modules\Member\Middleware\Auth;
use Modules\Member\Model\MemberUser;

class MemberServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app('config')->set('auth.guards.member', [
            'driver' => 'jwt',
            'provider' => 'members',
        ]);

        app('config')->set('auth.providers.members', [
            'driver' => 'eloquent',
            'model' => MemberUser::class,
        ]);

        // $this->registerMenu();

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        // 注册会员路由
        $router->group(['prefix' => 'api', 'middleware' => ['api', Auth::class], 'statis' => true], function () {
            $list = \DevEngine\Core\Util\Cache::routeList('Member');
            foreach ($list as $file) {
                if (is_file($file)) {
                    $this->loadRoutesFrom($file);
                }
            }
        });

        // 注册数据库目录
        $this->loadMigrationsFrom(realpath(__DIR__ . '/../../../database/migrations'));

    }


    public function registerMenu()
    {
        require_once base_path() . '/vendor/dev-engine/application-member/src/Member/Menu/Core.php';
    }
}
