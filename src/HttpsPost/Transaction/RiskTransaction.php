<?php

namespace Empg\HttpsPost\Transaction;

class RiskTransaction extends AbstractTransaction
{
    public $attributeAccountInfo = null;
    public $sessionAccountInfo = null;

    public function getAttributeAccountInfo()
    {
        return $this->attributeAccountInfo;
    }

    public function setAttributeAccountInfo($attributeAccountInfo)
    {
        $this->attributeAccountInfo = $attributeAccountInfo;
    }

    public function getSessionAccountInfo()
    {
        return $this->sessionAccountInfo;
    }

    public function setSessionAccountInfo($sessionAccountInfo)
    {
        $this->sessionAccountInfo = $sessionAccountInfo;
    }
}
