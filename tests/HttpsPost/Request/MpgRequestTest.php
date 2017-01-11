<?php

use Empg\HttpsPost\Request\MpgRequest;
use Empg\HttpsPost\Transaction\MpgTransaction;

class MpgRequestTest extends EmpgTestCase
{
    public function testToXML()
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

        $this->assertEquals('<res_mpitxn><data_key>FAFGAFGHFAGHSFHGA</data_key><xid>99999999991902175641</xid><MD>224530</MD><merchantUrl>www.test.com</merchantUrl><accept>1</accept><userAgent>Mozilla</userAgent><expdate>1807</expdate></res_mpitxn>', $request->toXML());
    }
}
