<?php

class CA_Action_request_approved extends CA_Action {
	var $_isForm = false;
	var $_freeze = false;
	var $_method = "get";

	public function init(){
	}// END: init()

	public function validate(){
	}// END: validate()

	public function done($data){
        
        try {
            $this->db->beginTransaction();
          
            $result = $this->db_customer->updateRegReal($this->get("key"), $this->get("mail"));

            if ($result) {
                $this->db->commit();
            } else {
                $this->errorRedirect();
            }
          
        } catch(Exception $e) {
                $this->db->rollback();
                $this->session->message_code = "reuest_approved";
        }
        
        $this->httpRedirect("/request_thanks");
        
    }// END: done()
}





