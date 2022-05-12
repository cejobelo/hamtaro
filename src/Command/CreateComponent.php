<?php
namespace Hamtaro\Command;

use Composer\Script\Event;

/**
 * Creates a new component to your Hamtaro application.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class CreateComponent extends AbstractCommand
{
    use TraitWorkflowCreationCommand;

    /**
     * @inheritDoc
     * @see TraitWorkflowCreationCommand::getSrcFolder()
     */
    public static function getSrcFolder()
    {
        return 'Controller/Component';
    }

    /**
     * @inheritDoc
     * @see TraitWorkflowCreationCommand::getTemplates()
     */
    public static function getTemplates()
    {
        return [
            'NewComponent/js.template',
            'NewComponent/php.template',
            'NewComponent/sass.template',
            'NewComponent/twig.template',
        ];
    }
}