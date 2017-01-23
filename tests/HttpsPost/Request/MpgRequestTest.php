<?php

use Empg\HttpsPost\Request\MpgRequest;
use Empg\HttpsPost\Transaction\MpgTransaction;
use Empg\Mpg\MpgRecur;
use Empg\Mpg\MpgCustInfo;

class MpgRequestTest extends EmpgTestCase
{
    public function testXmlSerialize()
    {
        $transaction = new MpgTransaction([
            'type' => 'res_mpitxn',
            'expdate' => '1807',
            'data_key' => 'FAFGAFGHFAGHSFHGA',
            'xid' => '99999999991902175641',
            'MD' => '224530',
            'merchantUrl' => 'www.test.com',
            'accept' => true,
            'userAgent' => 'Mozilla',
        ]);

        $request = new MpgRequest($transaction);

        $this->sabreWriter->write($request);

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?><res_mpitxn xmlns="http://www.w3.org/1999/xhtml"><data_key>FAFGAFGHFAGHSFHGA</data_key><xid>99999999991902175641</xid><MD>224530</MD><merchantUrl>www.test.com</merchantUrl><accept>1</accept><userAgent>Mozilla</userAgent><expdate>1807</expdate></res_mpitxn>', str_replace(["\n", "\r"], '', $this->sabreWriter->outputMemory()));
    }

    public function testXmlSerializeRecur()
    {
        $recurArray = [
            'recur_unit' => 'eom', // (day | week | month)
            'start_date' => '2018/11/30', //yyyy/mm/dd
            'num_recurs' => '4',
            'start_now' => 'true',
            'period' => '10',
            'recur_amount' => '31.00',
        ];

        $mpgRecur = new MpgRecur($recurArray);

        $transaction = new MpgTransaction([
            'type' => 'res_mpitxn',
            'expdate' => '1807',
            'data_key' => 'FAFGAFGHFAGHSFHGA',
            'xid' => '99999999991902175641',
            'MD' => '224530',
            'merchantUrl' => 'www.test.com',
            'accept' => true,
            'userAgent' => 'Mozilla',
        ]);

        $transaction->setRecur($mpgRecur);

        $request = new MpgRequest($transaction);

        $this->sabreWriter->write($request);

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?><res_mpitxn xmlns="http://www.w3.org/1999/xhtml"><data_key>FAFGAFGHFAGHSFHGA</data_key><xid>99999999991902175641</xid><MD>224530</MD><merchantUrl>www.test.com</merchantUrl><accept>1</accept><userAgent>Mozilla</userAgent><expdate>1807</expdate><recur><recur_unit>eom</recur_unit><start_date>2018/11/30</start_date><num_recurs>4</num_recurs><start_now>true</start_now><period>10</period><recur_amount>31.00</recur_amount></recur></res_mpitxn>', str_replace(["\n", "\r"], '', $this->sabreWriter->outputMemory()));
    }

    public function testXmlSerializeCustInfo()
    {
        $mpgCustInfo = new MpgCustInfo();

        $email = 'Joe@widgets.com';
        $mpgCustInfo->setEmail($email);

        $instructions = 'Make it fast';
        $mpgCustInfo->setInstructions($instructions);

        $billing = [
            'first_name' => 'Joe',
            'last_name' => 'Thompson',
            'company_name' => 'Widget Company Inc.',
            'address' => '111 Bolts Ave.',
            'city' => 'Toronto',
            'province' => 'Ontario',
            'postal_code' => 'M8T 1T8',
            'country' => 'Canada',
            'phone_number' => '416-555-5555',
            'fax' => '416-555-5555',
            'tax1' => '123.45',
            'tax2' => '12.34',
            'tax3' => '15.45',
            'shipping_cost' => '456.23',
        ];

        $mpgCustInfo->setBilling($billing);

        $shipping = [
            'first_name' => 'Joe',
            'last_name' => 'Thompson',
            'company_name' => 'Widget Company Inc.',
            'address' => '111 Bolts Ave.',
            'city' => 'Toronto',
            'province' => 'Ontario',
            'postal_code' => 'M8T 1T8',
            'country' => 'Canada',
            'phone_number' => '416-555-5555',
            'fax' => '416-555-5555',
            'tax1' => '123.45',
            'tax2' => '12.34',
            'tax3' => '15.45',
            'shipping_cost' => '456.23',
        ];

        $mpgCustInfo->setShipping($shipping);

        $item1 = [
            'name' => 'item 1 name',
            'quantity' => '53',
            'product_code' => 'item 1 product code',
            'extended_amount' => '1.00',
        ];

        $mpgCustInfo->setItems($item1);

        $item2 = [
            'name' => 'item 2 name',
            'quantity' => '53',
            'product_code' => 'item 2 product code',
            'extended_amount' => '1.00',
        ];

        $mpgCustInfo->setItems($item2);

        $this->sabreWriter->write($mpgCustInfo);

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?><cust_info xmlns="http://www.w3.org/1999/xhtml"><email>Joe@widgets.com</email><instructions>Make it fast</instructions><billing><first_name>Joe</first_name><last_name>Thompson</last_name><company_name>Widget Company Inc.</company_name><address>111 Bolts Ave.</address><city>Toronto</city><province>Ontario</province><postal_code>M8T 1T8</postal_code><country>Canada</country><phone_number>416-555-5555</phone_number><fax>416-555-5555</fax><tax1>123.45</tax1><tax2>12.34</tax2><tax3>15.45</tax3><shipping_cost>456.23</shipping_cost></billing><shipping><first_name>Joe</first_name><last_name>Thompson</last_name><company_name>Widget Company Inc.</company_name><address>111 Bolts Ave.</address><city>Toronto</city><province>Ontario</province><postal_code>M8T 1T8</postal_code><country>Canada</country><phone_number>416-555-5555</phone_number><fax>416-555-5555</fax><tax1>123.45</tax1><tax2>12.34</tax2><tax3>15.45</tax3><shipping_cost>456.23</shipping_cost></shipping><item><name>item 1 name</name><quantity>53</quantity><product_code>item 1 product code</product_code><extended_amount>1.00</extended_amount></item><item><name>item 2 name</name><quantity>53</quantity><product_code>item 2 product code</product_code><extended_amount>1.00</extended_amount></item></cust_info>', str_replace(["\n", "\r"], '', $this->sabreWriter->outputMemory()));
    }
}
