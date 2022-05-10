<?php
namespace Hamtaro\Script\Workflow;

use Composer\Script\Event;

/**
 * Creates a new modal to the Hamtaro project.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class CreateModal extends AbstractWorkflowScript
{
    /**
     * @inheritDoc
     * @see AbstractWorkflowScript::getSrcFolder()
     */
    public static function getSrcFolder()
    {
        return 'Controller/Modal';
    }

    /**
     * @inheritDoc
     * @see AbstractWorkflowScript::getTemplates()
     */
    public static function getTemplates()
    {
        return [
            'modal/js.template',
            'modal/php.template',
            'modal/sass.template',
            'modal/twig.template',
        ];
    }
}