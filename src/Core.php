<?php
namespace Hamtaro;

use Exception;
use Hamtaro\Module\AbstractModule;
use Hamtaro\Module\Cache;
use Hamtaro\Module\Config;
use Hamtaro\Module\Head;
use Hamtaro\Module\Modals;
use Hamtaro\Module\Request;
use Hamtaro\Module\Response;
use Hamtaro\Module\Router;
use Hamtaro\Module\Ui;
use Hamtaro\Module\Workflow;

/**
 * The Core class groups the modules of Hamtaro.
 * You can override a module by creating it in src/Module, Hamtaro will find it.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class Core
{
    /**
     * Modules.
     *
     * @var AbstractModule[] $Modules
     */
    private array $Modules = [];

    /**
     * Returns the Cache module instance.
     *
     * @return Cache|\App\Module\Cache|AbstractModule
     */
    public function Cache()
    {
        return $this->getModuleInstance('Cache');
    }

    /**
     * Returns the Config module instance.
     *
     * @return Config|\App\Module\Config|AbstractModule
     */
    public function Config()
    {
        return $this->getModuleInstance('Config');
    }

    /**
     * Returns the Head module instance.
     *
     * @return Head|\App\Module\Head|AbstractModule
     */
    public function Head()
    {
        return $this->getModuleInstance('Head');
    }

    /**
     * Returns the Modals module instance.
     *
     * @return Modals|\App\Module\Modals|AbstractModule
     */
    public function Modals()
    {
        return $this->getModuleInstance('Modals');
    }

    /**
     * Returns the Request module instance.
     *
     * @return Request|\App\Module\Request|AbstractModule
     */
    public function Request()
    {
        return $this->getModuleInstance('Request');
    }

    /**
     * Returns the Response module instance.
     *
     * @return Response|App\Module\Response|AbstractModule
     */
    public function Response()
    {
        return $this->getModuleInstance('Response');
    }

    /**
     * Returns the Router module instance.
     *
     * @return Router|\App\Module\Router|AbstractModule
     */
    public function Router()
    {
        return $this->getModuleInstance('Router');
    }

    /**
     * Returns the Ui module instance.
     *
     * @return Ui|\App\Module\Ui|AbstractModule
     */
    public function Ui()
    {
        return $this->getModuleInstance('Ui');
    }

    /**
     * Returns the Workflow module instance.
     *
     * @return Workflow|\App\Module\Workflow|AbstractModule
     */
    public function Workflow()
    {
        return $this->getModuleInstance('Workflow');
    }

    /**
     * Returns the module instance.
     *
     * @return AbstractModule
     */
    protected function getModuleInstance(string $sModuleName)
    {
        try {
            if (array_key_exists($sModuleName, $this->Modules)) {
                return $this->Modules[$sModuleName];
            }

            $sAppModuleNamespace = "App\\Module\\$sModuleName";
            $sHamtaroModuleNamespace = "Hamtaro\\Module\\$sModuleName";

            if (class_exists($sAppModuleNamespace))
            { # This module is overrided
                $Module = new $sAppModuleNamespace($this);
            }

            else if (class_exists($sHamtaroModuleNamespace))
            { # This module isn't overrided, use the default class
                $Module = new $sHamtaroModuleNamespace($this);
            }

            else
            { # No module found
                throw new Exception("Module $sModuleName isn't defined");
            }

            return $this->Modules[$sModuleName] = $Module;
        }

        catch (Exception $Exception)
        {
            die($Exception->getMessage());
        }
    }
}