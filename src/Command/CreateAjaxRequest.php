<?php
namespace Hamtaro\Command;

/**
 * Create a new ajax request to your Hamtaro application.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class CreateAjaxRequest extends AbstractControllerWorkflowCommand
{
    /**
     * @inheritDoc
     * @see AbstractControllerWorkflowCommand::getSrcTarget()
     */
    public static function getSrcTarget()
    {
        return 'Controller/Ajax';
    }

    /**
     * @inheritDoc
     * @see AbstractControllerWorkflowCommand::getTemplates()
     */
    public static function getTemplates()
    {
        return 'Ajax.php.template';
    }
}