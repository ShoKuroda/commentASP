<?php

class CA_Db_customer extends CA_DbTableAbstract {
  
    //仮登録
	public function insertRegTmp($data)
    {
    
        $data["customer"]["customer_pass"] = sha1($data["customer"]["customer_pass"].KEY);
        $data["customer"]["customer_auth_hash"] = sha1($data["customer"]["customer_mail"].KEY);
        $data["customer"]["customer_status"] = 0;
        
        $result = $this->autoIu($data["customer"]);
        
        if($result) {
            return $data;
        }
		
		return false;
	}
  
	
	//仮登録から本登録へ
	public function updateRegReal($key, $mail)
    {

		$select = $this->select()
			->where("customer_auth_hash = ?", $key)
            ->where("customer_status = ?", 0)
		;
        $customer = $this->fetchRow($select);
        
		if($customer) {
            $this->autoIu(array("customer_id" => $customer["customer_id"], "customer_status" => 1));
            return $customer;
        }
		
		return false;
	}
    
    //ログイン
    public function login($data)
    {
        $select = $this->select(array("customer_id","customer_name"))
            ->where("customer_mail = ?", $data["customer"]["customer_mail"])
            ->where("customer_pass = ?", sha1($data["customer"]["customer_pass"].KEY))
            ->where("customer_status = ?", 1)
        ;
        
        $customer = $this->fetchRow($select);
        return $customer;
    
    }

    
    //パスワードリマインダー
    public function updateRemainder($mail)
    {
        $user = $this->getByMail($mail);
        $data["user"]["user_id"] = $user["user_id"];
        $data["user"]["user_remainder_key"] = sha1($user["user_mail"].CB_KEY.date("YmdHis"));
        
        $result = $this->autoIu($data["user"]);
        
        return $result;
        
    }
    
    //パスワードリマインダー
    public function checkRemainder($key, $mail)
    {   
        $select = $this->select()
                    ->where("user_remainder_key = ?", $key)
        ;

        $result = $this->fetchRow($select);
        
        return $result;
        
    }
    
    
    //パスワードアップデート
    public function updatePass($key, $pass)
    {
        $select = $this->select()
                    ->where("user_remainder_key = ?", $key)
        ;
    
        $result = $this->fetchRow($select);
        
        $data["user"]["user_id"] = $result["user_id"];
        $data["user"]["user_pass"] = sha1($pass.CB_KEY);
        $data["user"]["user_remainder_key"] = "";
        
        $result = $this->autoIu($data["user"]);
        
        return $result;
        
    }
  
}
