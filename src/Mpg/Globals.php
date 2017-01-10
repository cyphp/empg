<?php

namespace Empg\Mpg;

class Globals
{
    const MONERIS_PROTOCOL = 'https';
    const MONERIS_HOST = 'www3.moneris.com'; //default
    const MONERIS_TEST_HOST = 'esqa.moneris.com';
    const MONERIS_US_HOST = 'esplus.moneris.com';
    const MONERIS_US_TEST_HOST = 'esplusqa.moneris.com';
    const MONERIS_PORT = '443';
    const MONERIS_FILE = '/gateway2/servlet/MpgRequest';
    const MONERIS_US_FILE = '/gateway_us/servlet/MpgRequest';
    const MONERIS_MPI_FILE = '/mpi/servlet/MpiServlet';
    const MONERIS_US_MPI_FILE = '/mpi/servlet/MpiServlet';
    const API_VERSION = 'PHP NA - 1.0.5';
    const CLIENT_TIMEOUT = '30';
}
