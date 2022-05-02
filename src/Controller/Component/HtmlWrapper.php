<?php
namespace Hamtaro\Controller\Component;

/**
 * Html wrapper.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class HtmlWrapper
{
    /**
     * Attributes.
     *
     * @var array $aAttrs
     */
    private array $aAttrs;

    /**
     * Tag name.
     *
     * @var string $sTagname
     */
    private string $sTagname = 'div';

    /**
     * The constructor.
     *
     * @param array $aAttrs
     * @return void
     */
    public function __construct(array $aAttrs = [])
    {
        $this->aAttrs = $aAttrs;
    }

    /**
     * Get tagname.
     *
     * @return string
     */
    public function getTagName()
    {
        return $this->sTagname;
    }

    /**
     * Set tagname.
     *
     * @param string $sTagname
     * @return $this
     */
    public function setTagName(string $sTagname)
    {
        $this->sTagname = $sTagname;
        return $this;
    }

    /**
     * Adds attributes.
     *
     * @param array $attrs
     * @return $this
     */
    public function addAttrs(array $attrs)
    {
        foreach ($attrs as $key => $value)
        {
            if ($key === 'class' && array_key_exists($key, $this->aAttrs))
            {
                $class = $this->aAttrs['class'] ?? '';
                $this->aAttrs['class'] = "$class $value";
            }

            else
            {
                $this->aAttrs[$key] = $value;
            }
        }
        return $this;
    }

    /**
     * Returns the html opening.
     *
     * @return string
     */
    public function opening()
    {
        $attrs = [];

        foreach ($this->aAttrs as $key => $value)
        {
            $value = htmlentities($value, ENT_QUOTES);
            $attrs[] = "$key='$value'";
        }

        $attrs = implode(' ', $attrs);

        return "<$this->sTagname $attrs>";
    }

    /**
     * Returns the html closing.
     *
     * @return string
     */
    public function closing()
    {
        return "</$this->sTagname>";
    }
}