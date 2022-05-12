<?php
namespace Hamtaro\Controller;

use Exception;
use Hamtaro\Controller\Form\AbstractForm;
use Hamtaro\Core;

/**
 * A controller.
 *
 * @link https://www.youtube.com/watch?v=kGOTIt2wJXs
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class AbstractController
{
    /**
     * The Core instance.
     *
     * @var Core $Core
     */
    protected Core $Core;

    /**
     * The parameters.
     *
     * @var array $aParams
     */
    protected array $aParams = [];

    /**
     * The constructor.
     *
     * @param Core $Core
     * @param array $aParams
     * @throws Exception
     */
    public function __construct(Core $Core, array $aParams = [])
    {
        $this->Core = $Core;

        if (!$this instanceof AbstractForm)
        {
            $this->checkRequestParams($this, $aParams);
        }
    }

    /**
     * Checks a controller's RequestParam Configs.
     *
     * @param AbstractController $Controller
     * @param array $aParams
     * @param mixed $mExceptionCode
     * @throws Exception
     */
    public function checkRequestParams(AbstractController $Controller, array $aParams, $mExceptionCode = 0)
    {
        $aRawParams = array_merge($_GET, $_POST, $aParams);

        foreach ($Controller->RequestParamConfigs() as $RequestParamConfig)
        {
            if (array_key_exists($RequestParamConfig->getName(), $aRawParams))
            {
                $sTypeValue = $RequestParamConfig->getTypeValue();
                $mValue = $aRawParams[$RequestParamConfig->getName()];

                if (!class_exists($sTypeValue)) {
                    settype($mValue, $sTypeValue);
                }

                $Controller->setParam($RequestParamConfig->getName(), $mValue);
            }

            elseif ($RequestParamConfig->isRequired())
            {
                throw new Exception("Incomplete request : {$RequestParamConfig->getName()}", $mExceptionCode);
            }

            else
            {
                $Controller->setParam($RequestParamConfig->getName(), null);
            }
        }
    }

    /**
     * Returns the RequestParamConfig array.
     *
     * @return RequestParamConfig[]
     */
    public function RequestParamConfigs()
    {
        return [];
    }

    /**
     * Returns the namespace.
     *
     * @return string
     */
    public function getNamespace()
    {
        return static::class;
    }

    /**
     * Returns the Ctrl.
     *
     * @return string
     */
    public function getCtrl()
    {
        $aPatterns = [];
        $aPatterns[0] = '`(\\\\[a-zA-Z]+)$`';
        $aPatterns[1] = '`Hamtaro\\\\`';
        $aPatterns[2] = '`App\\\\`';
        $aPatterns[3] = '`Controller\\\\Ajax\\\\`';
        $aPatterns[4] = '`Controller\\\\Component\\\\`';
        $aPatterns[5] = '`Controller\\\\Form\\\\`';
        $aPatterns[6] = '`Controller\\\\Modal\\\\`';
        $aPatterns[7] = '`Controller\\\\Page\\\\`';

        $aReplacements = [];
        $aReplacements[0] = '';
        $aReplacements[1] = '';
        $aReplacements[2] = '';
        $aReplacements[3] = '';
        $aReplacements[4] = '';
        $aReplacements[5] = '';
        $aReplacements[6] = '';
        $aReplacements[7] = '';

        return (string) preg_replace($aPatterns, $aReplacements, static::class);
    }

    /**
     * Returns the filepath relative to the src dir with $bAbsolute to false.
     *
     * @param bool $bAbsolute
     * @return string
     * @throws Exception
     */
    public function getFilepath(bool $bAbsolute = false)
    {
        $sFilename = (string) preg_replace("`Hamtaro\\\\`", '', $this->getNamespace());
        $sFilename = (string) preg_replace("`App\\\\`", '', $sFilename);
        $sFilename = (string) str_replace('\\', '/', $sFilename);
        $sHamtaroSrc = $this->Core->Config()->getHamtaroSrc();
        $sProjectSrc = $this->Core->Config()->getProjectSrc();

        if ($bAbsolute)
        { # is Hamtaro controller
            if (is_file("$sHamtaroSrc/$sFilename.php"))
            {
                $sFilename = "$sHamtaroSrc/$sFilename";
            }

            # Is project controller
            elseif (is_file("$sProjectSrc/$sFilename.php"))
            {
                $sFilename = "$sProjectSrc/$sFilename";
            }

            # Neither of the two, exception
            else
            {
                throw new Exception("No php file for {$this->getNamespace()}");
            }
        }

        return $sFilename;
    }

    /**
     * Returns true if the controller loading is allowed.
     *
     * @return bool
     */
    public function isAllowed()
    {
        return true;
    }

    /**
     * @return $this
     */
    public function setParam(string $sKey, $mValue)
    {
        $this->aParams[$sKey] = $mValue;
        return $this;
    }
}