<?php
namespace Hamtaro\Script\Workflow;

use Composer\Script\Event;

/**
 * Creates a new Javascript event to the Hamtaro project.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class CreateJavascriptEvent extends AbstractWorkflowScript
{
    /**
     * @inheritDoc
     * @see AbstractWorkflowScript::getSrcFolder()
     */
    public static function getSrcFolder()
    {
        return 'Javascript/Event';
    }

    /**
     * @inheritDoc
     * @see AbstractWorkflowScript::getTemplates()
     */
    public static function getTemplates()
    {
        return [
            'Event.js.template',
        ];
    }
}