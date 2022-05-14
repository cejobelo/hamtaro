<?php
namespace Hamtaro\Command;

/**
 * An argument config.
 *
 * @see \Hamtaro\Command\AbstractCommand::ArgumentConfigs()
 * 
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class ArgumentConfig
{
    /**
     * Input's name.
     *
     * @var string
     */
    private string $sName;

    /**
     * Input's type.
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
     * Argument's description.
     *
     * @var string
     */
    private string $sDescription;

    /**
     * The constructor.
     *
     * @param string $sName
     * @param string $sTypeValue
     * @param bool $bRequired
     * @param string $sDescription
     */
    public function __construct(string $sName, string $sTypeValue, bool $bRequired, string $sDescription)
    {
        $this->sName = $sName;
        $this->sTypeValue = $sTypeValue;
        $this->bRequired = $bRequired;
        $this->sDescription = $sDescription;
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

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->sDescription;
    }
}