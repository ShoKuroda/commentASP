<?php

class CA_DbTableAbstract extends CB_DbTableAbstract{
    
    // pager関数が名称変更になったのでラッパー関数で対応
    function pager($select, $options = null){
    	return $this->fetchPager($select , $options);
    }
    
    // getOptionのラッパー
    function getOptionBySET($field, $keyname = true){
    	$this->getOptions($field, $keyname);
    }
}
