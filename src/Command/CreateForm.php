<?php
namespace Hamtaro\Command;

use Composer\Script\Event;

/**
 * Creates a new form to your Hamtaro application.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class CreateForm extends AbstractWorkflowCreationCommand
{
    /**
     * @inheritDoc
     * @see AbstractWorkflowCreationCommand::getSrcFolder()
     */
    public static function getSrcFolder()
    {
        return 'Controller/Form';
    }

    /**
     * @inheritDoc
     * @see AbstractWorkflowCreationCommand::getTemplates()
     */
    public static function getTemplates()
    {
        return [
            'NewForm/js.template',
            'NewForm/php.template',
            'NewForm/sass.template',
            'NewForm/twig.template',
        ];
    }
}