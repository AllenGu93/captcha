<?php

namespace Notadd\Captcha\Controllers;

use Notadd\Foundation\Routing\Abstracts\Controller;
use Notadd\Captcha\Captcha;
use Notadd\Captcha\Handlers\GetHandler;
use Notadd\Captcha\Handlers\SetHandler;
use Notadd\Captcha\Handlers\ValidationHandler;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

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
        // dd($config);
        return $captcha->create($config);
    }

    /**
     * CAPTCHA validation
     *
     * @param string $captcha
     * @param string $config
     * @return boolean
     */
    public function captcha(ValidationHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * Get handler.
     *
     * @param \Notadd\Captcha\Handlers\GetHandler $handler
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     */
    public function get(GetHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    /**
     * Set handler.
     *
     * @param \Notadd\Captcha\Handlers\SetHandler $handler
     *
     * @return \Notadd\Foundation\Passport\Responses\ApiResponse|\Psr\Http\Message\ResponseInterface|\Zend\Diactoros\Response
     * @throws \Exception
     */
    public function set(SetHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

}
