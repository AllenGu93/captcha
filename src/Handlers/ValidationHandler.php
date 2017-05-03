<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, iBenchu.org
 * @datetime 2017-02-23 19:45
 */
namespace Notadd\Captcha\Handlers;

use Illuminate\Container\Container;
use Notadd\Foundation\Passport\Abstracts\SetHandler as AbstractSetHandler;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Session\Store as Session;

/**
 * Class ConfigurationHandler.
 */
class ValidationHandler extends AbstractSetHandler
{
    /**
     * @var Illuminate\Support\Facades\Validator
     */
    protected $validator;

    /**
     * @var bealoon
     */
    protected $result;

    /**
     * @var bealoon
     */
    protected $empty = false;

    /**
     * SetHandler constructor.
     *
     * @param \Illuminate\Container\Container                         $container
     */
    public function __construct(
        Container $container
    ) {
        parent::__construct($container);
        $this->messages->push($this->translator->trans('Captcha::validation.success'));
    }

    /**
     * Data for handler.
     *
     * @return array
     */
    public function data()
    {
        if($this->result){
            return ['result' => $this->result];
        }else{
            return [];
        }
    }

    /**
     * Execute Handler.
     *
     * @return bool
     */
    public function execute()
    {
        // $rules = ['captcha' => 'required|captcha'];
        // dd(Validator::make(Input::all(), $rules));
        // $session = app('session');
        // dd($session->all());
        if(empty($this->request->input('captcha'))) {
            $this->empty = true;
        }
        return captcha_check($this->request->input('captcha'));
    }

    /**
     * error exception
     *
     * @return array
     */
    public function errors()
    {
        $this->code = 4001;
        if ($this->empty) {
            $this->errors->push($this->translator->trans('Captcha::validation.empty'));
        }else{
            $this->errors->push($this->translator->trans('Captcha::validation.fail'));
        }
        return parent::errors();
    }
}
