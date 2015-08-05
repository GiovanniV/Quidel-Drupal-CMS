<?php

// Chef-populated constants
define('PANTHEON_INFRASTRUCTURE_ENVIRONMENT', 'live');
define('PANTHEON_SITE', 'a38aa888-60c6-4b7e-8cd2-876e865d9d76');
define('PANTHEON_ENVIRONMENT', 'dev');
define('PANTHEON_BINDING', '65b286e9477b44dba4175343839649db');
define('PANTHEON_BINDING_UID_NUMBER', '14335');

define('PANTHEON_DATABASE_HOST', '10.178.5.15');
define('PANTHEON_DATABASE_PORT', '13089');
define('PANTHEON_DATABASE_USERNAME', '');
define('PANTHEON_DATABASE_PASSWORD', '');
define('PANTHEON_DATABASE_DATABASE', '');
define('PANTHEON_DATABASE_BINDING', 'd228b60b3b504ae5b781bfa83c5a50ee');

define('PANTHEON_REDIS_HOST', '');
define('PANTHEON_REDIS_PORT', '');
define('PANTHEON_REDIS_PASSWORD', '');
define('PANTHEON_VALHALLA_HOST', 'valhalla2.cluster.panth.io');


// System paths
putenv('PATH=/usr/local/bin:/bin:/usr/bin:/srv/bin');

// Legacy Drupal Settings Block
$_SERVER['PRESSFLOW_SETTINGS'] = '{"conf":{"pressflow_smart_start":true,"pantheon_binding":"65b286e9477b44dba4175343839649db","pantheon_site_uuid":"a38aa888-60c6-4b7e-8cd2-876e865d9d76","pantheon_environment":"dev","pantheon_tier":"live","pantheon_index_host":"index.live.getpantheon.com","pantheon_index_port":449,"redis_client_host":null,"redis_client_port":null,"redis_client_password":null,"file_public_path":"sites/default/files","file_private_path":"sites/default/files/private","file_directory_path":"sites/default/files","file_temporary_path":"/srv/bindings/65b286e9477b44dba4175343839649db/tmp","file_directory_temp":"/srv/bindings/65b286e9477b44dba4175343839649db/tmp","css_gzip_compression":false,"js_gzip_compression":false,"page_compression":false},"databases":{"default":{"default":{"host":"10.178.5.15","port":13089,"username":"pantheon","password":"799e525a329f4c31a5b5cad50ce877bf","database":"pantheon","driver":"mysql"}}},"drupal_hash_salt":"e3e1cb9a6a15848e9c6c796c108d34e3b7ceb35eee41e4ec39f2f1d6ca9d21b5","config_directory_name":"config"}';

// Modern Dotenv.php settings loading
include_once('/srv/includes/Dotenv.php');
Dotenv::load('/srv/bindings/'. PANTHEON_BINDING);

/**
 * These $_SERVER variables are often used for redirects in code that is read
 * directly (e.g. settings.php) so we can't have them visible to the CLI lest
 * CLI processes might hit a redirect (e.g. header() and exit()) and die.
 *
 * CLI tools are encouraged to use getenv() or $_ENV going forward to read
 * environment configuration.
 */
if (isset($_SERVER['GATEWAY_INTERFACE'])) {
  $_SERVER['PANTHEON_ENVIRONMENT'] = 'dev';
  $_SERVER['PANTHEON_SITE'] = 'a38aa888-60c6-4b7e-8cd2-876e865d9d76';
}
else {
  unset($_SERVER['PANTHEON_ENVIRONMENT']);
  unset($_SERVER['PANTHEON_SITE']);
}

require '/srv/includes/pantheon.php';
initialize_pantheon();
