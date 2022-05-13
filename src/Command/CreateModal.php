<?php
namespace Hamtaro\Command;

/**
 * Create a new modal to your Hamtaro application.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class CreateModal extends AbstractControllerWorkflowCommand
{
    /**
     * @inheritDoc
     * @see AbstractControllerWorkflowCommand::getSrcTarget()
     */
    public static function getSrcTarget()
    {
        return 'Controller/Modal';
    }

    /**
     * @inheritDoc
     * @see AbstractControllerWorkflowCommand::getTemplates()
     */
    public static function getTemplates()
    {
        return [
            'Modal/js.template',
            'Modal/php.template',
            'Modal/sass.template',
            'Modal/twig.template',
        ];
    }
}