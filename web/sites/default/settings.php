<?php
$settings["config_sync_directory"] = "../config/sync";
$databases['default']['default'] = array (
  'database' => getenv('DRUPAL_DATABASE_URL'),
  'prefix' => '',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\sqlite',
  'driver' => 'sqlite',
);
$settings['hash_salt'] = getenv('DRUPAL_HASH_SALT');
