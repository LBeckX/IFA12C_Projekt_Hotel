<?php

/**
 * The Class for the mySql-Table [Zimmer]
 * @author Lukas Beck
 * @link https://github.com/lbeckx
 * @version 1.0.170130
 * Class sqlZimmer
 */
class sqlZimmer{

    /**
     * The name of the table
     * @var string
     */
	private $tableName = 'zimmer';

    /**
     * Check id the mysqli-object exists and call the createTable()-function
     * sqlZimmer constructor.
     */
	function __construct() {
		if(!isset($GLOBALS['mysql'])){
			init();
		}
		$this->createTable();
	}

    /**
     * Create the table [$this->tableName] if the table do not exists
     * @return bool|string
     */
   public function createTable(){
	   if ($result = $GLOBALS['mysql']->query("SHOW TABLES LIKE '".$this->tableName."'")) {
			if($result->num_rows != 1) {
				return $this->create();
			} else {
				return "Tabelle existiert!";
			}
		} else {
	       return false;
       }
   }

    /**
     * Return value from table by id
     * if $id = 'all' it will return all from table.
     * @param string $id
     * @return array|bool
     */
   public function selectAllFromTableById($id = 'all'){
	   $sql = 'SELECT * FROM `'.$this->tableName.'` WHERE `'.$this->tableName.'ID` = '.$id;
	   
	   if($id == 'all'){
		   $sql = 'SELECT * FROM `'.$this->tableName.'`';
	   }
	   
	   $result = $GLOBALS['mysql']->query($sql);
	   
		if ($result->num_rows > 0) {
			$returnData = [];
			while($row = $result->fetch_assoc()) {
				array_push($returnData,$row);
			}
			return $returnData;
		} else {
			return false;
		}
   }

    /**
     * Return value from table by hotelid
     * if $hotelid = 'all' it will return all from table.
     * Erstellt von Joachim Hacker am 31.01.17
     * @param string $hotelid
     * @return array|bool
     */
   public function selectAllFromTableByHotelId($hotelid = 'all'){
	   $sql = 'SELECT * FROM `'.$this->tableName.'` WHERE `hotelID` = \''.$hotelid.'\'';
	   
	   if($hotelid == 'all'){
		   $sql = 'SELECT * FROM `'.$this->tableName.'`';
	   }
	   
	   $result = $GLOBALS['mysql']->query($sql);
	   
		if ($result != False) {
			$returnData = [];
			while($row = $result->fetch_assoc()) {
				array_push($returnData,$row);
			}
			return $returnData;
		} else {
			return false;
		}
   }

    /**
     * Insert a new entry into the database [$this->tableName]
     * @param $zimmernummer
     * @param $hotelID
     * @param $preisID
     * @return bool
     */
   public function insertIntoTable($zimmernummer,$hotelID,$preisID){
	   $sql = "INSERT INTO ".$this->tableName." (
			zimmernummer,
			hotelID,
			preisID
		) VALUES (
			'$zimmernummer',
			'$hotelID',
			'$preisID'
		);";
	   
	   if ($GLOBALS['mysql']->query($sql) === TRUE) {
			return true;
		} else {
			echo "Error insert into database: " . $GLOBALS['mysql']->error;
			return false;
		}
   }

    /**
     * Delete a single entry from database by id
     * @param $id
     * @return bool
     */
   public function deleteFromTableById($id){
	   $sql = "DELETE FROM ".$this->tableName." WHERE ".$this->tableName."ID = $id";
	   if ($GLOBALS['mysql']->query($sql) === TRUE) {
			return true;
		} else {
			echo "Error creating database: " . $GLOBALS['mysql']->error;
			return false;
		}
   }

    /**
     * Create the Table [$this->tableName]
     * @return bool
     */
   private function create(){
	   $sql = 'CREATE TABLE `'.$this->tableName.'` (
				'.$this->tableName.'ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				zimmernummer VARCHAR(10) NOT NULL,
				hotelID INT(6),
				preisID INT(6)
				)';
				
		if ($GLOBALS['mysql']->query($sql) === TRUE) {
			return true;
		} else {
			echo "Error creating database: " . $GLOBALS['mysql']->error;
			return false;
		}
   }

}