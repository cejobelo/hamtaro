<?php
namespace Hamtaro\Script\Workflow;

use Composer\Script\Event;
use Exception;
use Hamtaro\Script\AbstractScript;

/**
 * A workflow script.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
abstract class AbstractWorkflowScript extends AbstractScript
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
     * @see AbstractScript::run()
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

        $aConfig = include realpath("$sVendorDir/../src/config.php");
        $sWorkflowDir = "$sVendorDir/cejobelo/hamtaro/workflow";

        foreach (static::getTemplates() as $sTemplate)
        {
            preg_match('`^(?:.*[\.|\/])?([a-zA-Z]+)\..+$`', $sTemplate, $aMatches);
            $sExtension = $aMatches[1] ?? '';

            if (is_file("$sWorkflowDir/$sTemplate"))
            {
                $sContent = file_get_contents("$sWorkflowDir/$sTemplate");
                $sContent = str_replace('{{AUTHOR}}', $aConfig['author'], $sContent);
                $sContent = str_replace('{{EMAIL}}', $aConfig['email'], $sContent);
                $sContent = str_replace('{{NAME}}', $sClassName, $sContent);
                $sContent = str_replace('{{CTRL}}', $sCtrl, $sContent);
                file_put_contents("$sFolderTarget/$sClassName.$sExtension", $sContent);
            }
        }
    }
}