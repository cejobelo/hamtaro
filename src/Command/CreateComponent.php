<?php
namespace Hamtaro\Command;

/**
 * Create a new component to your Hamtaro application.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class CreateComponent extends AbstractControllerWorkflowCommand
{
    /**
     * @inheritDoc
     * @see AbstractControllerWorkflowCommand::getSrcTarget()
     */
    public static function getSrcTarget()
    {
        return 'Controller/Component';
    }

    /**
     * @inheritDoc
     * @see AbstractControllerWorkflowCommand::getTemplates()
     */
    public static function getTemplates()
    {
        return [
            'Component/js.template',
            'Component/php.template',
            'Component/sass.template',
            'Component/twig.template',
        ];
    }
}