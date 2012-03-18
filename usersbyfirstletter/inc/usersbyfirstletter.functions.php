<?php

defined('COT_CODE') or die('Wrong URL');

/**
 * Filter userlist by first letter of username.
 * To be used with array_filter.
 *
 * @global string $f First letter to filter on
 * @param array $urr User data row
 * @return bool
 */
function usersbyfirstletter_filter($urr)
{
	global $f;
	$asciiname = get_ascii($urr['user_name']);
	return ($asciiname[0] == $f);
}

/**
 * Attempt to transliterate to ASCII.
 * Returns ASCII string if succesful, otherwise returns the original string.
 * Returns lowercase version in both cases.
 *
 * @param string $str
 * @return string
 */
function get_ascii($str)
{
	setlocale(LC_ALL, 'en_US.UTF8');
	$str = trim($str);
    $str2 = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $str);
	if ($str === $str2) return mb_strtolower($str);
    $j = 0;
	$ascii = '';
    for ($i = 0; $i < mb_strlen($str2); $i++)
	{
        $char1 = $str2[$i];
        $char2 = @mb_substr($str, $j++, 1, 'UTF-8');
        if (strstr('`^~\'"', $char1) !== false)
		{
            if ($char1 != $char2)
			{
                --$j;
                continue;
            }
        }
        $ascii .= ($char1 == '?') ? $char2 : $char1;
    }
	return strtolower(trim($ascii));
}

?>