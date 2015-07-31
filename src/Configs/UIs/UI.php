<?php

namespace Khill\Lavacharts\Configs;

use \Khill\Lavacharts\Exceptions\InvalidConfigProperty;

class UI
{
    /**
     * Allowed options to set for the UI.
     *
     * @var \Khill\Lavacharts\Configs\Options
     */
    private $options;

    /**
     * Default options available.
     *
     * @var array
     */
    private $defaults = [
        'label',
        'labelSeparator',
        'labelStacking',
        'cssClass'
    ];

    public function __construct($config)
    {
        $this->options = new Options($this->defaults);

        $this->parseConfig($config);
    }

    public function parseConfig($config)
    {
        foreach ($config as $option => $value) {
            if ($this->options->has($option) === false) {
                throw new InvalidConfigProperty(
                    static::TYPE,
                    __FUNCTION__,
                    $option,
                    $this->options->toArray()
                );
            }

            call_user_func([$this, $option], $value);
        }
    }
}
