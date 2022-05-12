<?php
namespace Hamtaro\Command;

use Composer\Script\Event;

/**
 * Create a new modal to your Hamtaro application.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class CreateModal extends AbstractCommand
{
    use TraitWorkflowCreationCommand;

    /**
     * @inheritDoc
     * @see TraitWorkflowCreationCommand::getSrcFolder()
     */
    public static function getSrcFolder()
    {
        return 'Controller/Modal';
    }

    /**
     * @inheritDoc
     * @see TraitWorkflowCreationCommand::getTemplates()
     */
    public static function getTemplates()
    {
        return [
            'NewModal/js.template',
            'NewModal/php.template',
            'NewModal/sass.template',
            'NewModal/twig.template',
        ];
    }
}