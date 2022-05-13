<?php
namespace Hamtaro\Module;

use Hamtaro\Controller\AbstractController;
use Hamtaro\Controller\Component\AbstractComponent;
use Hamtaro\Controller\Form\AbstractForm;
use Hamtaro\Controller\Modal\AbstractModal;
use Hamtaro\Controller\Page\AbstractPage;
use Hamtaro\Core;

/**
 * The cache module.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class Cache extends AbstractModule
{
    /**
     * The constructor.
     *
     * @param Core $Core
     */
    public function __construct(Core $Core)
    {
        parent::__construct($Core);

        # Create the cache directory
        if (!is_dir($this->getDir()))
        {
            mkdir($this->getDir(), 0777, true);
        }

        $Controllers = [];
        $Components = [];
        $Pages = [];
        $Forms = [];
        $Modals = [];
        $Urls = [];

        foreach ($this->Core->Config()->getControllers() as $sController)
        {
            /** @var AbstractController $Controller */
            $Controller = new $sController($this->Core);
            $Controllers[] = $Controller;

            if ($Controller instanceof AbstractPage)
            {
                $Pages[] = $Controller;

                foreach ($Controller->Urls() as $Url)
                {
                    $Urls[$Controller->getCtrl()] = $Url->getPath();
                }
            }

            if ($Controller instanceof AbstractComponent)
            {
                $Components[] = $Controller;
            }

            if ($Controller instanceof AbstractForm)
            {
                $Forms[] = $Controller;
            }

            if ($Controller instanceof AbstractModal)
            {
                $Modals[] = $Controller;
            }
        }

        file_put_contents("{$this->getDir()}/Controllers.json", json_encode($Controllers));
        file_put_contents("{$this->getDir()}/Components.json", json_encode($Components));
        file_put_contents("{$this->getDir()}/Pages.json", json_encode($Pages));
        file_put_contents("{$this->getDir()}/Forms.json", json_encode($Forms));
        file_put_contents("{$this->getDir()}/Modals.json", json_encode($Modals));
        file_put_contents("{$this->getDir()}/Urls.json", json_encode($Urls));
    }

    /**
     * Returns the cache directory.
     *
     * @return string
     */
    public function getDir()
    {
        return "{$this->Core->Config()->getBasepath()}/src/Cache";
    }

    /**
     * Returns the urls.
     *
     * @return string
     */
    public function getUrls()
    {
        return json_decode(file_get_contents("{$this->getDir()}/Urls.json"), true);
    }

    /**
     * Returns the controllers.
     *
     * @return AbstractController[]
     */
    public function Controllers()
    {
        return $this->getCachedControllers('Controllers');
    }

    /**
     * Returns the pages.
     *
     * @return AbstractPage[]
     */
    public function Pages()
    {
        return $this->getCachedControllers('Pages');
    }

    /**
     * Returns the cache content.
     *
     * @return AbstractController[]|AbstractComponent[]|AbstractPage[]|AbstractForm[]|AbstractModal[]
     */
    public function getCachedControllers(string $sName)
    {
        if ($controllers = json_decode(file_get_contents("{$this->getDir()}/$sName.json"), true))
        {
            return array_map(function (array $aItem) {
                $sClass = $aItem['namespace'];
                return new $sClass($this->Core);
            }, $controllers);
        }

        return [];
    }
}