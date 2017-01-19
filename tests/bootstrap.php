<?php

require_once __DIR__.'/../vendor/autoload.php';

use Sabre\Xml\Writer;

class EmpgTestCase extends PHPUnit_Framework_TestCase
{
    protected $sabreWriter;

    protected function setUp()
    {
        $this->sabreWriter = new Writer();

        $this->sabreWriter->openMemory();
        $this->sabreWriter->setIndent(false);
        $this->sabreWriter->startDocument('1.0', 'UTF-8');
    }
}
