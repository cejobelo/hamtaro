<?php
namespace Hamtaro\Command;

/**
 * Create a new page to your Hamtaro application.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class CreatePage extends AbstractControllerWorkflowCommand
{
    /**
     * @inheritDoc
     * @see AbstractControllerWorkflowCommand::getSrcTarget()
     */
    public static function getSrcTarget()
    {
        return 'Controller/Page';
    }

    /**
     * @inheritDoc
     * @see AbstractControllerWorkflowCommand::getTemplates()
     */
    public static function getTemplates()
    {
        return [
            'Page/js.template',
            'Page/php.template',
            'Page/sass.template',
            'Page/twig.template',
        ];
    }
}