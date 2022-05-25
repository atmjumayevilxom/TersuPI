<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'tersupi1_wp971' );

/** Database username */
define( 'DB_USER', 'tersupi1_wp971' );

/** Database password */
define( 'DB_PASSWORD', 'p68(4!6Sd7' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'xamy1t9m1ojsxtz95yvk7jysijjdof9y7qp3ssyvqrva3mqmumqtfy62qcfbhyke' );
define( 'SECURE_AUTH_KEY',  'ey86bqg5v5n1vxsqf8vjg8k0l8h6zvqpm0ycnrva1ei6qeapy9itifhuavw1jcgy' );
define( 'LOGGED_IN_KEY',    'smn9mznptefiz6ycfoe9eu2ffdjqq3b1boxrm3jgmokmukbhshwmqp8dbo82hlw0' );
define( 'NONCE_KEY',        'qq31bp4cg72le1ykarvxujemdvctlac4bab2mzoqs8ls0ow3q81wqkq9srgfumzy' );
define( 'AUTH_SALT',        'xeyuwctb0dizdaqby6fmjcv8korwmdn0jkiswkv0nzp1hpwg17wiee0ha8nvrtke' );
define( 'SECURE_AUTH_SALT', 'cviizharb9hmwxvmirnhonupzjbqgngdbaycjxuuco8zelyi7socifxxdurywctm' );
define( 'LOGGED_IN_SALT',   'tkmbopien0ahgujhegrifmn1kfqiscymnsztywexojjgkpkbxtudspfastn6sqgx' );
define( 'NONCE_SALT',       'pub6lnjn7fxmkmrvieennjbubhznuhixxczzy9bmr9ndh7iwzqbz8pkrduxj6bae' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpfv_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
