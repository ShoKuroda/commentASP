<?php
class CB_SecureForm_Rule_unique_mail extends CB_QuickForm_Rule {
    function validate($value, $options = null)
    {
    
        if ($options) {
            $db_customer = CB_Factory::getDbObject("customer");
            $select = $db_customer->select()
                ->where("customer_mail = ?",$value)
                ->where("customer_id = ?",$options)
            ;
        
            $customer = $db_customer->fetchRow($select);
            
            if($customer){
                return true;
            }
            
        }
        
        $db_customer = CB_Factory::getDbObject("customer");
        $select = $db_customer->select()
            ->where("customer_mail = ?",$value)
        ;
        
        $customer = $db_customer->fetchRow($select);
        
        if(!$customer){
            return true;
        }
         
        return false;
    }
}