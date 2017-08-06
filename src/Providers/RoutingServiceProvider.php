<?php namespace Arcanedev\Localization\Providers;

use Arcanedev\Localization\Middleware;
use Arcanedev\Support\Providers\RouteServiceProvider as ServiceProvider;
use Arcanedev\Localization\Routing\Router;

/**
 * Class     RoutingServiceProvider
 *
 * @package  Arcanedev\Localization\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoutingServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'localization-session-redirect' => Middleware\LocaleSessionRedirect::class,
        'localization-cookie-redirect'  => Middleware\LocaleCookieRedirect::class,
        'localization-redirect'         => Middleware\LocalizationRedirect::class,
        'localized-routes'              => Middleware\LocalizationRoutes::class,
        'translation-redirect'          => Middleware\TranslationRedirect::class,
    ];

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->replaceIlluminateRouter();

        parent::register();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the router.
     */
    private function replaceIlluminateRouter()
    {
        $this->app->singleton('router', function ($app) {
            return new Router($app['events'], $app);
        });
    }
}
