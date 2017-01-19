<?php

namespace Cosmos\Debug\Resources;

use \Symfony\Component\VarDumper\Dumper\HtmlDumper;

class CosmosHTMLDumper extends HtmlDumper
{
    /**
     * HtmlDumper variables, styles HTML.
     *
     * @var array
     */
    protected $styles = [
        'default' => 'background-color:#000000; color:#FF8400; 
                      line-height:1.2em; font:12px Menlo, Monaco, Consolas, monospace; 
                      word-wrap: break-word; white-space: pre-wrap; position:relative; 
                      z-index:99999; word-break: normal',
        'num'   => 'color:#0176B8',
        'const' => 'font-weight:italic; color:#71BF87',
        'str'   => 'color:#71BF87',
        'note'  => 'color:#008285',
        'ref'   => 'color:#A0A0A0',
        'public'    => 'font-weight:bold; color:#D1CFC6',
        'protected' => 'font-weight:bold; color:#D1CFC6',
        'private'   => 'font-weight:bold; color:#D1CFC6',
        'meta'  => 'color:#B729D9',
        'key'   => 'font-weight:bold; color:#34AB9C',
        'index' => 'font-weight:bold; color:#34AB9C',
    ];

}
