<?php
namespace Hamtaro\Controller;

use Exception;
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
     * @var Core|\App\Core $Core
     */
    protected Core $Core;

    /**
     * Parameters values.
     *
     * @var array $aParams
     * @see \Hamtaro\Controller\AbstractController::ParamConfigs()
     */
    protected array $aParams = [];

    /**
     * Inputs values.
     *
     * @var array $aInputs
     * @see \Hamtaro\Controller\AbstractController::InputConfigs()
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
     * Configure your params.
     * They are available in $this->aParams.
     *
     * @return ParamConfig[]
     * @see \Hamtaro\Controller\AbstractController::$aParams
     */
    public function ParamConfigs()
    {
        return [];
    }

    /**
     * Configure your inputs.
     * They are available in $this->aInputs.
     *
     * @return InputConfig[]
     * @see \Hamtaro\Controller\AbstractController::$aInputs
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