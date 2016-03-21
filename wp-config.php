<?php
/**
* The base configuration for WordPress
*
* The wp-config.php creation script uses this file during the
* installation. You don't have to use the web site, you can
* copy this file to "wp-config.php" and fill in the values.
*
* This file contains the following configurations:
*
* * MySQL settings
* * Secret keys
* * Database table prefix
* * ABSPATH
*
* @link https://codex.wordpress.org/Editing_wp-config.php
*
* @package WordPress
*/

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'quickstart_wp');

/** MySQL database username */
define('DB_USER', 'sa');

/** MySQL database password */
define('DB_PASSWORD', '123456');

/** MySQL hostname */
define('DB_HOST', '192.168.3.27');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
* Authentication Unique Keys and Salts.
*
* Change these to different unique phrases!
* You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
* You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
*
* @since 2.6.0
*/
define('AUTH_KEY', 'mVi4vMk9a1Gqx/vitvQWXVdX2/R3pST9Ca/Q3ckes9EhO1GkGNMQHcYRXyK/6yqF');
define('SECURE_AUTH_KEY', 'd4vVuT2apaR6rF3Tsl7XbsAMyTpidFtCntc7/m7ueeub/a+QK3qHgA7UUhCxWAoG');
define('LOGGED_IN_KEY', '1AfKP7aW0EnSnbUi0h3krqB4VyW1bvBS6d7rcm+n+PBW6K13dHe4p9iKPiVGvba0');
define('NONCE_KEY', 'ClFUTf+awWUlr2P3XoD7hLCWN4meLvv8LOxldgtS9HH8BZhXEqkvI/bD23cx9LOo');
define('AUTH_SALT', 'pBe0sjU611xSEa5JbJEAv5cTIKeFhLzdLK4BIU/16X0m8IJcF5r7UPTdU+bVOWKB');
define('SECURE_AUTH_SALT', '7qLauRStFvJ9arP0lNDiBfbCmpYs6jWQ+LQzVqqsxDqnuGLnTxKoHzEOT/A+s0X9');
define('LOGGED_IN_SALT', 'V+xp5aQq5NNsfnY5c6DBQzs/5SN/rKzAqFm5CgKIs4JeG4cx7dwk/uwPkXAUYeqm');
define('NONCE_SALT', 'FrqeszO2JiLMb3LgO69uanfY3wHJmByNegcWPF4qtGHtVwh7mw/VuSpmD3nSwFww');

/**#@-*/

/**
* WordPress Database Table prefix.
*
* You can have multiple installations in one database if you give each
* a unique prefix. Only numbers, letters, and underscores please!
*/
$table_prefix = 'wp_';

/**
* For developers: WordPress debugging mode.
*
* Change this to true to enable the display of notices during development.
* It is strongly recommended that plugin and theme developers use WP_DEBUG
* in their development environments.
*
* For information on other constants that can be used for debugging,
* visit the Codex.
*
* @link https://codex.wordpress.org/Debugging_in_WordPress
*/
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

