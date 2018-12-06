<?php

// This is the database connection configuration.
return array(
	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	
	'connectionString' => 'mysql:host=localhost;dbname=webmigra_osnap',
	'emulatePrepare' => true,
	'username' => 'webmigra_demo',
	'password' => 'Zxcv@1234',
	'charset' => 'utf8',
	
);