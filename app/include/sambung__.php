<?php //localhost

class DB{

	/*private static $db_server 	= '192.168.1.4:3306';
	private static $db_port 	= '3306';
	private static $db_database = 'tokosahabat';
	private static $db_user 	= 'kasir3';
	private static $db_password	= '1qaz2wsx';*/
	
	private static $db_server 	= 'localhost';
	private static $db_port 	= '3306';
	private static $db_database = 'sekolahsma3_1';
	private static $db_user 	= 'root';
	private static $db_password	= '';
	
	private static $dbpdo = null;

	public static function create(){
		if(self::$dbpdo == null){
			try{
				//self::$dbpdo = new PDO("mysql:server=".$db_server.";port=".$db_port.";dbname=".self::$db_database.";", self::$db_user, self::$db_password);
				
				//$dbh = new PDO('mysql:host=hotsname;port=3309;dbname=dbname', 'root', 'root');
				
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



class DB_ADT{

	##audit trail
	private static $db_server_adt 	= 'localhost';
	private static $db_port_adt 	= '3306';
	private static $db_database_adt = 'sekolahsma3_adt';
	private static $db_user_adt 	= 'root';
	private static $db_password_adt	= '';
	
	private static $dbpdo_adt = null;

	public static function create_adt(){
		if(self::$dbpdo_adt == null){
			try{
				self::$dbpdo_adt = new PDO("mysql:server=".self::$db_server_adt.";dbname=".self::$db_database_adt.";", self::$db_user_adt, self::$db_password_adt);
				
				self::$dbpdo_adt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		return self::$dbpdo_adt;
	}
	
	
	
	public static $db_adt = null;
	public static function get_db_adt(){
		
		self::$db_adt = "sekolahsma3_adt";
		
		return self::$db_adt;
	}
	
		
}

?>