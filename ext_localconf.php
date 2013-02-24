<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'T3B.' . $_EXTKEY,
	'Show',
	array(
		'Selector' => 'show',
		
	),
	// non-cacheable actions
	array(
		
	)
);

?>