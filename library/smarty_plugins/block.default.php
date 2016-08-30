<?php
/**
 * ブロックのテンプレート（$contentをそのまま返す）
 * 
 * @category   CB_Framework
 * @package    CB_Framework
 * @subpackage smarty_plugin
 * @copyright  CYBRiDGE
 * @license    CYBRiDGE License 1.0
 * 
 */
function smarty_block_default($params, $content, &$smarty,&$repeat)
{
	echo $content;
}

?>