<?php
namespace Hamtaro\Controller;

/**
 * A request param config.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class RequestParamConfig
{
    /**
     * The param's name.
     *
     * @var string
     */
    private string $sName;

    /**
     * The value's type.
     *
     * @var string
     */
    private string $sTypeValue;

    /**
     * Is required ?
     *
     * @var bool
     */
    private bool $bRequired;

    /**
     * The constructor.
     *
     * @param string $sName
     * @param string $sTypeValue
     * @param bool $bRequired
     */
    public function __construct(string $sName, string $sTypeValue, bool $bRequired)
    {
        $this->sName = $sName;
        $this->sTypeValue = $sTypeValue;
        $this->bRequired = $bRequired;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->sName;
    }

    /**
     * @return string
     */
    public function getTypeValue(): string
    {
        return $this->sTypeValue;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->bRequired;
    }
}