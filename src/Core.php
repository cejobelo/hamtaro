<?php

namespace Hamtaro;

use Exception;
use Hamtaro\Module\Config;
use Hamtaro\Module\Head;
use Hamtaro\Module\Modals;
use Hamtaro\Module\Request;
use Hamtaro\Module\Response;
use Hamtaro\Module\Router;
use Hamtaro\Module\Ui;

/**
 * The Core.
 * A class that groups the modules of Hamtaro.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class Core
{
    /**
     * Modules.
     *
     * @var array $Modules
     */
    private array $Modules = [];

    /**
     * Returns the Config module instance.
     *
     * @return Config
     */
    public function Config()
    {
        if (array_key_exists(__METHOD__, $this->Modules)) {
            return $this->Modules[__METHOD__];
        }

        return $this->Modules[__METHOD__] = new Config($this);
    }

    /**
     * Returns the Head module instance.
     *
     * @return Head
     */
    public function Head()
    {
        if (array_key_exists(__METHOD__, $this->Modules)) {
            return $this->Modules[__METHOD__];
        }

        return $this->Modules[__METHOD__] = new Head($this);
    }

    /**
     * Returns the Modals module instance.
     *
     * @return Modals
     */
    public function Modals()
    {
        if (array_key_exists(__METHOD__, $this->Modules)) {
            return $this->Modules[__METHOD__];
        }

        return $this->Modules[__METHOD__] = new Modals($this);
    }

    /**
     * Returns the Request module instance.
     *
     * @return Request
     */
    public function Request()
    {
        if (array_key_exists(__METHOD__, $this->Modules)) {
            return $this->Modules[__METHOD__];
        }

        return $this->Modules[__METHOD__] = new Request($this);
    }

    /**
     * Returns the Response module instance.
     *
     * @return Response
     */
    public function Response()
    {
        if (array_key_exists(__METHOD__, $this->Modules)) {
            return $this->Modules[__METHOD__];
        }

        return $this->Modules[__METHOD__] = new Response($this);
    }

    /**
     * Returns the Router module instance.
     *
     * @return Router
     * @throws Exception
     */
    public function Router()
    {
        if (array_key_exists(__METHOD__, $this->Modules)) {
            return $this->Modules[__METHOD__];
        }

        return $this->Modules[__METHOD__] = new Router($this);
    }

    /**
     * Returns the Ui module instance.
     *
     * @return Ui
     */
    public function Ui()
    {
        if (array_key_exists(__METHOD__, $this->Modules)) {
            return $this->Modules[__METHOD__];
        }

        return $this->Modules[__METHOD__] = new Ui($this);
    }
}