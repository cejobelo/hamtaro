<?php
namespace Hamtaro\Script\Workflow;

use Composer\Script\Event;

/**
 * Creates a new ajax request to the Hamtaro project.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class CreateAjaxRequest extends AbstractWorkflowScript
{
    /**
     * @inheritDoc
     * @see AbstractWorkflowScript::getSrcFolder()
     */
    public static function getSrcFolder()
    {
        return 'Controller/Ajax';
    }

    /**
     * @inheritDoc
     * @see AbstractWorkflowScript::getTemplates()
     */
    public static function getTemplates()
    {
        return [
            'Ajax.php.template',
        ];
    }
}