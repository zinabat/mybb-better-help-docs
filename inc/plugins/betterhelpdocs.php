<?php

if(!defined('IN_MYBB'))
	die('You Cannot Access This File Directly. Please Make Sure IN_MYBB Is Defined.');

define('PLUGIN_BETTERHELPDOCS_ROOT', MYBB_ROOT . 'inc/plugins/betterhelpdocs');

if (defined('IN_ADMINCP')) {
	require_once PLUGIN_BETTERHELPDOCS_ROOT.'/install.php';
	//require_once PLUGIN_BETTERHELPDOCS_ROOT.'/admin.php';
} else {
	require_once PLUGIN_BETTERHELPDOCS_ROOT.'/forum.php';
}

?>