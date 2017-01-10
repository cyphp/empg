<?php

use Empg\HttpsPost\Response\MpgResponse;

class MpgResponseTest extends EmpgTestCase
{
    public function testMpgResponseXMLParsing()
    {
        $xml = <<<'XML'
<?xml version="1.0"?><response><receipt><DataKey>null</DataKey><ReceiptId>null</ReceiptId><ReferenceNum>null</ReferenceNum><ResponseCode>null</ResponseCode><ISO>null</ISO><AuthCode>null</AuthCode><Message>null</Message><TransTime>null</TransTime><TransDate>null</TransDate><TransType>null</TransType><Complete>false</Complete><TransAmount>null</TransAmount><CardType>null</CardType><TransID>null</TransID><TimedOut>false</TimedOut><CorporateCard>null</CorporateCard><RecurSuccess>null</RecurSuccess><AvsResultCode>null</AvsResultCode><CvdResultCode>null</CvdResultCode><ResSuccess>false</ResSuccess><PaymentType>null</PaymentType><IsVisaDebit>null</IsVisaDebit><ResolveData>null</ResolveData><MpiType>VERes</MpiType><MpiSuccess>true</MpiSuccess><MpiMessage>Y</MpiMessage><MpiPaReq>7zkgQ/rBcZu8QGxd4wU/hGfMQkyrdQz0tDypK6iKdH4V9OeE7HZMVpE3I93nPHk9x3V1rKKqKeJTQ2pJQ/
e3anjxdVi65VnT8Il4gUolLVcsuoXYFm4TikD34urwNHH54Y+cYk8o7fhLus3KT0Vh6FeU+opNBg+cbtqw7ZoloOFvT3QU9v2SBYBlA
ytlFkb1Tt7OraITvV1lvObpd8//+p9g3</MpiPaReq><MpiTermUrl>http://once-cc.dev/payment/credit-card/mpi-txn-callback</MpiTermUrl><MpiMD>894626</MpiMD><MpiACSUrl>https://www.securesuite.net/opt_in_dispatcher.jsp?partner=canada.vs&amp;VBV=A</MpiACSUrl><MpiCavv>null</MpiCavv><MpiPAResVerified>null</MpiPAResVerified></receipt></response>
XML;
        $response = new MpgResponse($xml);

        $this->assertEquals('https://www.securesuite.net/opt_in_dispatcher.jsp?partner=canada.vs&amp;VBV=A', $response->getMpiACSUrl());
    }
}
