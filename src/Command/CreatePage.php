<?php
namespace Hamtaro\Command;

use Composer\Script\Event;

/**
 * Create a new page to your Hamtaro project.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class CreatePage extends AbstractCommand
{
    use TraitWorkflowCreationCommand;

    /**
     * @inheritDoc
     * @see TraitWorkflowCreationCommand::getSrcFolder()
     */
    public static function getSrcFolder()
    {
        return 'Controller/Page';
    }

    /**
     * @inheritDoc
     * @see TraitWorkflowCreationCommand::getTemplates()
     */
    public static function getTemplates()
    {
        return [
            'NewPage/js.template',
            'NewPage/php.template',
            'NewPage/sass.template',
            'NewPage/twig.template',
        ];
    }
}