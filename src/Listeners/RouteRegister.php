<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, iBenchu.org
 * @datetime 2017-02-23 19:42
 */
namespace Notadd\Captcha\Listeners;

use Notadd\Captcha\Controllers\CaptchaController;
use Notadd\Foundation\Routing\Abstracts\RouteRegister as AbstractRouteRegister;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Notadd\Foundation\Configuration\Repository;

/**
 * Class RouteRegister.
 */
class RouteRegister extends AbstractRouteRegister
{
    /**
     * Handle Route Registrar.
     */
    public function handle()
    {
        // api路由定义
        $this->router->group(['middleware' => ['cross', 'web'], 'prefix' => 'api/captcha'], function () {
            $this->router->post('get', CaptchaController::class . '@get');
            $this->router->post('set', CaptchaController::class . '@set');
            $this->router->post('/', CaptchaController::class . '@captcha');
        });
        // 验证码图片路由
        $this->router->get('captcha/{config?}', CaptchaController::class . '@getCaptcha')->middleware('web');
    }
}
