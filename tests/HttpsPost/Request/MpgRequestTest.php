<?php

use Empg\HttpsPost\Request\MpgRequest;
use Empg\HttpsPost\Transaction\MpgTransaction;
use Empg\Mpg\MpgRecur;

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

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?><res_mpitxn><data_key>FAFGAFGHFAGHSFHGA</data_key><xid>99999999991902175641</xid><MD>224530</MD><merchantUrl>www.test.com</merchantUrl><accept>1</accept><userAgent>Mozilla</userAgent><expdate>1807</expdate></res_mpitxn>', str_replace(["\n", "\r"], '', $this->sabreWriter->outputMemory()));
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

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?><res_mpitxn><data_key>FAFGAFGHFAGHSFHGA</data_key><xid>99999999991902175641</xid><MD>224530</MD><merchantUrl>www.test.com</merchantUrl><accept>1</accept><userAgent>Mozilla</userAgent><expdate>1807</expdate><recur><recur_unit>eom</recur_unit><start_date>2018/11/30</start_date><num_recurs>4</num_recurs><start_now>true</start_now><period>10</period><recur_amount>31.00</recur_amount></recur></res_mpitxn>', str_replace(["\n", "\r"], '', $this->sabreWriter->outputMemory()));
    }
}
