<?php
namespace Hamtaro\Module;

use Exception;

/**
 * The Workflow module.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class Workflow extends AbstractModule
{
    /**
     * Create a controller.
     *
     * @param string $sCtrl
     * @param string $sSrcFolder
     * @param array $aTemplates
     * @return void
     * @throws Exception
     */
    public function createController(string $sCtrl, string $sSrcFolder, array $aTemplates)
    {
        preg_match('`/?([a-zA-Z]+)$`', $sCtrl, $aMatches);
        $sClassName = $aMatches[1] ?? '';
        
        $sBasepath = $this->Core->Config()->getBasepath();
        $sVendorDir = "$sBasepath/vendor";
        $sFolderTarget = "$sBasepath/src/$sSrcFolder/";
        $sFolderTarget .= (count($aTemplates) > 1) ? $sCtrl : '';

        # Create the page folder
        if (!is_dir($sFolderTarget))
        {
            mkdir($sFolderTarget, 0777, true);
        }

        $aConfig = include realpath("$sBasepath/src/main.php");
        $sWorkflowDir = "$sVendorDir/cejobelo/hamtaro/src/Workflow";
        $sAppWorkflowDir = realpath("$sVendorDir/../src/Workflow");

        foreach ($aTemplates as $sTemplate)
        {
            preg_match('`^(?:.*[\.|\/])?([a-zA-Z]+)\..+$`', $sTemplate, $aMatches);
            $sExtension = $aMatches[1] ?? '';
            $sWorkflowFile = is_file($sAppWorkflowDir) ? "$sAppWorkflowDir/$sTemplate" : "$sWorkflowDir/$sTemplate";

            if (!is_file($sWorkflowFile))
            {
                throw new Exception("Worflow template doesn't exist : $sTemplate");
            }

            $sContent = file_get_contents($sWorkflowFile);
            $sContent = str_replace('{{AUTHOR}}', $aConfig['author'], $sContent);
            $sContent = str_replace('{{EMAIL}}', $aConfig['email'], $sContent);
            $sContent = str_replace('{{NAME}}', $sClassName, $sContent);
            $sContent = str_replace('{{CTRL}}', $sCtrl, $sContent);
            file_put_contents("$sFolderTarget/$sClassName.$sExtension", $sContent);
        }
    }
}