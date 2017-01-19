<?php
namespace Cosmos\Utils;

/**
 * HTML Getter
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Utils
 */
final class HtmlGetter
{
    /**
     * The HTML
     *
     * @var string
     */
    private $html = '';

    /**
     * Create a new HtmlGetter instance.
     *
     * @param string $html
     */
    public function __construct(string $html)
    {
        $this->html = $html;
    }

    /**
     * Override
     *
     * @return string
     */
    public function __toString():string
    {
        return $this->html;
    }

}
