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
use Notadd\Foundation\Setting\Contracts\SettingsRepository;

/**
 * Class ConfigurationHandler.
 */
class SetHandler extends AbstractSetHandler
{
    /**
     * @var \Notadd\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    /**
     * SetHandler constructor.
     *
     * @param \Illuminate\Container\Container                         $container
     * @param \Notadd\Foundation\Setting\Contracts\SettingsRepository $settings
     */
    public function __construct(
        Container $container,
        SettingsRepository $settings
    ) {
        parent::__construct($container);
        $this->messages->push($this->translator->trans('Captcha::setting.success'));
        $this->settings = $settings;
    }

    /**
     * Data for handler.
     *
     * @return array
     */
    public function data()
    {
        return $this->settings->all()->toArray();
    }

    /**
     * Execute Handler.
     *
     * @return bool
     */
    public function execute()
    {
        $this->settings->set('Captcha.enabled', $this->request->input('enabled'));
        $this->settings->set('Captcha.length', $this->request->input('length'));
        $this->settings->set('Captcha.width', $this->request->input('width'));
        $this->settings->set('Captcha.height', $this->request->input('height'));
        // $this->settings->set('Captcha.quality', $this->request->input('quality'));
        // $this->settings->set('Captcha.lines', $this->request->input('lines'));
        // $this->settings->set('Captcha.bgImage', $this->request->input('bgImage'));
        // $this->settings->set('Captcha.contrast', $this->request->input('contrast'));
        // $this->settings->set('Captcha.sensitive', $this->request->input('sensitive'));
        // $this->settings->set('Captcha.angle', $this->request->input('angle'));
        // $this->settings->set('Captcha.sharpen', $this->request->input('sharpen'));
        // $this->settings->set('Captcha.blur', $this->request->input('blur'));
        // $this->settings->set('Captcha.invert', $this->request->input('invert'));

        return true;
    }
}
