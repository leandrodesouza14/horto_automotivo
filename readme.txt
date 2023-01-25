// Database Mysql

dbname = horto_automotivo
tables = carros, colaborador
charset = utf8_unicode_ci
store_engine = InnoDB

// Table's Structure

-> carros:

	- id (int 11) not null auto_increment
	- montadora (varchar 255) not null
	- modelo (varchar 255) not null
	- ano (year 4) not null
	- motorizacao (varchar 255) not null
	- chassis (varchar 255) null
	- observacao (varchar 255) null
	- grupo (varchar 255) null
	- historico (varchar 255) null

-> colaborador:

	- id (int 11) not null auto_increment
	- nome (varchar 255) not null
	- cargo (varchar 255) not null
	- email (varchar 255) not null
	- registro (int 11) not nulll

// Bloq SQL Injection

mysqli_scape_string - All Inputs

// Bloq XSS Injection

htmlspecialchars - All Inputs

// PHP.ini

session.use_strict_mode=1
session.use_trans_sid=0
session.use_only_cookies=1



