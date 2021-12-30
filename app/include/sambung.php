<?php //localhost

class DB{

/*
	private static $db_server 	= 'TRYG\SQLEXPRESS';
	private static $db_database = 'DUMMY_AM';
	private static $db_user 	= 'sa';
	private static $db_password	= 'admin';*/

/*	
	private static $db_server 	= 'rsn\SQL2008';
	private static $db_database = 'MABES';
	private static $db_user 	= 'sa';
	private static $db_password	= 'dot';
*/	

	private static $db_server 	= 'localhost';
	private static $db_database = 'dianglob_sekolah';
	private static $db_user 	= 'dianglob_sekolah';
	private static $db_password	= 'Suksespasti123';
	
	private static $dbpdo = null;

	public static function create(){
		if(self::$dbpdo == null){
			try{
				//self::$dbpdo = new PDO("sqlsrv:server=".self::$db_server.";database=".self::$db_database.";", self::$db_user, self::$db_password);
				
				self::$dbpdo = new PDO("mysql:server=".self::$db_server.";dbname=".self::$db_database.";", self::$db_user, self::$db_password);
				
				self::$dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		return self::$dbpdo;
	}
}