<?php

class CA_Action_auth_login extends CA_Action {
	var $_isForm = true;
	var $_freeze = false;
	var $_method = "post";

	public function init()
    {
	}// END: init()

	public function validate()
    {

        $this->_elements = array(
            "customer[customer_mail]" => array(
                "name"=>"メールアドレス",
                "type"=>"text",
                "require"=>true,
            ),
            "customer[customer_pass]" => array(
                "name"=>"パスワード", 
                "type"=>"password",
                "require"=>true,
                "rule"=>array(
                    "login_customer"=>array(
                        "elements"=>array(
                            "customer[customer_mail]",
                            "customer[customer_pass]"
                        ),
                        "message"=>"メールアドレスまたはパスワードが正しくありません"
                    ),
                ),
            )
        );
    
	}// END: validate()

    public function done($data)
    {
      
        $result = $this->db_customer->login($data);
        $this->session->customer = $result;
        if ($this->get("ref")) {
            $this->httpRedirect($this->get("ref"));
        } else {
            $this->httpRedirect("/customer/");
        }
    
    }// END: done()
    
}// END: Class