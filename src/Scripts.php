<?php
namespace Hamtaro;

use Composer\Script\Event;
use Exception;

/**
 *
 */
class Scripts
{
    /**
     * Creates a new AjaxRequest to the Hamtaro project.
     *
     * @param Event $Event
     * @return void
     * @throws Exception
     */
    public static function ajax(Event $Event)
    {
        $aInfos = static::init($Event, 'Controller/Ajax');

        // PHP template
        $sPHPTemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/Ajax.php.template");
        $sPHPTemplate = str_replace('{{AUTHOR}}', $aInfos['config']['author'], $sPHPTemplate);
        $sPHPTemplate = str_replace('{{EMAIL}}', $aInfos['config']['email'], $sPHPTemplate);
        $sPHPTemplate = str_replace('{{NAME}}', $aInfos['className'], $sPHPTemplate);
        $sPHPTemplate = str_replace('{{CTRL}}', $aInfos['ctrl'], $sPHPTemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.php", $sPHPTemplate);
    }

    /**
     * Creates a new page to the Hamtaro project.
     *
     * @param Event $Event
     * @return void
     * @throws Exception
     */
    public static function page(Event $Event)
    {
        $aInfos = static::init($Event, 'Controller/Page');

        // PHP template
        $sPHPTemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/page/php.template");
        $sPHPTemplate = str_replace('{{AUTHOR}}', $aInfos['config']['author'], $sPHPTemplate);
        $sPHPTemplate = str_replace('{{EMAIL}}', $aInfos['config']['email'], $sPHPTemplate);
        $sPHPTemplate = str_replace('{{NAME}}', $aInfos['className'], $sPHPTemplate);
        $sPHPTemplate = str_replace('{{CTRL}}', $aInfos['ctrl'], $sPHPTemplate);
        $sPHPTemplate = str_replace('{{URL}}', strtolower($aInfos['className']), $sPHPTemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.php", $sPHPTemplate);

        // JAVASCRIPT template
        $sJSemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/page/js.template");
        $sJSemplate = str_replace('{{AUTHOR}}', $aInfos['config']['author'], $sJSemplate);
        $sJSemplate = str_replace('{{EMAIL}}', $aInfos['config']['email'], $sJSemplate);
        $sJSemplate = str_replace('{{NAME}}', $aInfos['className'], $sJSemplate);
        $sJSemplate = str_replace('{{CTRL}}', $aInfos['ctrl'], $sJSemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.js", $sJSemplate);

        // TWIG template
        $sTWIGTemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/page/twig.template");
        $sTWIGTemplate = str_replace('{{CTRL}}', $aInfos['ctrl'], $sTWIGTemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.twig", $sTWIGTemplate);

        // SASS template
        $sSASSTemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/page/sass.template");
        $sSASSTemplate = str_replace('{{CTRL}}', $aInfos['ctrl'], $sSASSTemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.sass", $sSASSTemplate);
    }

    /**
     * Creates a new modal to the Hamtaro project.
     *
     * @param Event $Event
     * @return void
     * @throws Exception
     */
    public static function modal(Event $Event)
    {
        $aInfos = static::init($Event, 'Controller/Modal');

        // PHP template
        $sPHPTemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/modal/php.template");
        $sPHPTemplate = str_replace('{{AUTHOR}}', $aInfos['config']['author'], $sPHPTemplate);
        $sPHPTemplate = str_replace('{{EMAIL}}', $aInfos['config']['email'], $sPHPTemplate);
        $sPHPTemplate = str_replace('{{NAME}}', $aInfos['className'], $sPHPTemplate);
        $sPHPTemplate = str_replace('{{CTRL}}', $aInfos['ctrl'], $sPHPTemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.php", $sPHPTemplate);

        // JAVASCRIPT template
        $sJSemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/modal/js.template");
        $sJSemplate = str_replace('{{AUTHOR}}', $aInfos['config']['author'], $sJSemplate);
        $sJSemplate = str_replace('{{EMAIL}}', $aInfos['config']['email'], $sJSemplate);
        $sJSemplate = str_replace('{{NAME}}', $aInfos['className'], $sJSemplate);
        $sJSemplate = str_replace('{{CTRL}}', $aInfos['ctrl'], $sJSemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.js", $sJSemplate);

        // TWIG template
        $sTWIGTemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/modal/twig.template");
        $sTWIGTemplate = str_replace('{{CTRL}}', $aInfos['ctrl'], $sTWIGTemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.twig", $sTWIGTemplate);

        // SASS template
        $sSASSTemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/modal/sass.template");
        $sSASSTemplate = str_replace('{{CTRL}}', $aInfos['ctrl'], $sSASSTemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.sass", $sSASSTemplate);
    }

    /**
     * Creates a new form to the Hamtaro project.
     *
     * @param Event $Event
     * @return void
     * @throws Exception
     */
    public static function form(Event $Event)
    {
        $aInfos = static::init($Event, 'Controller/Form');

        // PHP template
        $sPHPTemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/form/php.template");
        $sPHPTemplate = str_replace('{{AUTHOR}}', $aInfos['config']['author'], $sPHPTemplate);
        $sPHPTemplate = str_replace('{{EMAIL}}', $aInfos['config']['email'], $sPHPTemplate);
        $sPHPTemplate = str_replace('{{NAME}}', $aInfos['className'], $sPHPTemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.php", $sPHPTemplate);

        // JAVASCRIPT template
        $sJSemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/form/js.template");
        $sJSemplate = str_replace('{{AUTHOR}}', $aInfos['config']['author'], $sJSemplate);
        $sJSemplate = str_replace('{{EMAIL}}', $aInfos['config']['email'], $sJSemplate);
        $sJSemplate = str_replace('{{NAME}}', $aInfos['className'], $sJSemplate);
        $sJSemplate = str_replace('{{CTRL}}', $aInfos['ctrl'], $sJSemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.js", $sJSemplate);

        // TWIG template
        $sTWIGTemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/form/twig.template");
        $sTWIGTemplate = str_replace('{{CTRL}}', $aInfos['ctrl'], $sTWIGTemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.twig", $sTWIGTemplate);

        // SASS template
        $sSASSTemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/form/sass.template");
        $sSASSTemplate = str_replace('{{CTRL}}', $aInfos['ctrl'], $sSASSTemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.sass", $sSASSTemplate);
    }

    /**
     * Creates a new component to the Hamtaro project.
     *
     * @param Event $Event
     * @return void
     * @throws Exception
     */
    public static function component(Event $Event)
    {
        $aInfos = static::init($Event, 'Controller/Component');

        // PHP template
        $sPHPTemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/component/php.template");
        $sPHPTemplate = str_replace('{{AUTHOR}}', $aInfos['config']['author'], $sPHPTemplate);
        $sPHPTemplate = str_replace('{{EMAIL}}', $aInfos['config']['email'], $sPHPTemplate);
        $sPHPTemplate = str_replace('{{NAME}}', $aInfos['className'], $sPHPTemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.php", $sPHPTemplate);

        // JAVASCRIPT template
        $sJSemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/component/js.template");
        $sJSemplate = str_replace('{{AUTHOR}}', $aInfos['config']['author'], $sJSemplate);
        $sJSemplate = str_replace('{{EMAIL}}', $aInfos['config']['email'], $sJSemplate);
        $sJSemplate = str_replace('{{NAME}}', $aInfos['className'], $sJSemplate);
        $sJSemplate = str_replace('{{CTRL}}', $aInfos['ctrl'], $sJSemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.js", $sJSemplate);

        // TWIG template
        $sTWIGTemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/component/twig.template");
        $sTWIGTemplate = str_replace('{{CTRL}}', $aInfos['ctrl'], $sTWIGTemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.twig", $sTWIGTemplate);

        // SASS template
        $sSASSTemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/component/sass.template");
        $sSASSTemplate = str_replace('{{CTRL}}', $aInfos['ctrl'], $sSASSTemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.sass", $sSASSTemplate);
    }

    /**
     * Creates a new Javascript event to the Hamtaro project.
     *
     * @param Event $Event
     * @return void
     * @throws Exception
     */
    public static function jsevent(Event $Event)
    {
        $aInfos = static::init($Event, 'Javascript/Event');

        // JAVASCRIPT template
        $sPHPTemplate = file_get_contents("{$aInfos['vendorDir']}/cejobelo/hamtaro/workflow/Event.js.template");
        $sPHPTemplate = str_replace('{{AUTHOR}}', $aInfos['config']['author'], $sPHPTemplate);
        $sPHPTemplate = str_replace('{{EMAIL}}', $aInfos['config']['email'], $sPHPTemplate);
        $sPHPTemplate = str_replace('{{NAME}}', $aInfos['className'], $sPHPTemplate);
        file_put_contents("{$aInfos['folderTarget']}/{$aInfos['className']}.php", $sPHPTemplate);
    }

    /**
     * Init a script request.
     *
     * @param Event $Event
     * @param string $sFolder
     * @return array
     * @throws Exception
     */
    private static function init(Event $Event, string $sFolder)
    {
        $sCtrl = $Event->getArguments()[0] ?? '';
        preg_match('`/?([a-zA-Z]+)$`', $sCtrl, $aMatches);
        $sClassName = $aMatches[1] ?? '';

        if (!$sClassName)
        {
            throw new Exception("No class name");
        }

        $sVendorDir = $Event->getComposer()->getConfig()->get('vendor-dir');
        $sProjectPath = realpath("$sVendorDir/..");
        $sFolderTarget = "$sProjectPath/src/$sFolder/$sCtrl";

        # Create the page folder
        if (!is_dir($sFolderTarget))
        {
            mkdir($sFolderTarget, 0777, true);
        }

        $aConfig = include realpath("$sVendorDir/../src/config.php");

        return [
            'ctrl' => $sCtrl,
            'className' => $sClassName,
            'config' => $aConfig,
            'vendorDir' => $sVendorDir,
            'folderTarget' => $sFolderTarget,
        ];
    }
}