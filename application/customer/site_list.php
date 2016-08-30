<?php

class CA_Action_customer_site_list extends CA_Action {
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
        
        $site_s = $this->db_site->getByCustomerId($this->session->customer["customer_id"]);
        $this->assign("site_s", $site_s);
                
    }// END: done()
    
}// END: Class