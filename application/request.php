<?php

class CA_Action_request extends CA_Action {
	var $_isForm = true;
	var $_freeze = true;
	var $_method = "post";

	public function init(){
	}// END: init()

	public function validate(){
        
        $this->_elements = array(
            "customer[customer_name]" => array(
                "name"=>"お名前(企業名)",
                "type"=>"text",
                "require"=>true,
                "max"=>255,
            ),
            "customer[customer_tel]" => array(
                "name"=>"電話番号(ハイフンあり)",
                "type"=>"text",
                "require"=>true,
                "tel"=>true,
            ),
            "customer[customer_address]" => array(
                "name"=>"住所",
                "type"=>"text",
                "require"=>true,
                "max"=>255,
            ),
            "customer[customer_pass]" => array(
                "name"=>"パスワード",
                "type"=>"password",
                "require"=>true,
            ),
            "customer[customer_mail]" => array(
                "name"=>"メールアドレス",
                "type"=>"text",
                "require"=>true,
                "max"=>255,
                "rule"=>array(
                    "unique_mail"=>array(
                        "message"=>"すでに登録されているメールアドレスです。"
                    )
                ),
                
            ),
            "customer[customer_mail_conf]" => array(
                "name"=>"メールアドレス(確認)",
                "type"=>"text",
                "require"=>true,
                "max"=>255,
                "compare"=>array(
                    "elements"=>array(
                        "customer[customer_mail]",
                        "customer[customer_mail_conf]"
                    ),
                    "msg"=>""
                ),
            ),
        );	
        
	}// END: validate()

	public function done($data){
        
        try {
            $this->db->beginTransaction();
            
            $result = $this->db_customer->insertRegTmp($data);
            
            if ($result) {
                $this->sendMailRegisterTmp($result["customer"]);
                $this->db->commit();
            } else {
                $this->errorRedirect();
            }
            
        } catch(Exception $e) {
            $this->db->rollback();
            $this->session->message_code = "Request";
        }
        
        $this->httpRedirect("/request_fin");
        
    }// END: done()
}





