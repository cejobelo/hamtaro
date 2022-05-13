<?php
namespace Hamtaro\Module;

use Coercive\Utility\Render\RenderTwig;
use Exception;
use Hamtaro\Controller\Component\AbstractComponent;
use Hamtaro\Controller\Form\AbstractForm;

/**
 * The Ui module.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class Ui extends AbstractModule
{
    /**
     * Returns the Twig render instance.
     *
     * @return RenderTwig
     * @throws Exception
     */
    public function RenderTwig()
    {
        $Core = $this->Core;
        return (new RenderTwig($this->Core->Config()->getApplicationSrc()))
            ->setCache(false, $this->Core->Config()->getTmpDir())
            ->addGlobals($this->getGlobalVariables())
            ->addFunction('Component', function ($sId, array $aParams = []) use ($Core)
            {
                $sNamespace = "App\\Controller\\Component\\$sId\\$sId";
                preg_replace('`(\\\\.+)$`', "$1$1", $sNamespace);

                # The controllers allowed to be loaded are specified in src/main.php
                if (!$this->Core->Config()->isAllowedNamespace($sNamespace))
                {
                    throw new Exception("Not allowed : $sNamespace");
                }

                # The component class doesn't exist
                if (!class_exists($sNamespace))
                {
                    return "The component $sId doesn't exist.";
                }

                /** @var AbstractComponent $Component */
                $Component = new $sNamespace($Core, $aParams);
                return $Component->getView();
            })
            ->addFunction('Form', function ($sCtrl, array $aParams = []) use ($Core)
            {
                $sNamespace = "App\\Controller\\Form\\$sCtrl\\$sCtrl";
                preg_replace('`(\\\\.+)$`', "$1$1", $sNamespace);

                # The controllers allowed to be loaded are specified in src/main.php
                if (!$this->Core->Config()->isAllowedNamespace($sNamespace))
                {
                    throw new Exception("Not allowed : $sNamespace");
                }

                # The form class doesn't exist
                if (!class_exists($sNamespace))
                {
                    return "The form $sCtrl doesn't exist.";
                }

                /** @var AbstractForm $Form */
                $Form = new $sNamespace($Core, $aParams);
                return $Form->getView();
            })
            ->addDirectories([
                $this->Core->Config()->getApplicationSrc(),
                $this->Core->Config()->getHamtaroSrc(),
                $this->Core->Config()->getTmpDir(),
            ])->setFileExtension('.twig');
    }

    /**
     * Returns the index filepath.
     *
     * @return string
     */
    public function getIndexFilepath()
    {
        return 'Template/index.twig';
    }

    /**
     * Returns the global variables for twig templates.
     *
     * @return string[]
     */
    public function getGlobalVariables()
    {
        return [
            'Core' => $this->Core,
            'jsData' => [
                'url' => $this->Core->Request()->getUrl(),
                'URLS' => $this->Core->Cache()->getUrls(),
            ],
        ];
    }
}