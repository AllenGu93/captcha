<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, iBenchu.org
 * @datetime 2017-04-10 19:41
 */
namespace Notadd\Captcha\Handlers;

use Illuminate\Container\Container;
use Notadd\Foundation\Passport\Abstracts\DataHandler;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;

/**
 * Class GetHandler.
 */
class GetHandler extends DataHandler
{
    /**
     * @var \Notadd\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    /**
     * GetHandler constructor.
     *
     * @param \Illuminate\Container\Container                         $container
     * @param \Notadd\Foundation\Setting\Contracts\SettingsRepository $settings
     */
    public function __construct(Container $container, SettingsRepository $settings)
    {
        parent::__construct($container);
        $this->settings = $settings;
    }

    /**
     * Data for handler.
     *
     * @return array
     */
    public function data()
    {
        return [
            'length' => $this->settings->get('captcha.length', ''),
            'width' => $this->settings->get('captcha.width', ''),
            'height' => $this->settings->get('captcha.height', ''),
            'quality' => $this->settings->get('captcha.quality', ''),
            // 'lines' => $this->settings->get('captcha.lines', 6),
            // 'bgImage' => $this->settings->get('captcha.bgImage', false),
            // 'bgColor' => $this->settings->get('captcha.bgColor', '#ecf2f4'),
            // 'fontColors' => $this->settings->get('captcha.fontColors', []),
            // 'contrast' => $this->settings->get('captcha.contrast', -5),
            // 'sensitive' => $this->settings->get('captcha.sensitive', true),
            // 'angle' => $this->settings->get('captcha.angle', 12),
            // 'sharpen' => $this->settings->get('captcha.sharpen', 10),
            // 'blur' => $this->settings->get('captcha.blur', 2),
            // 'invert' => $this->settings->get('captcha.invert', true),
        ];
    }
}
