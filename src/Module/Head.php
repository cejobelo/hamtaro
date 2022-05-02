<?php
namespace Hamtaro\Module;

/**
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class Head extends AbstractModule
{
    private array $aRedirect = [];
    private string $sTitle = '';
    private string $sShortName = '';
    private string $sMetadescription = '';
    private string $sMetakeywords = '';
    private string $sMetaPicture = '';
    private string $sMetaPictureAlt = '';
    private string $sMetaMimeType = '';
    private int $iMetaPictureWidth = 0;
    private int $iMetaPictureHeight = 0;
    private string $sThemeColor = '';

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->sTitle = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->sTitle;
    }

    /**
     * @param string $shortname
     * @return $this
     */
    public function setShortName(string $shortname)
    {
        $this->sShortName = $shortname;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        return $this->sShortName;
    }

    /**
     * @param string $metadescription
     * @return $this
     */
    public function setMetadescription(string $metadescription)
    {
        $this->sMetadescription = $metadescription;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetadescription()
    {
        return $this->sMetadescription;
    }

    /**
     * @param string $metakeywords
     * @return $this
     */
    public function setMetakeywords(string $metakeywords)
    {
        $this->sMetakeywords = $metakeywords;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetakeywords()
    {
        return $this->sMetakeywords;
    }

    /**
     * @param string $metaPicture
     * @return $this
     */
    public function setMetaPicture(string $metaPicture)
    {
        $this->sMetaPicture = $metaPicture;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetaPicture()
    {
        return $this->sMetaPicture;
    }

    /**
     * @param string $metaPictureAlt
     * @return $this
     */
    public function setMetaPictureAlt(string $metaPictureAlt)
    {
        $this->sMetaPictureAlt = $metaPictureAlt;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetaPictureAlt()
    {
        return $this->sMetaPictureAlt;
    }

    /**
     * @param string $metaMimeType
     * @return $this
     */
    public function setMetaMimeType(string $metaMimeType)
    {
        $this->sMetaMimeType = $metaMimeType;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetaMimeType()
    {
        return $this->sMetaMimeType;
    }

    /**
     * @param string $metaPictureWidth
     * @return $this
     */
    public function setMetaPictureWidth(string $metaPictureWidth)
    {
        $this->iMetaPictureWidth = $metaPictureWidth;
        return $this;
    }

    /**
     * @return int
     */
    public function getMetaPictureWidth()
    {
        return $this->iMetaPictureWidth;
    }

    /**
     * @param string $metaPictureHeight
     * @return $this
     */
    public function setMetaPictureHeight(string $metaPictureHeight)
    {
        $this->iMetaPictureHeight = $metaPictureHeight;
        return $this;
    }

    /**
     * @return int
     */
    public function getMetaPictureHeight()
    {
        return $this->iMetaPictureHeight;
    }

    /**
     * @param string $themecolor
     * @return $this
     */
    public function setThemeColor(string $themecolor)
    {
        $this->sThemeColor = $themecolor;
        return $this;
    }

    /**
     * @return string
     */
    public function getThemeColor()
    {
        return $this->sThemeColor;
    }

    /**
     * @param int $delay
     * @param string $url
     * @return $this
     */
    public function setRedirect(int $delay, string $url)
    {
        $this->aRedirect = [
            'delay' => $delay,
            'url' => $url,
        ];
        return $this;
    }

    /**
     * @return array
     */
    public function getRedirect()
    {
        return $this->aRedirect;
    }
}