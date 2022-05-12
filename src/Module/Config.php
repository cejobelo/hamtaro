<?php
namespace Hamtaro\Module;

use Hamtaro\Controller\AbstractController;
use Hamtaro\Controller\Page\AbstractPage;
use Hamtaro\Core;

/**
 * The configuration.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class Config extends AbstractModule
{
    /**
     * The configuration by src/main.php
     *
     * @var array
     */
    private array $aConfig;

    /**
     * The basepath.
     *
     * @var string $sBasepath
     */
    private string $sBasepath;

    /**
     * The constructor.
     *
     * @param Core $Core
     */
    public function __construct(Core $Core)
    {
        parent::__construct($Core);
        $this->sBasepath = (string) realpath(getcwd() . '/../');
        $this->aConfig = include "$this->sBasepath/src/main.php";
    }

    /**
     * Returns the id of the application.
     *
     * @return string
     */
    public function getAppId()
    {
        return $this->aConfig['app_id'];
    }

    /**
     * Returns the basepath.
     *
     * @return string
     */
    public function getBasepath()
    {
        return $this->sBasepath;
    }

    /**
     * Returns the Hamtaro src.
     *
     * @return string
     */
    public function getHamtaroSrc()
    {
        return "$this->sBasepath/vendor/cejobelo/hamtaro/src";
    }

    /**
     * Returns the project src.
     *
     * @return string
     */
    public function getProjectSrc()
    {
        return "$this->sBasepath/src";
    }

    /**
     * Returns the tmp directory.
     *
     * @return string
     */
    public function getTmpDir()
    {
        return sys_get_temp_dir();
    }

    /**
     * Returns the allowed controllers namespaces.
     *
     * @return string[]
     */
    public function getNamespaces()
    {
        return array_merge(
            $this->aConfig['controllers']['ajax'] ?? [],
            $this->aConfig['controllers']['component'] ?? [],
            $this->aConfig['controllers']['form'] ?? [],
            $this->aConfig['controllers']['modal'] ?? [],
            $this->aConfig['controllers']['page'] ?? []
        );
    }

    /**
     * Returns the allowed controllers in the project.
     *
     * @return AbstractController[]
     */
    public function getControllers()
    {
        foreach ($this->getNamespaces() as $sNamespace)
        {
            /** @var AbstractController $Controller */
            $Controller = new $sNamespace($this->Core);
            $aControllers[] = $Controller;
        }
        return $aControllers ?? [];
    }

    /**
     * Returns true if the namespace is allowed to be loaded.
     *
     * @param string $sNamespace
     * @return bool
     */
    public function isAllowedNamespace(string $sNamespace)
    {
        return in_array($sNamespace, $this->getNamespaces(), true);
    }

    /**
     * Returns the pages in the project.
     *
     * @return AbstractPage[]
     */
    public function getPages()
    {
        $aNamespaces = $this->aConfig['controllers']['page'];

        foreach ($aNamespaces as $sNamespace)
        {
            /** @var AbstractPage $Page */
            $Page = new $sNamespace($this->Core);
            $aPages[] = $Page;
        }

        return $aPages ?? [];
    }
}