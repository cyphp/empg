<?php

namespace Empg\HttpsPost\Response;

class MpiResponse
{
    public $responseData;

    public $p; //parser

    public $currentTag;
    public $receiptHash = array();
    public $currentTxnType;

    public $ACSUrl;

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

    //vbv start

    //To prevent Undefined Index Notices
    private function getMpiResponseValue($responseData, $value)
    {
        return isset($responseData[$value]) ? $responseData[$value] : '';
    }

    public function getMpiMessage()
    {
        return $this->getMpiResponseValue($this->responseData, 'message');
    }

    public function getMpiSuccess()
    {
        return $this->getMpiResponseValue($this->responseData, 'success');
    }

    public function getMpiPAResVerified()
    {
        return $this->getMpiResponseValue($this->responseData, 'PAResVerified');
    }

    public function getMpiAcsUrl()
    {
        return $this->getMpiResponseValue($this->responseData, 'ACSUrl');
    }

    public function getMpiPaReq()
    {
        return $this->getMpiResponseValue($this->responseData, 'PaReq');
    }

    public function getMpiTermUrl()
    {
        return $this->getMpiResponseValue($this->responseData, 'TermUrl');
    }

    public function getMpiMD()
    {
        return $this->getMpiResponseValue($this->responseData, 'MD');
    }

    public function getMpiCavv()
    {
        return $this->getMpiResponseValue($this->responseData, 'cavv');
    }

    public function getMpiEci()
    {
        return $this->getMpiResponseValue($this->responseData, 'eci');
    }

    public function getMpiResponseData()
    {
        return $this->responseData;
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

        return $inLineForm;
    }

    public function characterHandler($parser, $data)
    {
        if (isset($this->responseData[$this->currentTag])) {
            $this->responseData[$this->currentTag] .= trim($data);
        } else {
            $this->responseData[$this->currentTag] = trim($data);
        }
    }//end characterHandler

    public function startHandler($parser, $name, $attrs)
    {
        $this->currentTag = $name;
    }

    public function endHandler($parser, $name)
    {
    }
}
