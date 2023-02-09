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
define( 'DB_NAME', 'mypress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'Anubis68' );

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
define( 'AUTH_KEY',         '7AK=`00%^%[kyvk-Lq`At7(Wl PHP;}`W1]0@!k*D!C_obr8aFcbttF<?lZu=51j' );
define( 'SECURE_AUTH_KEY',  'l*$g630:O?Mm4JVFj._ZwVV#uTe4$%VvG}P<`S%-1#L!kN3cwu2gbgAhdjG(1BV;' );
define( 'LOGGED_IN_KEY',    'ezh}.%jick{Wo]pWU]`O1?/SD3Y=xd2m?ot)u@[V:TF_Fih x~NEm;eOcu1#A@~g' );
define( 'NONCE_KEY',        '0AFrGZs)|E49}u(dA/E@P>8p9ylp]NzbI$YXn6dS|*n+1&}xJ-{pbfTBziJBpWqX' );
define( 'AUTH_SALT',        '#@rVcJoku*Eu?d*>mgwC%;V-2zc+w?dkZ:}74oF#U HiqpO(ZqfET`cFk.#qo+?f' );
define( 'SECURE_AUTH_SALT', 'XiyqE;L~n=T,RQqzAKk(_VU7<c=K{EHQuua]|>U~j7RDh0Bd?G16uYkvpqb$]))|' );
define( 'LOGGED_IN_SALT',   'G`LG6%OQF&oAUS(GHOKy5Kf;Olf&r~V`Fs5$v:2<eoXH6c0asB^S8Fu7}  6^sbK' );
define( 'NONCE_SALT',       '7B@T=_>M~F:&IM9Ll8!AP~aTn(;[$yX+;qw?iVxPN.a)*ek-42}#v;|6R+]<2eP_' );

/**#@-*/

/**
 * WordPress database table prefix.
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
