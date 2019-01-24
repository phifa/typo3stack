<?php

// DB
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['dbname'] = getenv('TYPO3__DB__Connections__Default__dbname');
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['host'] = getenv('TYPO3__DB__Connections__Default__host');
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['password'] = getenv('TYPO3__DB__Connections__Default__password');
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['port'] = getenv('TYPO3__DB__Connections__Default__port');
$GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['user'] = getenv('TYPO3__DB__Connections__Default__user');
// BE
$GLOBALS['TYPO3_CONF_VARS']['BE']['warning_email_addr'] = getenv('TYPO3__BE__warning_email_addr'); // 3x Failed Logins and Install Tool Login attempts are reported
$GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'] = 512000; // max filesize in KB's for file operations in the backend
$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword'] = getenv('TYPO3__BE__installToolPassword');
// FE
$GLOBALS['TYPO3_CONF_VARS']['FE']['hidePagesIfNotTranslatedByDefault'] = 1;
$GLOBALS['TYPO3_CONF_VARS']['FE']['compressionLevel'] = 5; // Requires zlib and rewrite rules for .css.gzip and .js.gzip
$GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFound_handling'] = getenv('TYPO3__FE__pageNotFound_handling');
// GFX
$GLOBALS['TYPO3_CONF_VARS']['GFX']['jpg_quality'] = 70;
$GLOBALS['TYPO3_CONF_VARS']['GFX']['processor'] = getenv('TYPO3__GFX__processor');
$GLOBALS['TYPO3_CONF_VARS']['GFX']['processor_path'] = getenv('TYPO3__GFX__processor_path');
$GLOBALS['TYPO3_CONF_VARS']['GFX']['processor_path_lzw'] = getenv('TYPO3__GFX__processor_path_lzw');
// SYS
$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] = getenv('TYPO3__SYS__sitename') . " " . getenv('TYPO3_CONTEXT');
$GLOBALS['TYPO3_CONF_VARS']['SYS']['curlUse'] = 0;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['UTF8filesystem'] = 1; // utf-8 to store file names
$GLOBALS['TYPO3_CONF_VARS']['SYS']['clearCacheSystem'] = 1;

// EXTENSIONS
$GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['backend']['backendFavicon'] = '';
$GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['backend']['backendLogo'] = '';
$GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['backend']['loginBackgroundImage'] = 'fileadmin/template/test/test.jpg';
$GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['backend']['loginFootnote'] = 'Welcome to the new TYPO3 v9 Sitepackage! ';
$GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['backend']['loginHighlightColor'] = '#000000';
$GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['backend']['loginLogo'] = '';

/**
 *  Production
 */
if (\TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->isProduction()) {
    // BE
    $GLOBALS['TYPO3_CONF_VARS']['BE']['debug'] = 0; // Debug
    // FE
    $GLOBALS['TYPO3_CONF_VARS']['FE']['debug'] = 0; // HTML Comments Debug
    // SYS
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['sqlDebug'] = 0; // 0: no SQL shown (default) / 1: show only failed queries / 2: show all queries
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['enable_DLOG'] = 0; //  Boolean: Whether the developer log is enabled. See constant "TYPO3_DLOG"
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLog'] = ''; //  Time
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLogLevel'] = 4; //  Integer (0, 1, 2, 3, 4): Only messages with same or higher severity are logged.
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = 0;

}

/**
 *  Development || Production/Debug
 */
if (\TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->isDevelopment() ||
    (\TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->isProduction() &&
        \TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->__toString() === 'Production/Debug')) {
    // BE
    $GLOBALS['TYPO3_CONF_VARS']['BE']['debug'] = 1; // Debug
    // FE
    $GLOBALS['TYPO3_CONF_VARS']['FE']['debug'] = 1; // HTML Comments Debug
    // SYS
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['sqlDebug'] = 1; // 0: no SQL shown (default) / 1: show only failed queries / 2: show all queries
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['enable_DLOG'] = 1; //  Boolean: Whether the developer log is enabled. See constant "TYPO3_DLOG"
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLog'] = 'error_log';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLogLevel'] = 1; //  Integer (0, 1, 2, 3, 4): Only messages with same or higher severity are logged.
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = 1;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['exceptionalErrors'] = '28674';
}

/**
 *  Development/Local
 */
if (\TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->isDevelopment() && \TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->__toString() === 'Development/Local') {
    $GLOBALS['TYPO3_CONF_VARS']['BE']['sessionTimeout'] = 60 * 60 * 24 * 365; // One year!
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['trustedHostsPattern'] = '.*';
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] = '*';
    // All mails to mailhog locally
    $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport'] = 'smtp';
    $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_smtp_server'] = 'localhost:1025';
    // DDEV DB Local settings
    $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default'] = array_merge($GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default'], [
        'dbname' => 'db',
        'host' => 'db',
        'password' => 'db',
        'port' => '3306',
        'user' => 'db',
    ]);

}

/**
 *  Development/Testing
 */
if (\TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->isDevelopment() && \TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->__toString() === 'Development/Testing') {
    $GLOBALS['TYPO3_CONF_VARS']['BE']['interfaces'] = 'backend,frontend'; // Backend Login options

}

/**
 *  Development/Testing || Production/*
 */
if ((\TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->isDevelopment() && \TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->__toString() === 'Development/Testing') ||
    (\TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->isProduction())) {
    // MAIL
    $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress'] = getenv('TYPO3__MAIL__defaultMailFromAddress');
    $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromName'] = getenv('TYPO3__MAIL__defaultMailFromName');
    $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport'] = getenv('TYPO3__MAIL__transport');
    $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_sendmail_command'] = getenv('TYPO3__MAIL__transport_sendmail_command');
    $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_smtp_encrypt'] = getenv('TYPO3__MAIL__transport_smtp_encrypt');
    $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_smtp_password'] = getenv('TYPO3__MAIL__transport_smtp_password');
    $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_smtp_server'] = getenv('TYPO3__MAIL__transport_smtp_server');
    $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_smtp_username'] = getenv('TYPO3__MAIL__transport_smtp_username');
}

/**
 *  Production/Live
 */
if (\TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->isProduction() && \TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->__toString() === 'Production/Live') {

}

/**
 *  Production/Debug
 */
if (\TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->isProduction() && \TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->__toString() === 'Production/Debug') {
    // BE
    $GLOBALS['TYPO3_CONF_VARS']['BE']['adminOnly'] = -1; // 1: Only admins can login //  -1: total shutdown
    // SYS
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] = '*'; // Ip Masking for security, * allows all
}
