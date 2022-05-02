<?php

namespace Hamtaro\Module;

/**
 * A response.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
class Response extends AbstractModule
{
    /**
     * Success ?
     *
     * @var bool $bSuccess
     */
    private bool $bSuccess = false;

    /**
     * Message.
     *
     * @var string $sMessage
     */
    private string $sMessage = '';

    /**
     * Extra params.
     *
     * @var array $aExtraParams
     */
    private array $aExtraParams = [];

    /**
     * @return bool
     */
    public function sendAjax()
    {
        echo $this->getJson();
        return true;
    }

    /**
     * @return false|string
     */
    public function getJson()
    {
        return json_encode(array_merge([
            'success' => $this->isSuccess(),
            'message' => $this->getMessage(),
        ], $this->aExtraParams));
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->bSuccess;
    }

    /**
     * @param string $sMessage
     * @return $this
     */
    public function setMessage(string $sMessage)
    {
        $this->sMessage = $sMessage;
        return $this;
    }

    /**
     * @param bool $bSuccess
     * @return $this
     */
    public function setSuccess(bool $bSuccess)
    {
        $this->bSuccess = $bSuccess;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->sMessage;
    }

    /**
     * @param string $sKey
     * @param mixed $mValue
     * @return $this
     */
    public function setExtraParam(string $sKey, $mValue)
    {
        if ($mValue !== NULL)
        {
            $this->aExtraParams[$sKey] = $mValue;
        }
        return $this;
    }

    /**
     * @param string $sKey
     * @param mixed $mDefaultValue
     * @return mixed
     */
    public function getExtraParam(string $sKey, $mDefaultValue = NULL)
    {
        return $this->aExtraParams[$sKey] ?? $mDefaultValue;
    }

    /**
     * @param array $aExtraParams
     * @return $this
     */
    public function addExtraParams(array $aExtraParams)
    {
        $this->aExtraParams = array_merge($this->aExtraParams, $aExtraParams);
        return $this;
    }

    /**
     * @return array
     */
    public function getExtraParams(): array
    {
        return $this->aExtraParams;
    }

    /**
     * @param string $sMsg
     * @return $this
     */
    public function getSuccess(string $sMsg)
    {
        return $this->setSuccess(true)->setMessage($sMsg);
    }

    /**
     * @param string $sMsg
     * @return $this
     */
    public function getFailure(string $sMsg)
    {
        return $this->setSuccess(false)->setMessage($sMsg);
    }
}