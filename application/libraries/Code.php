<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . 'third_party/Zend/Barcode.php';
class Code extends Zend_Barcode
{
    function __construct()
    {
     //    parent::__construct();
    }
}
