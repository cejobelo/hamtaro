<?php
namespace Hamtaro\Module;

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
        
        if (is_file(realpath(getcwd() . '/src/main.php')))
        {
            $this->sBasepath = (string) getcwd();
        }

        else if (is_file(realpath(getcwd() . '/../src/main.php')))
        {
            $this->sBasepath = (string) realpath(getcwd() . '/../');
        }

        $this->aConfig = include "$this->sBasepath/src/main.php";
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
     * Returns the application src.
     *
     * @return string
     */
    public function getApplicationSrc()
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
    public function getControllers()
    {
        return $this->aConfig['controllers'];
    }

    /**
     * Returns true if the namespace is allowed to be loaded.
     *
     * @param string $sNamespace
     * @return bool
     */
    public function isAllowedNamespace(string $sNamespace)
    {
        return in_array($sNamespace, $this->getControllers(), true);
    }
}