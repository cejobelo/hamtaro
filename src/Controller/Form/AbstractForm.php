<?php
namespace Hamtaro\Controller\Form;

use Hamtaro\Controller\Component\AbstractComponent;
use Hamtaro\Module\Response;

/**
 * A form.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
abstract class AbstractForm extends AbstractComponent
{
    /**
     * @inheritdoc
     * @see AbstractComponent::beforeRendering()
     */
    public function beforeRendering()
    {
        $this->Wrapper->addAttrs([
            'method' => 'post',
            'class' => 'hamtaro-form',
        ])->setTagName('form');
    }

    /**
     * Execute and return the Response instance.
     *
     * @return Response
     */
    abstract public function executeAndGetResponse();
}