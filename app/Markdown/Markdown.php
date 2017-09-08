<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/9/6
 * Time: 11:32
 */

namespace App\Markdown;


class Markdown
{

    protected $parser;

    /**
     * Markdown constructor.
     * @param $paser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }
    public function markdown($text)
    {
        $html=$this->parser->makeHtml($text);
        return $html;
    }

}