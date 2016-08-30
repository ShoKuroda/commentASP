<?php

/**
* Action.php
*
* @category CB_Framework
* @package CB_Framework
* @copyright CYBRiDGE
* @license CYBRiDGE License 1.0
* @since PHP 5.0
* @link http://www.cybridge.jp/
*/

class AM_Action_admin extends CB_Action{

	// 共通初期処理 init()より先に呼び出される。
	public function commonInit()
    {   

        if ($_SERVER["HTTP_X_FORWARDED_FOR"] != "118.238.3.73" && $_SERVER["HTTP_X_FORWARDED_FOR"] != NULL) {
            $this->httpRedirect("/");
        }

        $request_count = $this->db_charge->getChargeAll();
        $payment_count = $this->db_charge->getPaymentAll();
        $error_count = $this->db_gift->getErrorAll();
        $profit = $this->db_charge->getProfit();
        $this->assign("request_count", count($request_count["rows"]));
        $this->assign("payment_count", count($payment_count["rows"]));
        $this->assign("error_count", count($error_count));
        $this->assign("profit", $profit["profit"]);
	}

	public function init()
    {
	}
  
  
    public function auth($type = null)
    {
    }
  
  
  
} 
