<?php

class CA_Db_payment extends CA_DbTableAbstract {
  
    //kカスタマーIDから取得
	public function getByCustomerId($customerId)
    {
        $select = $this->select()
            ->joinLeft("site", "payment_site_id = site_id")
            ->where("site_customer_id = ?", $customerId)
            ->where("site_delete_flg = ?", 0)
        ;
        
        $result = $this->fetchAll($select);
        
        
        if($result) {
            return $result;
        }
		
	}
  
}
