<?php
namespace Hamtaro\Script\Workflow;

use Composer\Script\Event;

/**
 * Creates a new page to the Hamtaro project.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class CreatePage extends AbstractWorkflowScript
{
    /**
     * @inheritDoc
     * @see AbstractWorkflowScript::getSrcFolder()
     */
    public static function getSrcFolder()
    {
        return 'Controller/Page';
    }

    /**
     * @inheritDoc
     * @see AbstractWorkflowScript::getTemplates()
     */
    public static function getTemplates()
    {
        return [
            'page/js.template',
            'page/php.template',
            'page/sass.template',
            'page/twig.template',
        ];
    }
}