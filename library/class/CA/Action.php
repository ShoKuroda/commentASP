<?php

class CA_Action extends CB_Action{

	public function commonInit()
    {
       if ($this->session->message) {
           $this->assign("message", $this->session->message);
       }
	}

	public function init()
    {   
	}
    
    
    public function after_done()
    {   
        unset($this->session->message);
    }
    
  
    public function auth($type = null)
    {
        if ($type == "login") {
            !$this->session->customer ? $this->httpRedirect("/auth/login?ref=".$_SERVER["REQUEST_URI"]) : "";
        }
        
        if ($this->session->customer) {
            $this->assign("customer", $this->session->customer);
        }
        
    }
    
    public function errorRedirect()
    {
        $this->httpRedirect("/404");
    }
    
    
    public function checkFirstReg($customerId = false, $siteId = false)
    {
        $select = $this->db_payment
            ->select()
            ->where("payment_customer_id = ?", $customerId)
            ->where("payment_site_id = ?", $siteId)
            ->where("payment_status = ?", 1)
            ->where("payment_period != ?", FREE_DAY)
        ;
        
        $result = $this->db_payment->fetchRow($select);
        
        if ($result) {
            return false;
        } else {
            return true;
        }
        
    }
    
    
    //以下メールメソッド
    public function sendMail($to, $subject, $mailTemplate, $assign)
    {
        $zmail = new CB_Zend_Mail();
        $zmail->assign("assign", $assign);
        $zmail->setBodyText($zmail->fetch($mailTemplate));
        $zmail->setFrom(SYSTEM_MAIL_FROM,SYSTEM_MAIL_NAME);
        $zmail->setSubject($subject);
        $zmail->addTo($to);
        $zmail->send();
    }

  
    public function sendMailRegisterTmp($customer)
    {
        $this->sendMail(
            $customer["customer_mail"],
            "【サイトタイトル】本登録からご利用申請をお願いいたします。",
            "register_tmp.php",
            $customer
        );
    
    }
  
    //パスワードリマインダー
    public function sendMailRemainder($mail)
    {
        $user = $this->db_user->getByMail($mail);
        $this->sendMail(
            $user["user_mail"],
            "パスワード再設定のお知らせ",
            "remainder.php",
            $user
        );
    
    }
  
    //お問い合わせ
    public function sendContact($data)
    { 
        $this->sendMail(
            CONTACT_MAIL,
            "お問い合わせ",
            "contact.php",
            $data
        );
    
    }
    
    
    //利用期間
    public function usePeriod($customerId = false, $siteId = false)
    {   
        
        $select = $this->db_payment
            ->select()
            ->where("payment_customer_id = ?", $customerId)
            ->where("payment_status = ?", 1)
        ;
        
        $result = $this->db_payment->fetchRow($select);
        
        if ($this->checkFirstReg($customerId, $siteId)) {
            $start_price = " + 初期費用30,000円";
        } else {
            $start_price = "";
        }
        
        if (!$result) {
            $list[FREE_DAY] = "1週間（無料）";
        }
        
        $list[90] = "3ヶ月（". number_format(90/TERM_DAY*PRICE). "円）".$start_price;
        $list[180] = "6ヶ月（". number_format(180/TERM_DAY*PRICE). "円）".$start_price;
        $list[270] = "9ヶ月（". number_format(270/TERM_DAY*PRICE). "円）".$start_price;
        $list[365] = "12ヶ月（". number_format(360/TERM_DAY*PRICE). "円）".$start_price;
        
        return $list;
        
    }
    
  
} 
