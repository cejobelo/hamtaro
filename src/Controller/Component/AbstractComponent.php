<?php
namespace Hamtaro\Controller\Component;

use Exception;
use Hamtaro\Controller\AbstractController;
use Hamtaro\Controller\Modal\AbstractModal;
use Hamtaro\Controller\Page\AbstractPage;
use Hamtaro\Core;

/**
 * A component.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
abstract class AbstractComponent extends AbstractController
{
    /**
     * Parameters values.
     *
     * @var array $aParams
     * @see \Hamtaro\Controller\AbstractController::ParamConfigs()
     */
    protected array $aParams = [];

    /**
     * The Wrapper instance.
     *
     * @var HtmlWrapper $Wrapper
     */
    protected HtmlWrapper $Wrapper;

    /**
     * Javascript data.
     *
     * @var array $aJsData
     */
    protected array $aJsData = [];

    /**
     * @inheritDoc
     * @see AbstractController::__construct()
     * @param Core $Core
     * @param array $aParams
     * @throws Exception
     */
    public function __construct(Core $Core, array $aParams = [])
    {
        parent::__construct($Core);

        $this->Wrapper = (new HtmlWrapper([
            'class' => 'hamtaro-component',
            'data-ctrl' => $this->getCtrl(),
        ]))->addAttrs($this->aParams['attrs'] ?? []);

        foreach ($this->ParamConfigs() as $ParamConfig)
        {
            if (array_key_exists($ParamConfig->getName(), $aParams))
            {
                $sTypeValue = $ParamConfig->getTypeValue();
                $mValue = $aParams[$ParamConfig->getName()];
                settype($mValue, $sTypeValue);
                $this->aParams[$ParamConfig->getName()] = $mValue;
            }

            elseif ($ParamConfig->isRequired())
            {
                throw new Exception("Missing component param : {$ParamConfig->getName()}");
            }
        }
    }

    /**
     * Returns the twig template of the component.
     *
     * @return string
     */
    public function getTemplate()
    {
        return '';
    }

    /**
     * Configure your params.
     * They are available in $this->aParams.
     *
     * @return ParamConfig[]
     * @see \Hamtaro\Controller\AbstractController::$aParams
     */
    public function ParamConfigs()
    {
        return [];
    }

    /**
     * Executed before the rendering of the component.
     *
     * @return void
     */
    public function beforeRendering()
    {
    }

    /**
     * Returns the html view.
     *
     * @param array $aData
     * @return string
     * @throws Exception
     * @throws Exception
     */
    final public function getView(array $aData = [])
    {
        try
        {
            # Maybe there is something to do before the page is displayed
            $this->beforeRendering();

            $sFilepath = $this->getFilepath();
            $oRenderTwig = $this->Core->Ui()->RenderTwig()->setDebug(false);

            # All the data for the template
            $aData = array_merge($this->Core->Ui()->getGlobalVariables(), $this->aParams, $aData, ['Head' => $this->Core->Head()]);

            # The twig file must be created
            if (!is_file("{$this->getFilepath(true)}.twig"))
            {
                throw new Exception("Exception : the .twig template doesn't exist for your component $sFilepath");
            }

            $sComponent = $oRenderTwig->setPath($sFilepath)->setDatas($aData)->render();

            if ($this instanceof AbstractPage)
            { # The wrapper
                $sComponent = "{$this->Wrapper->opening()}$sComponent{$this->Wrapper->closing()}";

                # The component is a page, so we build it with the html structure
                if ($sTwigTemplate = $this->getTemplate())
                { # Adds the twig template
                    $sComponent = str_replace(
                        '<!--COMPONENT-->',
                        $sComponent,
                        $oRenderTwig->setPath($sTwigTemplate)->setDatas($aData)->render()
                    );
                }

                return str_replace(
                    '<!--PAGE-->',
                    $sComponent,
                    $oRenderTwig->setPath($this->Core->Ui()->getIndexFilepath())->setDatas($aData)->render()
                );
            }

            elseif ($this instanceof AbstractModal)
            { # The component is a modal, so we build it with the modal structure
                if ($sTwigTemplate = $this->getTemplate())
                { # Adds the twig template
                    $sComponent = str_replace(
                        '<!--COMPONENT-->',
                        $sComponent,
                        $oRenderTwig->setPath($sTwigTemplate)->setDatas($aData)->render()
                    );
                }

                # The wrapper
                $sComponent = "{$this->Wrapper->opening()}$sComponent{$this->Wrapper->closing()}";
            }

            else if ($sTwigTemplate = $this->getTemplate())
            { # The wrapper
                $sComponent = "{$this->Wrapper->opening()}$sComponent{$this->Wrapper->closing()}";

                # Adds the twig template
                $sComponent = str_replace(
                    '<!--COMPONENT-->',
                    $sComponent,
                    $oRenderTwig->setPath($sTwigTemplate)->setDatas($aData)->render()
                );
            }

            else
            { # The wrapper
                $sComponent = "{$this->Wrapper->opening()}$sComponent{$this->Wrapper->closing()}";
            }

            return $sComponent;
        }

        catch (Exception $Exception)
        {
            die("[AbstractComponent::getView] {$Exception->getMessage()}");
        }
    }
}