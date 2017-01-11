<?php

namespace Empg\HttpsPost\Response;

class MpgResponse
{
    public $responseData;

    public $p; //parser

    public $currentTag;
    public $purchaseHash = [];
    public $refundHash;
    public $correctionHash = [];
    public $isBatchTotals;
    public $term_id;
    public $receiptHash = [];
    public $ecrHash = [];
    public $CardType;
    public $currentTxnType;
    public $ecrs = [];
    public $cards = [];
    public $cardHash = [];

    //specifically for Resolver transactions
    public $resolveData;
    public $resolveDataHash;
    public $data_key = '';
    public $DataKeys = [];
    public $isResolveData;

    //specifically for VdotMe transactions
    public $vDotMeInfo;
    public $isVdotMeInfo;

    //specifically for MasterPass transactions
    public $isPaypass;
    public $isPaypassInfo;
    public $masterPassData = [];

    //specifically for MPI transactions
    public $ACSUrl;
    public $isMPI = false;

    //specifically for Risk transactions
    public $isResults;
    public $isRule;
    public $ruleName;
    public $results = [];
    public $rules = [];

    public function __construct($xmlString)
    {
        $this->p = xml_parser_create();

        xml_parser_set_option($this->p, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($this->p, XML_OPTION_TARGET_ENCODING, 'UTF-8');
        xml_set_object($this->p, $this);
        xml_set_element_handler($this->p, 'startHandler', 'endHandler');
        xml_set_character_data_handler($this->p, 'characterHandler');
        xml_parse($this->p, $xmlString);
        xml_parser_free($this->p);
    }

    public function getMpgResponseData()
    {
        return $this->responseData;
    }

    //To prevent Undefined Index Notices
    private function getMpgResponseValue($responseData, $value)
    {
        return isset($responseData[$value]) ? $responseData[$value] : '';
    }

    public function getRecurSuccess()
    {
        return $this->getMpgResponseValue($this->responseData, 'RecurSuccess');
    }

    public function getStatusCode()
    {
        return $this->getMpgResponseValue($this->responseData, 'status_code');
    }

    public function getStatusMessage()
    {
        return $this->getMpgResponseValue($this->responseData, 'status_message');
    }

    public function getAvsResultCode()
    {
        return $this->getMpgResponseValue($this->responseData, 'AvsResultCode');
    }

    public function getCvdResultCode()
    {
        return $this->getMpgResponseValue($this->responseData, 'CvdResultCode');
    }

    public function getCardType()
    {
        return $this->getMpgResponseValue($this->responseData, 'CardType');
    }

    public function getTransAmount()
    {
        return $this->getMpgResponseValue($this->responseData, 'TransAmount');
    }

    public function getTxnNumber()
    {
        return $this->getMpgResponseValue($this->responseData, 'TransID');
    }

    public function getReceiptId()
    {
        return $this->getMpgResponseValue($this->responseData, 'ReceiptId');
    }

    public function getTransType()
    {
        return $this->getMpgResponseValue($this->responseData, 'TransType');
    }

    public function getReferenceNum()
    {
        return $this->getMpgResponseValue($this->responseData, 'ReferenceNum');
    }

    public function getResponseCode()
    {
        return $this->getMpgResponseValue($this->responseData, 'ResponseCode');
    }

    public function getISO()
    {
        return $this->getMpgResponseValue($this->responseData, 'ISO');
    }

    public function getBankTotals()
    {
        return $this->getMpgResponseValue($this->responseData, 'BankTotals');
    }

    public function getMessage()
    {
        return $this->getMpgResponseValue($this->responseData, 'Message');
    }

    public function getAuthCode()
    {
        return $this->getMpgResponseValue($this->responseData, 'AuthCode');
    }

    public function getComplete()
    {
        return $this->getMpgResponseValue($this->responseData, 'Complete');
    }

    public function getTransDate()
    {
        return $this->getMpgResponseValue($this->responseData, 'TransDate');
    }

    public function getTransTime()
    {
        return $this->getMpgResponseValue($this->responseData, 'TransTime');
    }

    public function getTicket()
    {
        return $this->getMpgResponseValue($this->responseData, 'Ticket');
    }

    public function getTimedOut()
    {
        return $this->getMpgResponseValue($this->responseData, 'TimedOut');
    }

    public function getCorporateCard()
    {
        return $this->getMpgResponseValue($this->responseData, 'CorporateCard');
    }

    public function getCavvResultCode()
    {
        return $this->getMpgResponseValue($this->responseData, 'CavvResultCode');
    }

    public function getCardLevelResult()
    {
        return $this->getMpgResponseValue($this->responseData, 'CardLevelResult');
    }

    public function getITDResponse()
    {
        return $this->getMpgResponseValue($this->responseData, 'ITDResponse');
    }

    public function getIsVisaDebit()
    {
        return $this->getMpgResponseValue($this->responseData, 'IsVisaDebit');
    }

    public function getMaskedPan()
    {
        return $this->getMpgResponseValue($this->responseData, 'MaskedPan');
    }

    public function getCfSuccess()
    {
        return $this->getMpgResponseValue($this->responseData, 'CfSuccess');
    }

    public function getCfStatus()
    {
        return $this->getMpgResponseValue($this->responseData, 'CfStatus');
    }

    public function getFeeAmount()
    {
        return $this->getMpgResponseValue($this->responseData, 'FeeAmount');
    }

    public function getFeeRate()
    {
        return $this->getMpgResponseValue($this->responseData, 'FeeRate');
    }

    public function getFeeType()
    {
        return $this->getMpgResponseValue($this->responseData, 'FeeType');
    }

    //--------------------------- RecurUpdate response fields ----------------------------//

    public function getRecurUpdateSuccess()
    {
        return $this->getMpgResponseValue($this->responseData, 'RecurUpdateSuccess');
    }

    public function getNextRecurDate()
    {
        return $this->getMpgResponseValue($this->responseData, 'NextRecurDate');
    }

    public function getRecurEndDate()
    {
        return $this->getMpgResponseValue($this->responseData, 'RecurEndDate');
    }

    //--------------------------- MCP response fields ----------------------------//

    public function getMCPAmount()
    {
        return $this->getMpgResponseValue($this->responseData, 'MCPAmount');
    }

    public function getMCPCurrencyCode()
    {
        return $this->getMpgResponseValue($this->responseData, 'MCPCurrencyCode');
    }

    //-------------------------- Resolver response fields --------------------------------//

    public function getDataKey()
    {
        return $this->getMpgResponseValue($this->responseData, 'DataKey');
    }

    public function getResSuccess()
    {
        return $this->getMpgResponseValue($this->responseData, 'ResSuccess');
    }

    public function getPaymentType()
    {
        return $this->getMpgResponseValue($this->responseData, 'PaymentType');
    }

    //------------------------------------------------------------------------------------//

    public function getResolveData()
    {
        if ($this->responseData['ResolveData'] != 'null') {
            return $this->resolveData;
        }

        return $this->getMpgResponseValue($this->responseData, 'ResolveData');
    }

    public function setResolveData($data_key)
    {
        $this->resolveData = $this->resolveDataHash[$data_key];
    }

    public function getResolveDataHash()
    {
        return $this->resolveDataHash;
    }

    public function getDataKeys()
    {
        return $this->DataKeys;
    }

    public function getResDataDataKey()
    {
        return $this->getMpgResponseValue($this->resolveData, 'data_key');
    }

    public function getResDataPaymentType()
    {
        return $this->getMpgResponseValue($this->resolveData, 'payment_type');
    }

    public function getResDataCustId()
    {
        return $this->getMpgResponseValue($this->resolveData, 'cust_id');
    }

    public function getResDataPhone()
    {
        return $this->getMpgResponseValue($this->resolveData, 'phone');
    }

    public function getResDataEmail()
    {
        return $this->getMpgResponseValue($this->resolveData, 'email');
    }

    public function getResDataNote()
    {
        return $this->getMpgResponseValue($this->resolveData, 'note');
    }

    public function getResDataPan()
    {
        return $this->getMpgResponseValue($this->resolveData, 'pan');
    }

    public function getResDataMaskedPan()
    {
        return $this->getMpgResponseValue($this->resolveData, 'masked_pan');
    }

    public function getResDataExpDate()
    {
        return $this->getMpgResponseValue($this->resolveData, 'expdate');
    }

    public function getResDataAvsStreetNumber()
    {
        return $this->getMpgResponseValue($this->resolveData, 'avs_street_number');
    }

    public function getResDataAvsStreetName()
    {
        return $this->getMpgResponseValue($this->resolveData, 'avs_street_name');
    }

    public function getResDataAvsZipcode()
    {
        return $this->getMpgResponseValue($this->resolveData, 'avs_zipcode');
    }

    public function getResDataCryptType()
    {
        return $this->getMpgResponseValue($this->resolveData, 'crypt_type');
    }

    public function getResDataSec()
    {
        return $this->getMpgResponseValue($this->resolveData, 'sec');
    }

    public function getResDataCustFirstName()
    {
        return $this->getMpgResponseValue($this->resolveData, 'cust_first_name');
    }

    public function getResDataCustLastName()
    {
        return $this->getMpgResponseValue($this->resolveData, 'cust_last_name');
    }

    public function getResDataCustAddress1()
    {
        return $this->getMpgResponseValue($this->resolveData, 'cust_address1');
    }

    public function getResDataCustAddress2()
    {
        return $this->getMpgResponseValue($this->resolveData, 'cust_address2');
    }

    public function getResDataCustCity()
    {
        return $this->getMpgResponseValue($this->resolveData, 'cust_city');
    }

    public function getResDataCustState()
    {
        return $this->getMpgResponseValue($this->resolveData, 'cust_state');
    }

    public function getResDataCustZip()
    {
        return $this->getMpgResponseValue($this->resolveData, 'cust_zip');
    }

    public function getResDataRoutingNum()
    {
        return $this->getMpgResponseValue($this->resolveData, 'routing_num');
    }

    public function getResDataAccountNum()
    {
        return $this->getMpgResponseValue($this->resolveData, 'account_num');
    }

    public function getResDataMaskedAccountNum()
    {
        return $this->getMpgResponseValue($this->resolveData, 'masked_account_num');
    }

    public function getResDataCheckNum()
    {
        return $this->getMpgResponseValue($this->resolveData, 'check_num');
    }

    public function getResDataAccountType()
    {
        return $this->getMpgResponseValue($this->resolveData, 'account_type');
    }

    public function getResDataPresentationType()
    {
        return $this->getMpgResponseValue($this->resolveData, 'presentation_type');
    }

    public function getResDataPAccountNumber()
    {
        return $this->getMpgResponseValue($this->resolveData, 'p_account_number');
    }

    //-------------------------- VdotMe specific fields --------------------------------//
    public function getVDotMeData()
    {
        return $this->vDotMeInfo;
    }

    public function getCurrencyCode()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'currencyCode');
    }

    public function getPaymentTotal()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'total');
    }

    public function getUserFirstName()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'userFirstName');
    }

    public function getUserLastName()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'userLastName');
    }

    public function getUserName()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'userName');
    }

    public function getUserEmail()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'userEmail');
    }

    public function getEncUserId()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'encUserId');
    }

    public function getCreationTimeStamp()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'creationTimeStamp');
    }

    public function getNameOnCard()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'nameOnCard');
    }

    public function getExpirationDateMonth()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['expirationDate'], 'month');
    }

    public function getExpirationDateYear()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['expirationDate'], 'year');
    }

    public function getBillingId()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'id');
    }

    public function getLastFourDigits()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'lastFourDigits');
    }

    public function getBinSixDigits()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'binSixDigits');
    }

    public function getCardBrand()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'cardBrand');
    }

    public function getVDotMeCardType()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'cardType');
    }

    public function getBillingPersonName()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['billingAddress'], 'personName');
    }

    public function getBillingAddressLine1()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['billingAddress'], 'line1');
    }

    public function getBillingCity()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['billingAddress'], 'city');
    }

    public function getBillingStateProvinceCode()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['billingAddress'], 'stateProvinceCode');
    }

    public function getBillingPostalCode()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['billingAddress'], 'postalCode');
    }

    public function getBillingCountryCode()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['billingAddress'], 'countryCode');
    }

    public function getBillingPhone()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['billingAddress'], 'phone');
    }

    public function getBillingVerificationStatus()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'verificationStatus');
    }

    public function getIsExpired()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'expired');
    }

    public function getPartialShippingCountryCode()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['partialShippingAddress'], 'countryCode');
    }

    public function getPartialShippingPostalCode()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['partialShippingAddress'], 'postalCode');
    }

    public function getShippingPersonName()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['shippingAddress'], 'personName');
    }

    public function getShippingCity()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['shippingAddress'], 'city');
    }

    public function getShippingStateProvinceCode()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['shippingAddress'], 'stateProvinceCode');
    }

    public function getShippingPostalCode()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['shippingAddress'], 'postalCode');
    }

    public function getShippingCountryCode()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['shippingAddress'], 'countryCode');
    }

    public function getShippingPhone()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['shippingAddress'], 'phone');
    }

    public function getShippingDefault()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['shippingAddress'], 'default');
    }

    public function getShippingId()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['shippingAddress'], 'id');
    }

    public function getShippingVerificationStatus()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['shippingAddress'], 'verificationStatus');
    }

    public function getBaseImageFileName()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'baseImageFileName');
    }

    public function getHeight()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'height');
    }

    public function getWidth()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'width');
    }

    public function getIssuerBid()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo, 'issuerBid');
    }

    public function getRiskAdvice()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['riskData'], 'advice');
    }

    public function getRiskScore()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['riskData'], 'score');
    }

    public function getAvsResponseCode()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['riskData'], 'avsResponseCode');
    }

    public function getCvvResponseCode()
    {
        return $this->getMpgResponseValue($this->vDotMeInfo['riskData'], 'cvvResponseCode');
    }

    //--------------------------- MasterPass response fields -----------------------------//

    public function getCardBrandId()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'CardBrandId');
    }

    public function getCardBrandName()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'CardBrandName');
    }

    public function getCardBillingAddressCity()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'CardBillingAddressCity');
    }

    public function getCardBillingAddressCountry()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'CardBillingAddressCountry');
    }

    public function getCardBillingAddressCountrySubdivision()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'CardBillingAddressCountrySubdivision');
    }

    public function getCardBillingAddressLine1()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'CardBillingAddressLine1');
    }

    public function getCardBillingAddressLine2()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'CardBillingAddressLine2');
    }

    public function getCardBillingAddressPostalCode()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'CardBillingAddressPostalCode');
    }

    public function getCardBillingAddressRecipientPhoneNumber()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'CardBillingAddressRecipientPhoneNumber');
    }

    public function getCardBillingAddressRecipientName()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'CardBillingAddressRecipientName');
    }

    public function getCardCardHolderName()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'CardCardHolderName');
    }

    public function getCardExpiryMonth()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'CardExpiryMonth');
    }

    public function getCardExpiryYear()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'CardExpiryYear');
    }

    public function getContactEmailAddress()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'ContactEmailAddress');
    }

    public function getContactFirstName()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'ContactFirstName');
    }

    public function getContactLastName()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'ContactLastName');
    }

    public function getContactPhoneNumber()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'ContactPhoneNumber');
    }

    public function getShippingAddressCity()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'ShippingAddressCity');
    }

    public function getShippingAddressCountry()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'ShippingAddressCountry');
    }

    public function getShippingAddressCountrySubdivision()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'ShippingAddressCountrySubdivision');
    }

    public function getShippingAddressLine2()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'ShippingAddressLine2');
    }

    public function getShippingAddressPostalCode()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'ShippingAddressPostalCode');
    }

    public function getShippingAddressRecipientName()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'ShippingAddressRecipientName');
    }

    public function getShippingAddressRecipientPhoneNumber()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'ShippingAddressRecipientPhoneNumber');
    }

    public function getPayPassWalletIndicator()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'PayPassWalletIndicator');
    }

    public function getAuthenticationOptionsAuthenticateMethod()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'AuthenticationOptionsAuthenticateMethod');
    }

    public function getAuthenticationOptionsCardEnrollmentMethod()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'AuthenticationOptionsCardEnrollmentMethod');
    }

    public function getCardAccountNumber()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'CardAccountNumber');
    }

    public function getAuthenticationOptionsEciFlag()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'AuthenticationOptionsEciFlag');
    }

    public function getAuthenticationOptionsPaResStatus()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'AuthenticationOptionsPaResStatus');
    }

    public function getAuthenticationOptionsSCEnrollmentStatus()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'AuthenticationOptionsSCEnrollmentStatus');
    }

    public function getAuthenticationOptionsSignatureVerification()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'AuthenticationOptionsSignatureVerification');
    }

    public function getAuthenticationOptionsXid()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'AuthenticationOptionsXid');
    }

    public function getAuthenticationOptionsCAvv()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'AuthenticationOptionsCAvv');
    }

    public function getTransactionId()
    {
        return $this->getMpgResponseValue($this->masterPassData, 'TransactionId');
    }

    public function getMPRequestToken()
    {
        return $this->getMpgResponseValue($this->responseData, 'MPRequestToken');
    }

    public function getMPRedirectUrl()
    {
        return $this->getMpgResponseValue($this->responseData, 'MPRedirectUrl');
    }

    //------------------- VDotMe & MasterPass shared response fields ---------------------//

    public function getShippingAddressLine1()
    {
        if ($this->isPaypass) {
            return $this->getMpgResponseValue($this->masterPassData, 'ShippingAddressLine1');
        } else {
            return $this->getMpgResponseValue($this->vDotMeInfo['shippingAddress'], 'line1');
        }
    }
