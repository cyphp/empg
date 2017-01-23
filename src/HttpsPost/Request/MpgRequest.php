<?php

namespace Empg\HttpsPost\Request;

use Sabre\Xml\XmlSerializable;
use Sabre\Xml\Writer;
use Empg\Mpg\Globals;
use Empg\HttpsPost\Transaction\MpgTransaction;

class MpgRequest extends AbstractRequest implements XmlSerializable
{
    protected $txnTypes = [
        //Basic
        'batchclose' => ['ecr_number'],
        'card_verification' => ['order_id', 'cust_id', 'pan', 'expdate', 'crypt_type'],
        'cavv_preauth' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'cavv', 'crypt_type', 'dynamic_descriptor', 'wallet_indicator'],
        'cavv_purchase' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'cavv', 'crypt_type', 'dynamic_descriptor', 'wallet_indicator'],
        'completion' => ['order_id', 'comp_amount', 'txn_number', 'crypt_type', 'cust_id', 'dynamic_descriptor', 'mcp_amount', 'mcp_currency_code'],
        'contactless_purchase' => ['order_id', 'cust_id', 'amount', 'track2', 'pan', 'expdate', 'pos_code', 'dynamic_descriptor'],
        'contactless_purchasecorrection' => ['order_id', 'txn_number'],
        'contactless_refund' => ['order_id', 'amount', 'txn_number'],
        'forcepost' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'auth_code', 'crypt_type', 'dynamic_descriptor'],
        'ind_refund' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'crypt_type', 'dynamic_descriptor', 'mcp_amount', 'mcp_currency_code'],
        'opentotals' => ['ecr_number'],
        'preauth' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'crypt_type', 'dynamic_descriptor', 'wallet_indicator', 'mcp_amount', 'mcp_currency_code'],
        'purchase' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'crypt_type', 'dynamic_descriptor', 'wallet_indicator', 'mcp_amount', 'mcp_currency_code'],
        'purchasecorrection' => ['order_id', 'txn_number', 'crypt_type', 'cust_id', 'dynamic_descriptor', 'mcp_currency_code'],
        'reauth' => ['order_id', 'cust_id', 'amount', 'orig_order_id', 'txn_number', 'crypt_type', 'dynamic_descriptor'],
        'recur_update' => ['order_id', 'cust_id', 'pan', 'expdate', 'recur_amount', 'add_num_recurs', 'total_num_recurs', 'hold', 'terminate'],
        'refund' => ['order_id', 'amount', 'txn_number', 'crypt_type', 'cust_id', 'dynamic_descriptor', 'mcp_amount', 'mcp_currency_code'],

        //Encrypted
        'enc_card_verification' => ['order_id', 'cust_id', 'enc_track2', 'device_type', 'crypt_type'],
        'enc_forcepost' => ['order_id', 'cust_id', 'amount', 'enc_track2', 'device_type', 'auth_code', 'crypt_type', 'dynamic_descriptor'],
        'enc_ind_refund' => ['order_id', 'cust_id', 'amount', 'enc_track2', 'device_type', 'crypt_type', 'dynamic_descriptor'],
        'enc_preauth' => ['order_id', 'cust_id', 'amount', 'enc_track2', 'device_type', 'crypt_type', 'dynamic_descriptor'],
        'enc_purchase' => ['order_id', 'cust_id', 'amount', 'enc_track2', 'device_type', 'crypt_type', 'dynamic_descriptor'],
        'enc_res_add_cc' => ['cust_id', 'phone', 'email', 'note', 'enc_track2', 'device_type', 'crypt_type'],
        'enc_res_update_cc' => ['data_key', 'cust_id', 'phone', 'email', 'note', 'enc_track2', 'device_type', 'crypt_type'],
        'enc_track2_forcepost' => ['order_id', 'cust_id', 'amount', 'enc_track2', 'pos_code', 'device_type', 'auth_code', 'dynamic_descriptor'],
        'enc_track2_ind_refund' => ['order_id', 'cust_id', 'amount', 'enc_track2', 'pos_code', 'device_type', 'dynamic_descriptor'],
        'enc_track2_preauth' => ['order_id', 'cust_id', 'amount', 'enc_track2', 'pos_code', 'device_type', 'dynamic_descriptor'],
        'enc_track2_purchase' => ['order_id', 'cust_id', 'amount', 'enc_track2', 'pos_code', 'device_type', 'dynamic_descriptor'],

        //Interac Online
        'idebit_purchase' => ['order_id', 'cust_id', 'amount', 'idebit_track2', 'dynamic_descriptor'],
        'idebit_refund' => ['order_id', 'amount', 'txn_number'],

        //Vault
        'res_add_cc' => ['cust_id', 'phone', 'email', 'note', 'pan', 'expdate', 'crypt_type'],
        'res_add_token' => ['data_key', 'cust_id', 'phone', 'email', 'note', 'expdate', 'crypt_type'],
        'res_card_verification_cc' => ['data_key', 'order_id', 'crypt_type', 'expdate'],
        'res_cavv_preauth_cc' => ['data_key', 'order_id', 'cust_id', 'amount', 'cavv', 'crypt_type', 'dynamic_descriptor', 'expdate'],
        'res_cavv_purchase_cc' => ['data_key', 'order_id', 'cust_id', 'amount', 'cavv', 'crypt_type', 'dynamic_descriptor', 'expdate'],
        'res_delete' => ['data_key'],
        'res_get_expiring' => [],
        'res_ind_refund_cc' => ['data_key', 'order_id', 'cust_id', 'amount', 'crypt_type', 'dynamic_descriptor'],
        'res_iscorporatecard' => ['data_key'],
        'res_lookup_full' => ['data_key'],
        'res_lookup_masked' => ['data_key'],
        'res_mpitxn' => ['data_key', 'xid', 'amount', 'MD', 'merchantUrl', 'accept', 'userAgent', 'expdate'],
        'res_preauth_cc' => ['data_key', 'order_id', 'cust_id', 'amount', 'crypt_type', 'dynamic_descriptor', 'expdate'],
        'res_purchase_cc' => ['data_key', 'order_id', 'cust_id', 'amount', 'crypt_type', 'dynamic_descriptor', 'expdate'],
        'res_temp_add' => ['pan', 'expdate', 'crypt_type', 'duration'],
        'res_temp_tokenize' => ['order_id', 'txn_number', 'duration', 'crypt_type'],
        'res_tokenize_cc' => ['order_id', 'txn_number', 'cust_id', 'phone', 'email', 'note'],
        'res_update_cc' => ['data_key', 'cust_id', 'phone', 'email', 'note', 'pan', 'expdate', 'crypt_type'],

        //Track2
        'track2_completion' => ['order_id', 'comp_amount', 'txn_number', 'pos_code', 'dynamic_descriptor'],
        'track2_forcepost' => ['order_id', 'cust_id', 'amount', 'track2', 'pan', 'expdate', 'pos_code', 'auth_code', 'dynamic_descriptor'],
        'track2_ind_refund' => ['order_id', 'amount', 'track2', 'pan', 'expdate', 'cust_id', 'pos_code', 'dynamic_descriptor'],
        'track2_preauth' => ['order_id', 'cust_id', 'amount', 'track2', 'pan', 'expdate', 'pos_code', 'dynamic_descriptor'],
        'track2_purchase' => ['order_id', 'cust_id', 'amount', 'track2', 'pan', 'expdate', 'pos_code', 'dynamic_descriptor'],
        'track2_purchasecorrection' => ['order_id', 'txn_number'],
        'track2_refund' => ['order_id', 'amount', 'txn_number', 'dynamic_descriptor'],

        //VDotMe
        'vdotme_completion' => ['order_id', 'comp_amount', 'txn_number', 'crypt_type', 'cust_id', 'dynamic_descriptor'],
        'vdotme_getpaymentinfo' => ['callid'],
        'vdotme_preauth' => ['order_id', 'amount', 'callid', 'crypt_type', 'cust_id', 'dynamic_descriptor'],
        'vdotme_purchase' => ['order_id', 'amount', 'callid', 'crypt_type', 'cust_id', 'dynamic_descriptor'],
        'vdotme_purchasecorrection' => ['order_id', 'txn_number', 'crypt_type', 'cust_id', 'dynamic_descriptor'],
        'vdotme_reauth' => ['order_id', 'orig_order_id', 'txn_number', 'amount', 'crypt_type', 'cust_id', 'dynamic_descriptor'],
        'vdotme_refund' => ['order_id', 'txn_number', 'amount', 'crypt_type', 'cust_id', 'dynamic_descriptor'],

        //MasterPass
        'paypass_send_shopping_cart' => ['subtotal', 'suppress_shipping_address'],
        'paypass_retrieve_checkout_data' => ['oauth_token', 'oauth_verifier', 'checkout_resource_url'],
        'paypass_purchase' => ['order_id', 'cust_id', 'amount', 'mp_request_token', 'crypt_type', 'dynamic_descriptor'],
        'paypass_cavv_purchase' => ['order_id', 'cavv', 'cust_id', 'amount', 'mp_request_token', 'crypt_type', 'dynamic_descriptor'],
        'paypass_preauth' => ['order_id', 'cust_id', 'amount', 'mp_request_token', 'crypt_type', 'dynamic_descriptor'],
        'paypass_cavv_preauth' => ['order_id', 'cavv', 'cust_id', 'amount', 'mp_request_token', 'crypt_type', 'dynamic_descriptor'],
        'paypass_txn' => ['xid', 'amount', 'mp_request_token', 'MD', 'merchantUrl', 'accept', 'userAgent'],

        //US ACH
        'us_ach_credit' => ['order_id', 'cust_id', 'amount'],
        'us_ach_debit' => ['order_id', 'cust_id', 'amount'],
        'us_ach_fi_enquiry' => ['routing_num'],
        'us_ach_reversal' => ['order_id', 'txn_number'],

        //US Basic
        'us_batchclose' => ['ecr_number'],
        'us_card_verification' => ['order_id', 'cust_id', 'pan', 'expdate'],
        'us_cavv_preauth' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'cavv', 'crypt_type', 'dynamic_descriptor', 'wallet_indicator'],
        'us_cavv_purchase' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'cavv', 'commcard_invoice', 'commcard_tax_amount', 'crypt_type', 'dynamic_descriptor', 'wallet_indicator'],
        'us_completion' => ['order_id', 'comp_amount', 'txn_number', 'crypt_type', 'commcard_invoice', 'commcard_tax_amount'],
        'us_contactless_purchase' => ['order_id', 'cust_id', 'amount', 'track2', 'pan', 'expdate', 'commcard_invoice', 'commcard_tax_amount', 'pos_code', 'dynamic_descriptor'],
        'us_contactless_purchasecorrection' => ['order_id', 'txn_number'],
        'us_contactless_refund' => ['order_id', 'amount', 'txn_number'],
        'us_forcepost' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'auth_code', 'crypt_type', 'dynamic_descriptor'],
        'us_ind_refund' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'crypt_type', 'dynamic_descriptor'],
        'us_opentotals' => ['ecr_number'],
        'us_pinless_debit_purchase' => ['order_id', 'amount', 'pan', 'expdate', 'cust_id', 'presentation_type', 'intended_use', 'p_account_number'],
        'us_pinless_debit_refund' => ['order_id', 'amount', 'txn_number'],
        'us_preauth' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'crypt_type', 'dynamic_descriptor'],
        'us_purchase' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'crypt_type', 'commcard_invoice', 'commcard_tax_amount', 'dynamic_descriptor'],
        'us_purchasecorrection' => ['order_id', 'txn_number', 'crypt_type'],
        'us_reauth' => ['order_id', 'cust_id', 'orig_order_id', 'txn_number', 'amount', 'crypt_type'],
        'us_recur_update' => ['order_id', 'cust_id', 'pan', 'expdate', 'recur_amount', 'add_num_recurs', 'total_num_recurs', 'hold', 'terminate', 'avs_street_number', 'avs_street_name', 'avs_zipcode'],
        'us_refund' => ['order_id', 'amount', 'txn_number', 'crypt_type'],

        //US Encrypted
        'us_enc_card_verification' => ['order_id', 'cust_id', 'enc_track2', 'device_type'],
        'us_enc_forcepost' => ['order_id', 'cust_id', 'amount', 'enc_track2', 'device_type', 'auth_code', 'crypt_type', 'dynamic_descriptor'],
        'us_enc_ind_refund' => ['order_id', 'cust_id', 'amount', 'enc_track2', 'device_type', 'crypt_type', 'dynamic_descriptor'],
        'us_enc_preauth' => ['order_id', 'cust_id', 'amount', 'enc_track2', 'device_type', 'crypt_type', 'dynamic_descriptor'],
        'us_enc_purchase' => ['order_id', 'cust_id', 'amount', 'enc_track2', 'device_type', 'crypt_type', 'commcard_invoice', 'commcard_tax_amount', 'dynamic_descriptor'],
        'us_enc_res_add_cc' => ['cust_id', 'phone', 'email', 'note', 'enc_track2', 'device_type', 'crypt_type'],
        'us_enc_res_update_cc' => ['data_key', 'cust_id', 'phone', 'email', 'note', 'enc_track2', 'device_type', 'crypt_type'],
        'us_enc_track2_forcepost' => ['order_id', 'cust_id', 'amount', 'enc_track2', 'pos_code', 'device_type', 'auth_code', 'dynamic_descriptor'],
        'us_enc_track2_ind_refund' => ['order_id', 'cust_id', 'amount', 'enc_track2', 'pos_code', 'device_type', 'dynamic_descriptor'],
        'us_enc_track2_preauth' => ['order_id', 'cust_id', 'amount', 'enc_track2', 'pos_code', 'device_type', 'dynamic_descriptor'],
        'us_enc_track2_purchase' => ['order_id', 'cust_id', 'amount', 'enc_track2', 'pos_code', 'device_type', 'commcard_invoice', 'commcard_tax_amount', 'dynamic_descriptor'],

        //US Vault
        'us_res_add_cc' => ['cust_id', 'phone', 'email', 'note', 'pan', 'expdate', 'crypt_type'],
        'us_res_add_ach' => ['cust_id', 'phone', 'email', 'note'],
        'us_res_add_pinless' => ['cust_id', 'phone', 'email', 'note', 'pan', 'expdate', 'presentation_type', 'p_account_number'],
        'us_res_add_token' => ['cust_id', 'phone', 'email', 'note', 'data_key', 'crypt_type', 'expdate'],
        'us_res_delete' => ['data_key'],
        'us_res_get_expiring' => [],
        'us_res_ind_refund_ach' => ['data_key', 'order_id', 'cust_id', 'amount'],
        'us_res_ind_refund_cc' => ['data_key', 'order_id', 'cust_id', 'amount', 'crypt_type', 'dynamic_descriptor'],
        'us_res_iscorporatecard' => ['data_key'],
        'us_res_lookup_full' => ['data_key'],
        'us_res_lookup_masked' => ['data_key'],
        'us_res_preauth_cc' => ['data_key', 'order_id', 'cust_id', 'amount', 'crypt_type', 'dynamic_descriptor'],
        'us_res_purchase_ach' => ['data_key', 'order_id', 'cust_id', 'amount'],
        'us_res_purchase_cc' => ['data_key', 'order_id', 'cust_id', 'amount', 'crypt_type', 'commcard_invoice', 'commcard_tax_amount', 'dynamic_descriptor'],
        'us_res_purchase_pinless' => ['data_key', 'order_id', 'cust_id', 'amount', 'intended_use', 'p_account_number'],
        'us_res_temp_add' => ['pan', 'expdate', 'duration', 'crypt_type'],
        'us_res_tokenize_cc' => ['order_id', 'txn_number', 'cust_id', 'phone', 'email', 'note'],
        'us_res_update_cc' => ['data_key', 'cust_id', 'phone', 'email', 'note', 'pan', 'expdate', 'crypt_type'],
        'us_res_update_ach' => ['data_key', 'cust_id', 'phone', 'email', 'note'],
        'us_res_update_pinless' => ['data_key', 'cust_id', 'phone', 'email', 'note', 'pan', 'expdate', 'presentation_type', 'p_account_number'],

        //US Track2
        'us_track2_completion' => ['order_id', 'comp_amount', 'txn_number', 'pos_code', 'commcard_invoice', 'commcard_tax_amount'],
        'us_track2_forcepost' => ['order_id', 'cust_id', 'amount', 'track2', 'pan', 'expdate', 'pos_code', 'auth_code', 'dynamic_descriptor'],
        'us_track2_ind_refund' => ['order_id', 'amount', 'track2', 'pan', 'expdate', 'cust_id', 'pos_code', 'dynamic_descriptor'],
        'us_track2_preauth' => ['order_id', 'cust_id', 'amount', 'track2', 'pan', 'expdate', 'pos_code', 'dynamic_descriptor'],
        'us_track2_purchase' => ['order_id', 'cust_id', 'amount', 'track2', 'pan', 'expdate', 'commcard_invoice', 'commcard_tax_amount', 'pos_code', 'dynamic_descriptor'],
        'us_track2_purchasecorrection' => ['order_id', 'txn_number'],
        'us_track2_refund' => ['order_id', 'amount', 'txn_number'],

        //MPI - Common CA and US
        'txn' => ['xid', 'amount', 'pan', 'expdate', 'MD', 'merchantUrl', 'accept', 'userAgent', 'currency', 'recurFreq', 'recurEnd', 'install'],
        'acs' => ['PaRes', 'MD'],

        //Group Transaction - Common CA and US
        'group' => ['order_id', 'txn_number', 'group_ref_num', 'group_type'],

        //Risk - CA only
        'session_query' => ['order_id', 'session_id', 'service_type', 'event_type'],
        'attribute_query' => ['order_id', 'policy_id', 'service_type'],

        //Level 23
        'iscorporatecard' => ['pan', 'expdate'],

        //Amex General level23
        'axcompletion' => ['order_id', 'comp_amount', 'txn_number'],
        'axrefund' => ['order_id', 'amount', 'txn_number'],
        'axind_refund' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate'],
        'axpurchasecorrection' => ['order_id', 'txn_number', 'crypt_type'],
        'axforcepost' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'auth_code'],

        //Amex Air & Rail level23
        'axracompletion' => ['order_id', 'comp_amount', 'txn_number'],
        'axrarefund' => ['order_id', 'amount', 'txn_number'],
        'axraind_refund' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate'],
        'axrapurchasecorrection' => ['order_id', 'txn_number'],
        'axraforcepost' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'auth_code'],

        //Visa General, Air & Rail Level23
        'vscompletion' => ['order_id', 'comp_amount', 'txn_number', 'crypt_type', 'national_tax', 'merchant_vat_no', 'local_tax', 'customer_vat_no', 'cri', 'customer_code', 'invoice_number', 'local_tax_no'],
        'vsrefund' => ['order_id', 'amount', 'txn_number', 'crypt_type', 'national_tax', 'merchant_vat_no', 'local_tax', 'customer_vat_no', 'cri', 'customer_code', 'invoice_number', 'local_tax_no'],
        'vsind_refund' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'crypt_type', 'national_tax', 'merchant_vat_no', 'local_tax', 'customer_vat_no', 'cri', 'customer_code', 'invoice_number', 'local_tax_no'],
        'vsforcepost' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'auth_code', 'crypt_type', 'national_tax', 'merchant_vat_no', 'local_tax', 'customer_vat_no', 'cri', 'customer_code', 'invoice_number', 'local_tax_no'],
        'vspurchasecorrection' => ['order_id', 'txn_number', 'crypt_type'],
        'vscorpais' => ['order_id', 'txn_number'],

        //MasterCard General, Air and Rail Level23
        'mccompletion' => ['order_id', 'comp_amount', 'txn_number', 'merchant_ref_no', 'crypt_type'],
        'mcrefund' => ['order_id', 'amount', 'txn_number', 'merchant_ref_no', 'crypt_type'],
        'mcind_refund' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'merchant_ref_no', 'crypt_type'],
        'mcpurchasecorrection' => ['order_id', 'txn_number', 'crypt_type'],
        'mcforcepost' => ['order_id', 'cust_id', 'amount', 'pan', 'expdate', 'auth_code', 'merchant_ref_no', 'crypt_type'],
        'mccorpais' => ['order_id', 'txn_number'],
    ];

    protected $xmlString;
    protected $isMPI = '';

    public function getIsMPI()
    {
        return $this->txnArray[0]->isMpiTransaction();
    }

    public function getTransactionType()
    {
        return $this->txnArray[0]->getTransactionType();
    }

    public function getURL()
    {
        $txnType = $this->getTransactionType();

        if (strpos($txnType, 'us_') !== false) {
            $this->setProcCountryCode('US');
        }

        $fileType = $this->getIsMPI() ? '_MPI' : '';

        $hostId = 'MONERIS'.$this->procCountryCode.$this->testMode.'_HOST';
        $fileId = 'MONERIS'.$this->procCountryCode.$fileType.'_FILE';

        $url = Globals::MONERIS_PROTOCOL.'://'.
            constant(Globals::class.'::'.$hostId).':'.
            Globals::MONERIS_PORT.
            constant(Globals::class.'::'.$fileId);

        return $url;
    }

    public function xmlSerialize(Writer $writer)
    {
        $iterator = $this->getTransactionIterator();

        $serialized = [];

        while ($iterator->valid()) {
            $transaction = $iterator->current();

            $serialized[] = $this->xmlSerializeTransaction($transaction);

            $iterator->next();
        }

        $writer->write($serialized);
    }

    protected function xmlSerializeTransaction(MpgTransaction $transaction)
    {
        $serialized = [];
        $type = $transaction->getTransactionType();

        if ($this->procCountryCode === '_US'
            && strpos($type, 'us_') !== 0
            && !$transaction->isMpiTransaction()
            && !$transaction->isGroupTransaction()
        ) {
            $type = 'us_'.$type;
        }

        $serialized[$type] = [];

        foreach ($this->txnTypes[$type] as $option) {
            if (!$transaction->hasOption($option)) {
                continue;
            }

            $serialized[$type][$option] = $transaction->getOption($option);
        }

        // add-ons not implemented yet
        if ($recur = $transaction->getRecur()) {
            $serialized[$type][] = $recur;
        }

        if ($avs = $transaction->getAvsInfo()) {
            $serialized[$type][] = $avs;
        }

        if ($cvd = $transaction->getCvdInfo()) {
            $serialized[$type][] = $cvd;
        }

        if ($custInfo = $transaction->getCustInfo()) {
            $serialized[$type][] = $custInfo;
        }

        if ($ach = $transaction->getAchInfo()) {
            $serialized[$type][] = $ach;
        }

        if ($convFee = $transaction->getConvFeeInfo()) {
            $serialized[$type][] = $convFee;
        }

        if ($sessionQuery = $transaction->getSessionAccountInfo()) {
            $serialized[$type][] = $sessionQuery;
        }

        if ($attributeQuery = $transaction->getAttributeAccountInfo()) {
            $serialized[$type][] = $attributeQuery;
        }

        // $level23Data = $transaction->getLevel23Data();
        // if ($level23Data != null) {
        //     $xml = $level23Data->toXML();

        //     $transactionNode->appendChild(DomDocument::loadXML($xml));
        // }

        if ($transaction->isRiskTransaction()) {
            $serialized = [
                'risk' => $serialized,
            ];
        }

        return [$serialized];
    }
}
