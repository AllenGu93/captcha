<?php
/**
 * This file is part of Notadd.
 *
 * @author Cst <260096556@qq.com>
 * @copyright (c) 2017, Cst
 * @datetime 2017-04-22 15:20
 */
namespace Notadd\Captcha;

use Illuminate\Events\Dispatcher;
use Notadd\Captcha\Listeners\CsrfTokenRegister;
use Notadd\Captcha\Listeners\RouteRegister;
use Notadd\Foundation\Extension\Abstracts\Extension as AbstractExtension;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;

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
        // 翻译文件
        $this->loadTranslationsFrom(realpath(__DIR__ . '/../resources/translations'), 'Captcha');

        // 加载配置文件
        $this->mergeConfigFrom(
            __DIR__.'/../config/captcha.php', 'captcha'
        );

        $setting = $this->app->make(SettingsRepository::class);

        // 默认设置
        config(['captcha.default' => $setting->get('captcha')]);

    }

    // 注入 captcha IoC 实例
    public function register()
    {

        $this->app->singleton('captcha', function($app)
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
