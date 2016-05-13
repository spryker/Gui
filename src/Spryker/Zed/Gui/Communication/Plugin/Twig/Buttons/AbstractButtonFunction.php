<?php

namespace Spryker\Zed\Gui\Communication\Plugin\Twig\Buttons;

use Spryker\Zed\Library\Twig\TwigFunction;

abstract class AbstractButtonFunction extends TwigFunction
{
    const PARAM_ID = 'id';
    const PARAM_CLASS = 'class';
    const DEFAULT_CSS_CLASSES = 'btn-sm btn-outline';

    /**
     * @return string
     */
    abstract protected function getButtonClass();

    /**
     * @return string
     */
    abstract protected function getIcon();

    /**
     * @param array $options
     *
     * @return string
     */
    protected function getId(array $options)
    {
        $id = '';
        if (array_key_exists(self::PARAM_ID, $options)) {
            $id = ' id="' . $options[self::PARAM_ID] . '"';
        }

        return $id;
    }

    /**
     * @param array $options
     *
     * @return string
     */
    protected function getClass(array $options = [])
    {
        $extraClasses = '';
        if (array_key_exists(self::PARAM_CLASS, $options)) {
            $extraClasses = ' ' . $options[self::PARAM_CLASS];
        }

        return ' class="btn '
        . static::DEFAULT_CSS_CLASSES
        . ' '
        . $this->getButtonClass()
        . $extraClasses
        . '"';
    }

    /**
     * @param string $url
     * @param array $options
     *
     * @return string
     */
    protected function generateAnchor($url, array $options = [])
    {
        return '<a' . $this->getClass($options) . $this->getId($options) . ' href="' . $url . '">';
    }

    /**
     * @return callable
     */
    protected function getFunction()
    {
        $button = $this;

        // @todo CD-450 use twig to render html
        return function ($url, $title, $options = []) use ($button) {
            $html = $button->generateAnchor($url, $options);
            $html .= $this->getIcon();
            $html .= $title;
            $html .= '</a>';

            return $html;
        };
    }
}