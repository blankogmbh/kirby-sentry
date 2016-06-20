<?php
if ($sentryDsn = c::get('sentry.dsn', false)) {
    require_once __DIR__ . '/sentry-php/lib/Raven/Autoloader.php';
    Raven_Autoloader::register();

    $client = new Raven_Client($sentryDsn);

    $error_handler = new Raven_ErrorHandler($client);
    $error_handler->registerExceptionHandler();
    $error_handler->registerErrorHandler();
    $error_handler->registerShutdownFunction();
} else {
    trigger_error('Sentry DSN not defined', E_USER_NOTICE);
}
