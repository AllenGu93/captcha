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
        $this->settings->set('captcha.enabled', $this->request->input('enabled'));
        $this->settings->set('captcha.length', $this->request->input('length'));
        $this->settings->set('captcha.width', $this->request->input('width'));
        $this->settings->set('captcha.height', $this->request->input('height'));
        $this->settings->set('captcha.quality', $this->request->input('quality'));
        // $this->settings->set('captcha.lines', $this->request->input('lines'));
        // $this->settings->set('captcha.bgImage', $this->request->input('bgImage'));
        // $this->settings->set('captcha.contrast', $this->request->input('contrast'));
        // $this->settings->set('captcha.sensitive', $this->request->input('sensitive'));
        // $this->settings->set('captcha.angle', $this->request->input('angle'));
        // $this->settings->set('captcha.sharpen', $this->request->input('sharpen'));
        // $this->settings->set('captcha.blur', $this->request->input('blur'));
        // $this->settings->set('captcha.invert', $this->request->input('invert'));

        return true;
    }
}
