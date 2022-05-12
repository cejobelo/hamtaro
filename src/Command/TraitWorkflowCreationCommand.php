<?php
namespace Hamtaro\Command;

use Composer\Script\Event;
use Exception;

/**
 * Create files with templates for your workflow.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
trait TraitWorkflowCreationCommand
{
    /**
     * Returns the folder name in src/.
     *
     * @return string
     */
    abstract public static function getSrcFolder();

    /**
     * Returns the template path.
     *
     * @return string[]
     */
    abstract public static function getTemplates();

    /**
     * @inheritDoc
     * @throws Exception
     * @see AbstractCommand::run()
     */
    public static function run(Event $Event)
    {
        $aArguments = $Event->getArguments() ?? [];
        $sCtrl = $aArguments[0] ?? '';

        if (!$sCtrl)
        {
            throw new Exception("Argument 1 is required : CamelCaseName");
        }

        preg_match('`/?([a-zA-Z]+)$`', $sCtrl, $aMatches);
        $sClassName = $aMatches[1] ?? '';

        $sVendorDir = $Event->getComposer()->getConfig()->get('vendor-dir');
        $sProjectPath = realpath("$sVendorDir/..");
        $sSrcFolder = static::getSrcFolder();
        $sFolderTarget = "$sProjectPath/src/$sSrcFolder/";
        $sFolderTarget .= (count(static::getTemplates()) > 1) ? $sCtrl : '';

        # Create the page folder
        if (!is_dir($sFolderTarget))
        {
            mkdir($sFolderTarget, 0777, true);
        }

        $aConfig = include realpath("$sVendorDir/../src/main.php");
        $sWorkflowDir = "$sVendorDir/cejobelo/hamtaro/src/Workflow";
        $sAppWorkflowDir = realpath("$sVendorDir/../src/Workflow");

        foreach (static::getTemplates() as $sTemplate)
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