<?php
namespace Hamtaro\Controller\Ajax;

use Hamtaro\Controller\AbstractController;
use Hamtaro\Module\Response;

/**
 * An ajax request.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
abstract class AbstractAjaxRequest extends AbstractController
{
    /**
     * Execute and return the Response instance.
     *
     * @return Response
     */
    abstract public function executeAndGetResponse();
}