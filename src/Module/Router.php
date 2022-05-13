<?php
namespace Hamtaro\Module;

use Exception;
use Hamtaro\Controller\Ajax\AbstractAjaxRequest;
use Hamtaro\Controller\Form\AbstractForm;
use Hamtaro\Controller\Modal\AbstractModal;
use Hamtaro\Controller\Page\Error\Error;

/**
 * The Router.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class Router extends AbstractModule
{
    /**
     * Run the controller target.
     *
     * @return void|bool
     * @throws Exception
     */
    public function run()
    {
        $aParams = array_merge($_GET, $_POST, json_decode(file_get_contents("php://input"), true) ?: []);

        if (is_array($aParams) && array_key_exists('ctrl', $aParams))
        {
            $sCtrl = str_replace('/', '\\', $aParams['ctrl']);

            preg_match('`.+\\\\(.+)$`', $sCtrl, $aMatches);
            $sCtrl = "$sCtrl\\$aMatches[1]";

            # The controllers allowed to be loaded are specified in src/main.php
            if (!$this->Core->Config()->isAllowedNamespace($sCtrl))
            {
                return $this->Core->Response()->getFailure("The Ctrl « {$aParams['ctrl']} » isn't specified in your src/main.php file")->sendAjax();
            }

            # Controller instantiation
            $Controller = new $sCtrl($this->Core, $aParams);

            if (!$Controller)
            {
                return $this->Core->Response()->getFailure("Unknown Ctrl : $sCtrl")->sendAjax();
            }

            # Loading a modal
            elseif ($Controller instanceof AbstractModal)
            {
                if (!$Controller->isAllowed())
                {
                    return $this->Core->Response()->getFailure("Ctrl expressly not allowed : $sCtrl")->sendAjax();
                }

                return $Controller->Response()->getSuccess("Nickel")->sendAjax();
            }

            # Running a form
            elseif ($Controller instanceof AbstractForm)
            {
                if (!$Controller->isAllowed())
                {
                    return $this->Core->Response()->getFailure("Ctrl expressly not allowed : $sCtrl")->sendAjax();
                }
                
                return $Controller->checkInputs($aParams, 21)->executeAndGetResponse()->sendAjax();
            }

            # Running an ajax request
            elseif ($Controller instanceof AbstractAjaxRequest)
            {
                if (!$Controller->isAllowed())
                {
                    return $this->Core->Response()->getFailure("Ctrl expressly not allowed : $sCtrl")->sendAjax();
                }

                return $Controller->checkInputs($aParams, 21)->executeAndGetResponse()->sendAjax();
            }
        }

        # Loading a page
        $sUrl = $this->Core->Request()->getUrl();

        foreach ($this->Core->Cache()->Pages() as $Page)
        {
            if ($Page->isMatching($sUrl))
            {
                die($Page->getView());
            }
        }

        $sDefaultCtrl = $this->getDefaultCtrlNamespace();
        # The controllers allowed to be loaded are specified in src/main.php
        if (!$this->Core->Config()->isAllowedNamespace($sDefaultCtrl))
        {
            return $this->Core->Response()->getFailure("{$sDefaultCtrl} isn't specified in your src/main.php file")->sendAjax();
        }

        die((new $sDefaultCtrl($this->Core, $aParams))->getView());
    }

    /**
     * Returns the url.
     *
     * @param string $sCtrl
     * @param array $aReplacements
     * @return string
     * @throws Exception
     */
    public function getUrl(string $sCtrl, array $aReplacements = [])
    {
        foreach ($this->Core->Cache()->Pages() as $Page)
        {
            if ($Page->getCtrl() === $sCtrl)
            {
                $sUrl = $Page->getUrl();

                foreach ($aReplacements as $sKey => $mValue)
                {
                    $sUrl = str_replace("{{$sKey}}", $mValue, $sUrl);
                }

                return $sUrl;
            }
        }

        throw new Exception("No default url for $sCtrl");
    }

    /**
     * Returns the default namespace to load.
     *
     * @return string
     */
    public function getDefaultCtrlNamespace()
    {
        return Error::class;
    }
}