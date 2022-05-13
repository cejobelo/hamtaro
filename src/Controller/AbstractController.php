<?php
namespace Hamtaro\Controller;

use Exception;
use Hamtaro\Controller\Ajax\AbstractAjaxRequest;
use Hamtaro\Controller\Component\AbstractComponent;
use Hamtaro\Controller\Form\AbstractForm;
use Hamtaro\Controller\Modal\AbstractModal;
use Hamtaro\Controller\Page\AbstractPage;
use Hamtaro\Core;
use JsonSerializable;

/**
 * A controller.
 *
 * @link https://www.youtube.com/watch?v=kGOTIt2wJXs
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class AbstractController implements JsonSerializable
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
     * The inputs.
     *
     * @var array $aInputs
     */
    protected array $aInputs = [];

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

        foreach ($this->ParamConfigs() as $ParamConfig)
        {
            if (array_key_exists($ParamConfig->getName(), $aParams))
            {
                $sTypeValue = $ParamConfig->getTypeValue();
                $mValue = $aParams[$ParamConfig->getName()];
                settype($mValue, $sTypeValue);
                $this->aParams[$ParamConfig->getName()] = $mValue;
            }

            elseif ($ParamConfig->isRequired())
            {
                throw new Exception("Missing controller param : {$ParamConfig->getName()}");
            }
        }
    }

    /**
     * Returns the params configs for your $this->aParams.
     *
     * @return ParamConfig[]
     */
    public function ParamConfigs()
    {
        return [];
    }

    /**
     * Returns the RequestParamConfig array.
     *
     * @return RequestParamConfig[]
     */
    public function InputConfigs()
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
        $sAppSrc = $this->Core->Config()->getApplicationSrc();

        if ($bAbsolute)
        { # is Hamtaro controller
            if (is_file("$sHamtaroSrc/$sFilename.php"))
            {
                $sFilename = "$sHamtaroSrc/$sFilename";
            }

            # Is application controller
            elseif (is_file("$sAppSrc/$sFilename.php"))
            {
                $sFilename = "$sAppSrc/$sFilename";
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
     * @return bool
     */
    public function isAjaxRequest()
    {
        return $this instanceof AbstractAjaxRequest;
    }

    /**
     * @return bool
     */
    public function isComponent()
    {
        return $this instanceof AbstractComponent;
    }

    /**
     * @return bool
     */
    public function isForm()
    {
        return $this instanceof AbstractForm;
    }

    /**
     * @return bool
     */
    public function isModal()
    {
        return $this instanceof AbstractModal;
    }

    /**
     * @return bool
     */
    public function isPage()
    {
        return $this instanceof AbstractPage;
    }

    /**
     * Check inputs.
     *
     * @param array $aInputs
     * @param mixed $mExceptionCode
     * @return $this
     * @throws Exception
     */
    public function checkInputs(array $aInputs = [], $mExceptionCode = 0)
    {
        foreach ($this->InputConfigs() as $InputConfig)
        {
            if (array_key_exists($InputConfig->getName(), $aInputs))
            {
                $sTypeValue = $InputConfig->getTypeValue();
                $mValue = $aInputs[$InputConfig->getName()];
                settype($mValue, $sTypeValue);
                $this->aInputs[$InputConfig->getName()] = $mValue;
            }

            elseif ($InputConfig->isRequired())
            {
                throw new Exception("Missing input : {$InputConfig->getName()}", $mExceptionCode);
            }
        }

        return $this;
    }

    /**
     * @inheritDoc
     * @throws Exception
     * @see JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize() {
        return [
            'ctrl' => $this->getCtrl(),
            'namespace' => $this->getNamespace(),
            'filepath' => $this->getFilepath(),
        ];
    }
}