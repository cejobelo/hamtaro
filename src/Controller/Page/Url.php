<?php
namespace Hamtaro\Controller\Page;

/**
 * An url.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class Url
{
    /**
     * The path.
     *
     * @var string
     */
    private string $sPath;

    /**
     * The lang.
     *
     * @var string
     */
    private string $sLang;

    /**
     * The constructor.
     *
     * @param string $sPath
     * @param string $sLang
     * @return void
     */
    public function __construct(string $sPath, string $sLang = '')
    {
        $this->sPath = $sPath;
        $this->sLang = $sLang;
    }

    /**
     * Returns the path.
     *
     * @return string
     */
    public function getPath(array $aReplacements = [])
    {
        $sPath = $this->sPath;

        foreach ($aReplacements as $sSearch => $sReplacement)
        {
            $sPath = str_replace($sSearch, $sReplacement, $sPath);
        }

        return $sPath;
    }

    /**
     * Returns the pattern.
     *
     * @return string
     */
    public function getPattern()
    {
        $sPattern = $this->sPath;
        $sPattern = str_replace('/', '\/', $sPattern);
        $sPattern = preg_replace('`\{([a-zA-Z0-9]+)\}`', '(?<$1>[a-zA-Z0-9]+)', $sPattern);
        return "`$sPattern`";
    }

    /**
     * Returns the keys.
     *
     * @return string[]
     */
    public function getKeys()
    {
        preg_match_all('`\{([a-zA-Z0-9]+)\}`', $this->sPath, $aMatches);
        return $aMatches[1] ?? [];
    }

    /**
     * Returns the lang.
     *
     * @return string
     */
    public function getLang()
    {
        return $this->sLang;
    }
}