<?php
namespace Hamtaro\Module;

use Exception;
use Hamtaro\Controller\Form\AbstractForm;
use Hamtaro\Controller\Modal\AbstractModal;

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
        $aParams = json_decode(file_get_contents("php://input"), true);

        if (is_array($aParams) && array_key_exists('ctrl', $aParams))
        {
            $sCtrl = str_replace('/', '\\', $aParams['ctrl']);

            preg_match('`.+\\\\(.+)$`', $sCtrl, $aMatches);
            $sCtrl = "$sCtrl\\$aMatches[1]";

            # The controllers allowed to be loaded are specified in src/config.php
            if (!$this->Core->Config()->isAllowedNamespace($sCtrl))
            {
                return $this->Core->Response()->getFailure("Ctrl not allowed : {$aParams['ctrl']}")->sendAjax();
            }

            # Controller instantiation
            $Controller = new $sCtrl($this->Core, $aParams);

            if (!$Controller)
            {
                return $this->Core->Response()->getFailure("Unknown ctrl : $sCtrl")->sendAjax();
            }

            # Loading a modal
            elseif ($Controller instanceof AbstractModal)
            {
                if (!$Controller->isAllowed())
                {
                    return $this->Core->Response()->getFailure("Not allowed")->sendAjax();
                }

                return $Controller->Response()->getSuccess("Nickel")->sendAjax();
            }

            # Running a form
            elseif ($Controller instanceof AbstractForm)
            {
                if (!$Controller->isAllowed())
                {
                    return $this->Core->Response()->getFailure("Not allowed")->sendAjax();
                }

                $Controller->checkRequestParams($Controller, $aParams, 2021);

                return $Controller->executeAndGetResponse($aParams)->sendAjax();
            }
        }

        # Loading a page
        $sUrl = $this->Core->Request()->getUrl();
        foreach ($this->Core->Config()->getPages() as $Page)
        {
            if ($Page->isMatching($sUrl))
            {
                die($Page->getView());
            }
        }
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
        foreach ($this->Core->Config()->getPages() as $Page)
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
}