<?php

class CA_Action_customer_site_edit extends CA_Action {
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
            $site_s = $this->db_site->getById($site_id);
            $this->_defaults = array(
                "site" => $site_s,
            );
        }
        
        $this->_elements = array(
            "site[site_id]" => array(
                "name"=>"サイトID",
                "type"=>"hidden",
                "numeric"=>true,
            ),
            "site[site_name]" => array(
                "name"=>"サイト名",
                "type"=>"text",
                "require"=>true,
                "max"=>255,
            ),
            "site[site_url]" => array(
                "name"=>"サイトURL（ドメイン名）",
                "type"=>"text",
                "require"=>true,
                "max"=>255,
                "rule"=>array(
                    "check_domain"=>array(
                        "message"=>"ドメイン名が正しくありません"
                    ),
                )
            ),
            "site[site_sex_flg]" => array(
                "name"=>"[オプション]性別取得",
                "type"=>"select",
                "options"=>array(0=>"利用しない", 1=>"利用する")
            ),
            "site[site_age_flg]" => array(
                "name"=>"[オプション]年齢取得",
                "type"=>"select",
                "options"=>array(0=>"利用しない", 1=>"利用する")
                
            ),
            "site[site_like_flg]" => array(
                "name"=>"[オプション]5段階評価取得",
                "type"=>"select",
                "options"=>array(0=>"利用しない", 1=>"利用する")
            ),
            "site[site_ng_word]" => array(
                "name"=>"NGワード",
                "type"=>"textarea",
                "max"=>1000,
            ),
        );	



	}// END: validate()

    public function done($data)
    {
        
        $data["site"]["site_customer_id"] = $this->session->customer["customer_id"];
        
        try {
            $this->db->beginTransaction();
            
            $result = $this->db_site->autoIu($data["site"]);
            
            if ($result) {
                $this->db->commit();
            } else {
                $this->errorRedirect();
            }
            
        } catch(Exception $e) {
            $this->db->rollback();
            $this->session->message_code = "site_edit";
        }
        if (intval($result)) {
            $this->httpRedirect("/customer/site_edit_period?id=".$result);
        } else {
            $this->session->message = "更新が完了いたしました。";
            $this->httpRedirect("/customer/site_list");
        }
        
        
    }// END: done()
    
}// END: Class