//------------------- MPI response fields ---------------------//
    public function getMpiType()
    {
        return $this->getMpgResponseValue($this->responseData, 'MpiType');
    }

    public function getMpiSuccess()
    {
        if ($this->isMPI === false) {
            return $this->getMpgResponseValue($this->responseData, 'MpiSuccess');
        } else {
            return $this->getMpgResponseValue($this->responseData, 'success');
        }
    }

    public function getMpiMessage()
    {
        if ($this->isMPI === false) {
            return $this->getMpgResponseValue($this->responseData, 'MpiMessage');
        } else {
            return $this->getMpgResponseValue($this->responseData, 'message');
        }
    }

    public function getMpiPaReq()
    {
        if ($this->isMPI === false) {
            return $this->getMpgResponseValue($this->responseData, 'MpiPaReq');
        } else {
            return $this->getMpgResponseValue($this->responseData, 'PaReq');
        }
    }

    public function getMpiTermUrl()
    {
        if ($this->isMPI === false) {
            return $this->getMpgResponseValue($this->responseData, 'MpiTermUrl');
        } else {
            return $this->getMpgResponseValue($this->responseData, 'TermUrl');
        }
    }

    public function getMpiMD()
    {
        if ($this->isMPI === false) {
            return $this->getMpgResponseValue($this->responseData, 'MpiMD');
        } else {
            return $this->getMpgResponseValue($this->responseData, 'MD');
        }
    }

    public function getMpiACSUrl()
    {
        if ($this->isMPI === false) {
            return $this->getMpgResponseValue($this->responseData, 'MpiACSUrl');
        } else {
            return $this->getMpgResponseValue($this->responseData, 'ACSUrl');
        }
    }

    public function getMpiCavv()
    {
        if ($this->isMPI === false) {
            return $this->getMpgResponseValue($this->responseData, 'MpiCavv');
        } else {
            return $this->getMpgResponseValue($this->responseData, 'cavv');
        }
    }

    public function getMpiEci()
    {
        if ($this->isMPI === false) {
            return $this->getMpgResponseValue($this->responseData, 'MpiEci');
        } else {
            return $this->getMpgResponseValue($this->responseData, 'eci');
        }
    }

    public function getMpiPAResVerified()
    {
        if ($this->isMPI === false) {
            return $this->getMpgResponseValue($this->responseData, 'MpiPAResVerified');
        } else {
            return $this->getMpgResponseValue($this->responseData, 'PAResVerified');
        }
    }

    public function getMpiResponseData()
    {
        return $this->responseData;
    }

    public function getMpiInLineForm()
    {
        $inLineForm = '<html><head><title>Title for Page</title></head><SCRIPT LANGUAGE="Javascript" >'.
                '<!--
                function OnLoadEvent()
                {
                    document.downloadForm.submit();
                }
                -->
                </SCRIPT>'.
                '<body onload="OnLoadEvent()">
                    <form name="downloadForm" action="'.$this->getMpiACSUrl().
                    '" method="POST">
                    <noscript>
                    <br>
                    <br>
                    <center>
                    <h1>Processing your 3-D Secure Transaction</h1>
                    <h2>
                    JavaScript is currently disabled or is not supported
                    by your browser.<br>
                    <h3>Please click on the Submit button to continue
                    the processing of your 3-D secure
                    transaction.</h3>
                    <input type="submit" value="Submit">
                    </center>
                    </noscript>
                    <input type="hidden" name="PaReq" value="'.$this->getMpiPaReq().'">
                    <input type="hidden" name="MD" value="'.$this->getMpiMD().'">
                    <input type="hidden" name="TermUrl" value="'.$this->getMpiTermUrl().'">
                </form>
                </body>
                </html>';

        return $inLineForm;
    }

    public function getMpiPopUpWindow()
    {
        $popUpForm = '<html><head><title>Title for Page</title></head><SCRIPT LANGUAGE="Javascript" >'.
                "<!--
                    function OnLoadEvent()
                    {
                        window.name='mainwindow';
                        //childwin = window.open('about:blank','popupName','height=400,width=390,status=yes,dependent=no,scrollbars=yes,resizable=no');
                        //document.downloadForm.target = 'popupName';
                        document.downloadForm.submit();
                    }
                    -->
                    </SCRIPT>".
                        '<body onload="OnLoadEvent()">
                        <form name="downloadForm" action="'.$this->getMpiAcsUrl().
                            '" method="POST">
                        <noscript>
                        <br>
                        <br>
                        <center>
                        <h1>Processing your 3-D Secure Transaction</h1>
                        <h2>
                        JavaScript is currently disabled or is not supported
                        by your browser.<br>
                        <h3>Please click on the Submit button to continue
                        the processing of your 3-D secure
                        transaction.</h3>
                        <input type="submit" value="Submit">
                        </center>
                        </noscript>
                        <input type="hidden" name="PaReq" value="'.$this->getMpiPaReq().'">
                        <input type="hidden" name="MD" value="'.$this->getMpiMD().'">
                        <input type="hidden" name="TermUrl" value="'.$this->getMpiTermUrl().'">
                        </form>
                    </body>
                    </html>';

        return $popUpForm;
    }

    //-----------------  Risk response fields  ---------------------------------------------------------//

    public function getRiskResponse()
    {
        return $this->responseData;
    }

    public function getResults()
    {
        return $this->results;
    }

    public function getRules()
    {
        return $this->rules;
    }

    //--------------------------- BatchClose response fields -----------------------------//

    public function getTerminalStatus($ecr_no)
    {
        return $this->getMpgResponseValue($this->ecrHash, $ecr_no);
    }

    public function getPurchaseAmount($ecr_no, $card_type)
    {
        return $this->purchaseHash[$ecr_no][$card_type]['Amount'] == '' ? 0 : $this->purchaseHash[$ecr_no][$card_type]['Amount'];
    }

    public function getPurchaseCount($ecr_no, $card_type)
    {
        return $this->purchaseHash[$ecr_no][$card_type]['Count'] == '' ? 0 : $this->purchaseHash[$ecr_no][$card_type]['Count'];
    }

    public function getRefundAmount($ecr_no, $card_type)
    {
        return $this->refundHash[$ecr_no][$card_type]['Amount'] == '' ? 0 : $this->refundHash[$ecr_no][$card_type]['Amount'];
    }

    public function getRefundCount($ecr_no, $card_type)
    {
        return $this->refundHash[$ecr_no][$card_type]['Count'] == '' ? 0 : $this->refundHash[$ecr_no][$card_type]['Count'];
    }

    public function getCorrectionAmount($ecr_no, $card_type)
    {
        return $this->correctionHash[$ecr_no][$card_type]['Amount'] == '' ? 0 : $this->correctionHash[$ecr_no][$card_type]['Amount'];
    }

    public function getCorrectionCount($ecr_no, $card_type)
    {
        return $this->correctionHash[$ecr_no][$card_type]['Count'] == '' ? 0 : $this->correctionHash[$ecr_no][$card_type]['Count'];
    }

    public function getTerminalIDs()
    {
        return $this->ecrs;
    }

    public function getCreditCardsAll()
    {
        return array_keys($this->cards);
    }

    public function getCreditCards($ecr)
    {
        return $this->getMpgResponseValue($this->cardHash, $ecr);
    }

    public function characterHandler($parser, $data)
    {
        if ($this->isBatchTotals) {
            switch ($this->currentTag) {
                case 'term_id':
                    $this->term_id = $data;
                    array_push($this->ecrs, $this->term_id);
                    $this->cardHash[$data] = [];
                    break;
                case 'closed':
                    $ecrHash = $this->ecrHash;
                    $ecrHash[$this->term_id] = $data;
                    $this->ecrHash = $ecrHash;
                    break;
                case 'CardType':
                    $this->CardType = $data;
                    $this->cards[$data] = $data;
                    array_push($this->cardHash[$this->term_id], $data);
                    break;
                case 'Amount':
                    if ($this->currentTxnType == 'Purchase') {
                        $this->purchaseHash[$this->term_id][$this->CardType]['Amount'] = $data;
                    } elseif ($this->currentTxnType == 'Refund') {
                        $this->refundHash[$this->term_id][$this->CardType]['Amount'] = $data;
                    } elseif ($this->currentTxnType == 'Correction') {
                        $this->correctionHash[$this->term_id][$this->CardType]['Amount'] = $data;
                    }
                    break;
                case 'Count':
                    if ($this->currentTxnType == 'Purchase') {
                        $this->purchaseHash[$this->term_id][$this->CardType]['Count'] = $data;
                    } elseif ($this->currentTxnType == 'Refund') {
                        $this->refundHash[$this->term_id][$this->CardType]['Count'] = $data;
                    } elseif ($this->currentTxnType == 'Correction') {
                        $this->correctionHash[$this->term_id][$this->CardType]['Count'] = $data;
                    }
                    break;
            }
        } elseif ($this->isResolveData && $this->currentTag != 'ResolveData') {
            if ($this->currentTag == 'data_key') {
                $this->data_key = $data;
                array_push($this->DataKeys, $this->data_key);
                $this->resolveData[$this->currentTag] = $data;
            } else {
                $this->resolveData[$this->currentTag] = $data;
            }
        } elseif ($this->isVdotMeInfo) {
            if ($this->ParentNode != '') {
                $this->vDotMeInfo[$this->ParentNode][$this->currentTag] = $data;
            } else {
                $this->vDotMeInfo[$this->currentTag] = $data;
            }
        } elseif ($this->isPaypassInfo) {
            $this->masterPassData[$this->currentTag] = $data;
        } elseif ($this->isResults) {
            $this->results[$this->currentTag] = $data;
        } elseif ($this->isRule) {
            if ($this->currentTag == 'RuleName') {
                $this->ruleName = $data;
            }
            $this->rules[$this->ruleName][$this->currentTag] = $data;
        } elseif ($this->currentTag == 'MpiACSUrl') {
            if (!isset($this->responseData[$this->currentTag])) {
                $this->responseData[$this->currentTag] = '';
            }

            $this->responseData[$this->currentTag] .= $data;
        } else {
            $this->responseData[$this->currentTag] = $data;
        }
    }//end characterHandler

    public function startHandler($parser, $name, $attrs)
    {
        $this->currentTag = $name;

        if ($this->currentTag == 'ResolveData') {
            $this->isResolveData = 1;
        } elseif ($this->isResolveData) {
            $this->resolveData[$this->currentTag] = '';
        } elseif ($this->currentTag == 'MpiResponse') {
            $this->isMPI = true;
        } elseif ($this->currentTag == 'VDotMeInfo') {
            $this->isVdotMeInfo = 1;
        } elseif ($this->isVdotMeInfo) {
            switch ($name) {
                case 'billingAddress':
                    $this->ParentNode = $name;
                    break;
                case 'partialShippingAddress':
                    $this->ParentNode = $name;
                    break;
                case 'shippingAddress':
                    $this->ParentNode = $name;
                    break;
                case 'riskData':
                    $this->ParentNode = $name;
                    break;
                case 'expirationDate':
                    $this->ParentNode = $name;
                    break;
            }
        } elseif ($this->currentTag == 'PayPassInfo') {
            $this->isPaypassInfo = 1;
            $this->isPaypass = 1;
        } elseif ($this->currentTag == 'BankTotals') {
            $this->isBatchTotals = 1;
        } elseif ($this->currentTag == 'Purchase') {
            $this->purchaseHash[$this->term_id][$this->CardType] = [];
            $this->currentTxnType = 'Purchase';
        } elseif ($this->currentTag == 'Refund') {
            $this->refundHash[$this->term_id][$this->CardType] = [];
            $this->currentTxnType = 'Refund';
        } elseif ($this->currentTag == 'Correction') {
            $this->correctionHash[$this->term_id][$this->CardType] = [];
            $this->currentTxnType = 'Correction';
        } elseif ($this->currentTag == 'Result') {
            $this->isResults = 1;
        } elseif ($this->currentTag == 'Rule') {
            $this->isRule = 1;
        }
    }

    public function endHandler($parser, $name)
    {
        $this->currentTag = $name;
        if ($this->currentTag == 'ResolveData') {
            $this->isResolveData = 0;
            if ($this->data_key != '') {
                $this->resolveDataHash[$this->data_key] = $this->resolveData;
                $this->resolveData = [];
            }
        } elseif ($this->currentTag == 'VDotMeInfo') {
            $this->isVdotMeInfo = 0;
        } elseif ($this->isVdotMeInfo) {
            switch ($this->currentTag) {
                case 'billingAddress':
                    $this->ParentNode = '';
                    break;
                case 'partialShippingAddress':
                    $this->ParentNode = '';
                    break;
                case 'shippingAddress':
                    $this->ParentNode = '';
                    break;
                case 'riskData':
                    $this->ParentNode = '';
                    break;
                case 'expirationDate':
                    $this->ParentNode = '';
                    break;
            }
        } elseif ($name == 'BankTotals') {
            $this->isBatchTotals = 0;
        } elseif ($this->currentTag == 'PayPassInfo') {
            $this->isPaypassInfo = 0;
        } elseif ($name == 'Result') {
            $this->isResults = 0;
        } elseif ($this->currentTag == 'Rule') {
            $this->isRule = 0;
        }

        $this->currentTag = '/dev/null';
    }
}
