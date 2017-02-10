<?php
/**
* Erstellt von Lukas Beck am 30.01.2017
*/

/**
 * The Class for the mySql-Table [preise]
 * @author Lukas Beck
 * @link https://github.com/lbeckx
 * @version 1.0.170130
 * Class sqlPreise
 */
class sqlPreise{

    /**
     * The name of the Table
     * @var string
     */
	private $tableName = 'preise';

    /**
     * Check id the mysqli-object exists and call the createTable()-function
     * sqlPreise constructor.
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
     * Insert a new entry into the database [$this->tableName]
     * @param $kategorie
     * @param $zimmerart
     * @param $preise
     * @return bool
     */
   public function insertIntoTable($kategorie,$zimmerart,$preise){
	   $sql = "INSERT INTO ".$this->tableName." (
			kategorie,
			zimmerart,
			preise
		) VALUES (
			'$kategorie',
			'$zimmerart',
			'$preise'
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
				kategorie VARCHAR(20) NOT NULL,
				zimmerart VARCHAR(20) NOT NULL,
				preise VARCHAR(10) NOT NULL
				)';
				
		if ($GLOBALS['mysql']->query($sql) === TRUE) {
			return true;
		} else {
			echo "Error creating database: " . $GLOBALS['mysql']->error;
			return false;
		}
   }

}