<?php
namespace Hamtaro\Script\Workflow;

use Composer\Script\Event;

/**
 * Creates a new component to the Hamtaro project.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class CreateComponent extends AbstractWorkflowScript
{
    /**
     * @inheritDoc
     * @see AbstractWorkflowScript::getSrcFolder()
     */
    public static function getSrcFolder()
    {
        return 'Controller/Component';
    }

    /**
     * @inheritDoc
     * @see AbstractWorkflowScript::getTemplates()
     */
    public static function getTemplates()
    {
        return [
            'component/js.template',
            'component/php.template',
            'component/sass.template',
            'component/twig.template',
        ];
    }
}