<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, iBenchu.org
 * @datetime 2017-02-23 19:36
 */
namespace Notadd\Captcha;

use Illuminate\Events\Dispatcher;
use Notadd\Captcha\Listeners\CsrfTokenRegister;
use Notadd\Captcha\Listeners\RouteRegister;
use Notadd\Foundation\Extension\Abstracts\Extension as AbstractExtension;

/**
 * Class Extension.
 */
class Extension extends AbstractExtension
{
    /**
     * Boot provider.
     */
    public function boot()
    {
        $this->app->make(Dispatcher::class)->subscribe(CsrfTokenRegister::class);
        $this->app->make(Dispatcher::class)->subscribe(RouteRegister::class);
        // $this->loadTranslationsFrom(realpath(__DIR__ . '/../resources/translations'), 'Captcha');

        // Publish configuration files
        $this->publishes([
            __DIR__.'/../config/captcha.php' => config_path('captcha.php')
        ], 'config');

        // HTTP routing
        if (strpos($this->app->version(), 'Lumen') !== false) {
           $this->app->get('captcha[/{config}]', 'Notadd\Captcha\LumenCaptchaController@getCaptcha');
        } else {
            if ((double) $this->app->version() >= 5.2) {
                $this->app['router']->get('captcha/{config?}', '\Notadd\Captcha\CaptchaController@getCaptcha')->middleware('web');
            } else {
                $this->app['router']->get('captcha/{config?}', '\Notadd\Captcha\CaptchaController@getCaptcha');
            }
        }

        // Validator extensions
        $this->app['validator']->extend('captcha', function($attribute, $value, $parameters)
        {
            return captcha_check($value);
        });
        // Merge configs
        // $this->mergeConfigFrom(
        //     __DIR__.'/../config/captcha.php', 'captcha'
        // );

        // Bind captcha
        $this->app->bind('captcha', function($app)
        {
            return new Captcha(
                $app['Illuminate\Filesystem\Filesystem'],
                $app['Notadd\Foundation\Configuration\Repository'],
                $app['Notadd\Foundation\Image\ImageManager'],
                $app['Illuminate\Session\Store'],
                $app['Illuminate\Hashing\BcryptHasher'],
                $app['Illuminate\Support\Str']
            );
        });
    }

    /**
     * Description of extension
     *
     * @return string
     */
    public static function description()
    {
        return '验证码插件的配置和管理。';
    }

    /**
     * Installer for extension.
     *
     * @return \Closure
     */
    public static function install()
    {
        return function () {
            return true;
        };
    }

    /**
     * Name of extension.
     *
     * @return string
     */
    public static function name()
    {
        return '验证码';
    }

    /**
     * Get script of extension.
     *
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function script()
    {
        return asset('assets/extensions/baidu-push/js/extension.min.js');
    }

    /**
     * Get stylesheet of extension.
     *
     * @return array
     */
    public static function stylesheet()
    {
        return [];
    }

    /**
     * Uninstall for extension.
     *
     * @return \Closure
     */
    public static function uninstall()
    {
        return function () {
            return true;
        };
    }

    /**
     * Version of extension.
     *
     * @return string
     */
    public static function version()
    {
        return '0.1.0';
    }
}
