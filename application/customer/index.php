<?php

class CA_Action_customer_index extends CA_Action {
	var $_isForm = false;
	var $_freeze = false;
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
    
    }// END: done()
    
}// END: Class