<?php
namespace Hamtaro\Command;

use Composer\Script\Event;

/**
 * Create a new javascript event to your Hamtaro application.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class CreateEvent extends AbstractWorkflowCreationCommand
{
    /**
     * @inheritDoc
     * @see AbstractWorkflowCreationCommand::getSrcFolder()
     */
    public static function getSrcFolder()
    {
        return 'Event';
    }

    /**
     * @inheritDoc
     * @see AbstractWorkflowCreationCommand::getTemplates()
     */
    public static function getTemplates()
    {
        return [
            'Event.js.template',
        ];
    }
}