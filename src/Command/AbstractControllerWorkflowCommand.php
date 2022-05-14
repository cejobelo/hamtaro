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
abstract class AbstractControllerWorkflowCommand extends AbstractCommand
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
     * @see AbstractCommand::ArgumentConfigs()
     */
    public static function ArgumentConfigs()
    {
        return [
            new ArgumentConfig('#1', 'string', true, "the Ctrl"),
        ];
    }

    /**
     * @inheritDoc
     * @throws Exception
     * @see AbstractCommand::run()
     */
    public static function run(Event $Event)
    {
        $aArguments = static::checkArguments($Event->getArguments());
        (new Core)->Workflow()->createController($aArguments['#1'], static::getSrcTarget(), static::getTemplates());
    }
}