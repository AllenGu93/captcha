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
        // 测试路由
        // $this->router->group(['prefix' => 'api/captcha'], function () {
        //     $this->router->get('get', CaptchaController::class . '@get');
        //     $this->router->get('set', CaptchaController::class . '@set');
        //     $this->router->get('/{captcha?}', CaptchaController::class . '@captcha');
        // });
        // 验证码图片路由
        $this->router->get('captcha/{config?}', CaptchaController::class . '@getCaptcha')->middleware('web');
        // $this->router->any('captcha-test', function()
        // {
        //     if (\Request::getMethod() == 'POST')
        //     {
        //         $rules = ['captcha' => 'required|captcha'];
        //         // dd(Input::all());
        //         $validator = Validator::make(Input::all(), $rules);
        //         if ($validator->fails())
        //         {
        //             echo '<p style="color: #ff0000;">Incorrect!</p>';
        //         }
        //         else
        //         {
        //             echo '<p style="color: #00ff30;">Matched :)</p>';
        //         }
        //     }

        //     $form = '<form method="post" action="captcha-test">';
        //     $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
        //     $form .= '<p>' . captcha_img() . '</p>';
        //     $form .= '<p><input type="text" name="captcha"></p>';
        //     $form .= '<p><button type="submit" name="check">Check</button></p>';
        //     $form .= '</form>';
        //     return $form;
        // })->middleware('web');

        // $this->router->get('test', function(Repository $settings) {
        //     return dd($settings->all());
        // });
    }
}
