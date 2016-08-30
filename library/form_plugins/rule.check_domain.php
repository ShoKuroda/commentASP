<?php
class CB_SecureForm_Rule_check_domain extends CB_QuickForm_Rule {
    
    function validate($value, $options = null)
    {

        if(preg_match("/^([a-z][a-z0-9_-]*(\.[a-z0-9][a-z0-9_-]*)+)(\d+)?$/", $value)){
            return true;
        }
         
        return false;
    }
    
}