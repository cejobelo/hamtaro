<?php

namespace Hamtaro\Controller\Modal;

use Exception;
use Hamtaro\Controller\Component\AbstractComponent;
use Hamtaro\Module\Response;

/**
 * A modale.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
abstract class AbstractModal extends AbstractComponent
{
    /**
     * Returns the url id.
     *
     * @return string
     */
    public function getUrlId()
    {
        return '';
    }

    /**
     * Returns the modale title.
     *
     * @return string
     */
    public function getTitle()
    {
        return '';
    }

    /**
     * Returns true if the modale is closable.
     *
     * @return bool
     */
    public function isClosable()
    {
        return true;
    }

    /**
     * Returns true if the modale has header.
     *
     * @return bool
     */
    public function hasHeader()
    {
        return true;
    }

    /**
     * @inheritdoc
     * @see AbstractComponent::beforeRendering()
     */
    public function beforeRendering()
    {
        $this->aParams['ComponentModal'] = $this;

        $this->Wrapper->addAttrs([
            'class' => 'hamtaro-modal modal fade',
            'data-modal-urlid' => $this->getUrlId(),
            'data-ctrl' => $this->getCtrl(),
        ]);
    }

    /**
     * @inheritdoc
     * @see AbstractComponent::getTemplate()
     */
    public function getTemplate()
    {
        return 'Controller/Modal/template.twig';
    }

    /**
     * Returns the Response instance.
     *
     * @return Response
     * @throws Exception
     */
    public function Response()
    {
        $this->beforeRendering();
        return $this->Core->Response()->getSuccess('Nickel')->setExtraParam('modal', [
            'ctrl' => $this->getCtrl(),
            'jsData' => $this->aJsData,
            'html' => $this->getView(),
        ]);
    }
}