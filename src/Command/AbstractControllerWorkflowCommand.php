<?php
namespace Hamtaro\Command;

use Composer\Script\Event;
use Exception;
use Hamtaro\Core;

/**
 * Create controller files with templates for improve your workflow.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
abstract class AbstractControllerWorkflowCommand implements InterfaceCommand
{
    /**
     * Returns the src target.
     * Example : will return Event for src/Event.
     *
     * @return string
     */
    abstract public static function getSrcTarget();

    /**
     * Returns the template paths.
     *
     * @return string[]
     */
    abstract public static function getTemplates();

    /**
     * @inheritDoc
     * @throws Exception
     * @see InterfaceCommand::run()
     */
    public static function run(Event $Event)
    {
        $aArguments = $Event->getArguments() ?? [];
        $sCtrl = $aArguments[0] ?? '';

        if (!$sCtrl)
        {
            throw new Exception("Argument #1 is required : CamelCaseName");
        }

        (new Core)->Workflow()->createController($sCtrl, static::getSrcTarget(), static::getTemplates());
    }
}