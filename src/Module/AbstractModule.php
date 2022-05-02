<?php
namespace Hamtaro\Module;

use Hamtaro\Core;

/**
 * A module.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class AbstractModule
{
    /**
     * The Core instance.
     *
     * @var Core $Core
     */
    protected Core $Core;

    public function __construct(Core $Core)
    {
        $this->Core = $Core;
    }
}