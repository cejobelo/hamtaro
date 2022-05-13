<?php
namespace Hamtaro\Command;

/**
 * Create a new form to your Hamtaro application.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class CreateForm extends AbstractControllerWorkflowCommand
{
    /**
     * @inheritDoc
     * @see AbstractControllerWorkflowCommand::getSrcTarget()
     */
    public static function getSrcTarget()
    {
        return 'Controller/Form';
    }

    /**
     * @inheritDoc
     * @see AbstractControllerWorkflowCommand::getTemplates()
     */
    public static function getTemplates()
    {
        return [
            'Form/js.template',
            'Form/php.template',
            'Form/sass.template',
            'Form/twig.template',
        ];
    }
}