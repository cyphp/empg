<?php

namespace Empg\HttpsPost\Response;

class RiskResponse
{
    public $responseData;

    public $p; //parser

    public $currentTag;
    public $isResults;
    public $isRule;
    public $ruleName;
    public $results = array();
    public $rules = array();

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

    public function getRiskResponse()
    {
        return $this->responseData;
    }

    //To prevent Undefined Index Notices
    private function getMpgResponseValue($responseData, $value)
    {
        return isset($responseData[$value]) ? $responseData[$value] : '';
    }

    //-----------------  Receipt Variables  ---------------------------------------------------------//

    public function getReceiptId()
    {
        return $this->getMpgResponseValue($this->responseData, 'ReceiptId');
    }

    public function getResponseCode()
    {
        return $this->getMpgResponseValue($this->responseData, 'ResponseCode');
    }

    public function getMessage()
    {
        return $this->getMpgResponseValue($this->responseData, 'Message');
    }

    public function getResults()
    {
        return $this->results;
    }

    public function getRules()
    {
        return $this->rules;
    }

    //-----------------  Parser Handlers  ---------------------------------------------------------//

    public function characterHandler($parser, $data)
    {
        @$this->responseData[$this->currentTag] .= $data;

        if ($this->isResults) {
            //print("\n".$this->currentTag."=".$data);
            $this->results[$this->currentTag] = $data;
        }

        if ($this->isRule) {
            if ($this->currentTag == 'RuleName') {
                $this->ruleName = $data;
            }
            $this->rules[$this->ruleName][$this->currentTag] = $data;
        }
    }//end characterHandler

    public function startHandler($parser, $name, $attrs)
    {
        $this->currentTag = $name;

        if ($this->currentTag == 'Result') {
            $this->isResults = 1;
        }

        if ($this->currentTag == 'Rule') {
            $this->isRule = 1;
        }
    } //end startHandler

    public function endHandler($parser, $name)
    {
        $this->currentTag = $name;

        if ($name == 'Result') {
            $this->isResults = 0;
        }

        if ($this->currentTag == 'Rule') {
            $this->isRule = 0;
        }

        $this->currentTag = '/dev/null';
    } //end endHandler
}
