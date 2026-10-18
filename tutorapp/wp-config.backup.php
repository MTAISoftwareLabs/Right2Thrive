<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php automatically created by "wp-config.php Editor"
 * made by Ehsaan
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * Changed settings
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 * @author Ehsaan <iehsan.ir@gmail.com>
 *
 * @package WordPress
 */
	

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'careerp_wp3' );

/** MySQL database username */
define( 'DB_USER', 'careerp_wp3' );

/** MySQL database password */
define( 'DB_PASSWORD', 'P)yoPY6o@E78[(6' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'WP_DEBUG', false );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'yxvUsuYWGyNEtwAkJyyc0aqzgfQLFz0BPWNhRgPHG3JkR3gNsgTdTcgdwu5zDC8A');
define('SECURE_AUTH_KEY',  '70VsnRbD90dZicJPusU3dUT9jdZVp0EATy2bemQWyLnUJIwajhHuw2w91JXi5nDP');
define('LOGGED_IN_KEY',    'BL4D6eFiOTkVBF3iAcjXlhry961Y2RcIpZ6WccDqjQeIRS1GZWHBSTczHDEWM9Kb');
define('NONCE_KEY',        'j52mwD1oU0Y6W3Mjgm3PRbHPLQ2MAkTSVlhhiTKNpC1Svx2tWurGxb0eWrpj4ugn');
define('AUTH_SALT',        'pD7OnhEjTKNC7xHxiQaV9L8O226DiOncdZZQfBuaNwzvMq11rDUfgqxQJoUoaKiA');
define('SECURE_AUTH_SALT', 'GjWztv0meJ4B31VCbyOj26v9rtW2TnS3w4Hxp0LuMZy84I3ITX9qVmRst5UDNLD1');
define('LOGGED_IN_SALT',   'gT9LBo9OoH7rnOzmXnQHLhQqo0pRCCKrtmG1Ru56QWcmLChI7xGwxmzSgb3010D1');
define('NONCE_SALT',       'DFHXblOQkU75eQY1xFE8iDGlHE17DwAeujfJwOsplLMYDf3xXHnRoQNIFYqg4VCm');

/**#@-*/


define( 'WP_DEBUG_DISPLAY', false );
define( 'FS_METHOD', 'direct' );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
