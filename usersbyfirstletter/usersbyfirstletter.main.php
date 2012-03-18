<?php

/* ====================
[BEGIN_COT_EXT]
Hooks=users.main
[END_COT_EXT]
==================== */

defined('COT_CODE') or die('Wrong URL');

require_once cot_incfile('usersbyfirstletter', 'plug');

if(mb_strlen($f) == 1)
{
	$f = strtolower($f);
	$sqlusers = array_filter($sqlusers, 'usersbyfirstletter_filter');
}

?>