<?php

class CA_Action_customer_payment_list extends CA_Action {
	var $_isForm = true;
	var $_freeze = true;
	var $_method = "post";

	public function init()
    {
        parent::auth("login");
	}// END: init()

	public function validate()
    {
	}// END: validate()

    public function done($data)
    {
        
        $site_s = $this->db_payment->getByCustomerId($this->session->customer["customer_id"]);
        $this->assign("site_s", $site_s);
                
    }// END: done()
    
}// END: Class