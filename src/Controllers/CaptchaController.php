<?php

namespace Notadd\Captcha\Controllers;

use Notadd\Foundation\Routing\Abstracts\Controller;
use Notadd\Captcha\Captcha;
// use Illuminate\Routing\Controller;

/**
 * Class CaptchaController
 * @package Notadd\Captcha
 */
class CaptchaController extends Controller
{

    /**
     * get CAPTCHA
     *
     * @param \Notadd\Captcha\Captcha $captcha
     * @param string $config
     * @return \Intervention\Image\ImageManager->response
     */
    public function getCaptcha(Captcha $captcha, $config = 'default')
    {
        return $captcha->create($config);
    }

}
