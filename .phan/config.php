<?php
$cfg = require __DIR__ . '/../vendor/mediawiki/mediawiki-phan-config/src/config.php';

$cfg['suppress_issue_types'][] = 'MediaWikiNoEmptyIfDefined';
$cfg['suppress_issue_types'][] = 'PhanCoalescingNeverNull';
// Possible false positive about reference to \Firebase\JWT\Key
// declared at ../../vendor/firebase/php-jwt/src/Key.php:10
$cfg['suppress_issue_types'][] = 'PhanRedefinedClassReference';

$cfg['directory_list'] = array_merge(
	$cfg['directory_list'],
	[
		'../PluggableAuth',
		'vendor/firebase/php-jwt',
		'vendor/paragonie/sodium_compat',
	]
);

$cfg['exclude_analysis_directory_list'] = array_merge(
	$cfg['exclude_analysis_directory_list'],
	[
		'../PluggableAuth',
		'vendor/firebase/php-jwt',
		'vendor/paragonie/sodium_compat',
	]
);

return $cfg;
