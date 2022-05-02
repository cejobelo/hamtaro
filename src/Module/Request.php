<?php
namespace Hamtaro\Module;

use Hamtaro\Core;

/**
 * Request module.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class Request extends AbstractModule
{
    /**
     * The current url.
     *
     * @var string
     */
    private string $sUrl;

    /**
     * The constructor.
     *
     * @return void
     */
    public function __construct(Core $Core)
    {
        parent::__construct($Core);
        $this->sUrl = (string) $_SERVER['REQUEST_URI'];
    }

    /**
     * Returns the url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->sUrl;
    }
}