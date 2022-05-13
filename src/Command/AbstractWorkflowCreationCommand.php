<?php
namespace Hamtaro\Command;

use Composer\Script\Event;
use Exception;
use Hamtaro\Core;

/**
 * Create files with templates for your workflow.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
abstract class AbstractWorkflowCreationCommand extends AbstractCommand
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
            throw new Exception("Argument #1 is required : CamelCaseName");
        }

        (new Core)->Workflow()->createController($sCtrl, static::getSrcFolder(), static::getTemplates());
    }
}