<?php

class CA_Action_customer_site_edit_period extends CA_Action {
	var $_isForm = true;
	var $_freeze = true;
	var $_method = "post";

	public function init()
    {
        parent::auth("login");
	}// END: init()

	public function validate()
    {

        $site_id = $this->get("id", "int");
        
        if($site_id){
            $site = $this->db_site->getById($site_id);
            $this->_defaults["payment"]["payment_site_id"] = $site["site_id"];
        }
        
        $this->_elements = array(
            "payment[payment_site_id]" => array(
                "name"=>"サイトID",
                "type"=>"hidden",
                "require"=>true,
            ),
            "site[site_start_time]" => array(
                "name"=>"ご利用開始日時",
                "type"=>"date",
                "require"=>true,
            ),
            "payment[payment_period]" => array(
                "name"=>"ご利用期間",
                "type"=>"select",
                "require"=>true,
                "options"=>$this->usePeriod($this->session->customer["customer_id"])
            ),
            "payment[payment_transfer_name]" => array(
                "name"=>"お振込元名(カナ)",
                "type"=>"text",
                "require"=>true,
            ),
        );	


	}// END: validate()

    public function done($data)
    {
        
        $data["site"]["site_id"] = $data["payment"]["payment_site_id"];
        $data["site"]["site_start_time"] = $data["site"]["site_start_time"]["Y"]."-".$data["site"]["site_start_time"]["m"]."-".$data["site"]["site_start_time"]["d"];
        $data["site"]["site_end_time"] = date('Y-m-d', strtotime($data["site"]["site_start_time"].' +'.$data["payment"]["payment_period"].' day'));
        
        
        $data["payment"]["payment_customer_id"] = $this->session->customer["customer_id"];
        
        //無料利用の場合
        if ($data["payment"]["payment_period"] == FREE_DAY) {
            $data["payment"]["payment_price"] = 0;
            $data["payment"]["payment_status"] = 1;
        } else {
            $data["payment"]["payment_price"] = $data["payment"]["payment_period"] / TERM_DAY * PRICE;
            $data["payment"]["payment_price"] += $this->checkFirstReg($this->session->customer["customer_id"], $data["site"]["site_id"]) ? STERT_PRICE : "";
            $data["payment"]["payment_status"] = 0;
        }

        try {
            $this->db->beginTransaction();
            
            $site_result = $this->db_site->autoIu($data["site"]);
            $payment_result = $this->db_payment->autoIu($data["payment"]);
            
            if ($site_result && $payment_result) {
                $this->db->commit();
            } else {
                $this->errorRedirect();
            }
            
        } catch(Exception $e) {
            $this->db->rollback();
            $this->session->message_code = "site_edit_period";
        }

        $this->httpRedirect("/customer/site_edit_fin");
        
        
    }// END: done()
    
}// END: Class