# CI_ACCESSO
Is a application based on [Codeigniter framework](https://github.com/bcit-ci/CodeIgniter) and MS-SQL server who is connected to [Johnson Controls P2000](http://www.johnsoncontrols.com/es_mx/buildings/security-and-fire-safety/access-controls) system database for access events requests from it

## Features
+ LDAP authentication
+ Last access with auto update
+ Request access events by cardholder (user) and terminal (door)
+ Request access events by terminal and date range
+ Request by schedule
+ Request access allowed to terminal
+ Automatic updates time setting

## Requirements
+ PHP
+ Node.js (for download task packages)
+ Bower (for UI packages)
+ Gulp (task generator)

## Developer Installation
Install node modules:
Using [npm](https://www.npmjs.com/):

    $ npm install 

Using [bower](https://www.npmjs.com/):

    $ bower install 

When edit a javascript or stylesheet file need to run gulp task to create distribution out content:

    $ gulp scripts //javascripts files
    $ gulp styles //css files
    $ gulp //For both
    
## Producction Configuration
Edit base URL on application/config/config.php:
```PHP
  $config['base_url'] = 'YOUR BASE URL HERE';
```

Edit the database configuration:
```PHP
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'HOSTNAME',
	'username' => 'USER',
	'password' => 'PASSWORD',
	'database' => 'DATABASE',
	'dbdriver' => 'sqlsrv',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => TRUE,//(ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['control'] = array(
	'dsn'	=> '',
	'hostname' => 'HOSTNAME',
	'username' => 'USER',
	'password' => 'PASSWORD',
	'database' => 'DATABASE',
	'dbdriver' => 'sqlsrv',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => TRUE,//(ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
```