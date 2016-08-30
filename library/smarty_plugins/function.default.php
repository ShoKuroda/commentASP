<?php
/**
 * テンプレート（echoパラメータの値を返す）
 *
 * @category   CB_Framework
 * @package    CB_Framework
 * @subpackage smarty_plugin
 * @copyright  CYBRiDGE
 * @license    CYBRiDGE License 1.0
 * 
 */

function smarty_function_default($params){
	return $params["echo"];
}

