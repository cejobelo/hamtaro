<?php

namespace Hamtaro\Controller\Page;

use Hamtaro\Controller\Component\AbstractComponent;

/**
 * A page.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
abstract class AbstractPage extends AbstractComponent
{
    /**
     * @inheritDoc
     * @see AbstractComponent::getTemplate()
     */
    public function getTemplate()
    {
        return 'Template/page.twig';
    }

    /**
     * Returns the urls.
     *
     * @return Url[]
     */
    public function Urls()
    {
        return [];
    }

    /**
     * Returns the url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->Urls()[0]->getPath();
    }

    /**
     * Returns true if is matching.
     *
     * @param string $sUrl
     * @return bool
     */
    public function isMatching(string $sUrl)
    {
        foreach ($this->Urls() as $Url)
        {
            if (preg_match($Url->getPattern(), $sUrl, $aMatches))
            {
                foreach ($Url->getKeys() as $sKey)
                {
                    $this->aParams[$sKey] = $aMatches[$sKey];
                }
                return true;
            }
        }
        
        return false;
    }
}
