<?php

class CB_SecureForm_Rule_login_customer extends CB_QuickForm_Rule {
    function validate($value, $options = null)
    {
        
        if($value[0] && $value[1] ){
        
            $db_customer = CB_Factory::getDbObject("customer");
            
            $select = $db_customer->select()
                ->where("customer_mail = ?",$value[0])
                ->where("customer_pass = ?",sha1($value[1].KEY))
                ->where("customer_status = ?", 1)
            ;
            
            $customer = $db_customer->fetchRow($select);
            if($customer){
                return true;
            }
        }
        
        return false;
    }
}