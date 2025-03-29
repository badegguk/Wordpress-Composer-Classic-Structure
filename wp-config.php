<?php

require_once  dirname( __FILE__ ) . '/vendor/autoload.php';

use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Symfony\Component\ErrorHandler\DebugClassLoader;
use Roots\WPConfig\Config;
use Dotenv\Dotenv;

/**
 * The base configuration for WordPress
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// initialize
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Enable WP_DEBUG mode
Config::define('WP_DEBUG', $_ENV['WP_DEBUG']);

// Symfony Debug.
if ( defined('WP_DEBUG') &&  true === WP_DEBUG ) :
	Debug::enable();
endif;

/**
 * Debugging Settings
 */
if ( defined('WP_DEBUG') && false === WP_DEBUG ) :

	Config::define('WP_DEBUG_DISPLAY', false);
	Config::define('WP_DEBUG_LOG', false);
	Config::define('SCRIPT_DEBUG', false);
	ini_set('display_errors', '0');

elseif ( defined('WP_DEBUG') &&  true === WP_DEBUG ) :

   Config::define('SAVEQUERIES', true);
   Config::define('WP_DEBUG_DISPLAY', true);
   Config::define('WP_DISABLE_FATAL_ERROR_HANDLER', true);
   Config::define('SCRIPT_DEBUG', true);
   Config::define('WP_DEBUG_LOG', dirname( __FILE__ ) . '/tmp/wp-errors.log' );
   ini_set('display_errors', '1');

endif;

/**
 * URLs
 */
Config::define('WP_HOME', $_ENV['WP_HOME'] );
Config::define('WP_SITEURL', $_ENV['WP_SITEURL'] );


/**
 * DB settings
 */
Config::define('DB_NAME', $_ENV['DB_NAME'] );
Config::define('DB_USER', $_ENV['DB_USER'] );
Config::define('DB_PASSWORD', $_ENV['DB_PASSWORD'] );
Config::define('DB_HOST', $_ENV['DB_HOST'] ?: 'localhost');
Config::define('DB_CHARSET', 'utf8');
Config::define('DB_COLLATE', '');
$table_prefix = $_ENV['DB_PREFIX'];

/**
 * Authentication Unique Keys and Salts
 */
Config::define('AUTH_KEY', $_ENV['AUTH_KEY'] );
Config::define('SECURE_AUTH_KEY', $_ENV['SECURE_AUTH_KEY'] );
Config::define('LOGGED_IN_KEY', $_ENV['LOGGED_IN_KEY'] );
Config::define('NONCE_KEY', $_ENV['NONCE_KEY'] );
Config::define('AUTH_SALT', $_ENV['AUTH_SALT'] );
Config::define('SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT'] );
Config::define('LOGGED_IN_SALT', $_ENV['LOGGED_IN_SALT'] );
Config::define('NONCE_SALT', $_ENV['NONCE_SALT'] );


/* Change WP_MEMORY_LIMIT to increase the memory limit for public pages. */
Config::define('WP_MEMORY_LIMIT', $_ENV['MEMORY_LIMIT'] );

/* Uncomment and change WP_MAX_MEMORY_LIMIT to increase the memory limit for admin pages. */
Config::define('WP_MAX_MEMORY_LIMIT', $_ENV['MAX_MEMORY_LIMIT'] );

Config::apply();
define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
