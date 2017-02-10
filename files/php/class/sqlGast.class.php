<?php
/**
* Erstellt von Lukas Beck am 30.01.2017
*/

/**
 * The Class for the mySql-Table [gast]
 * @author Lukas Beck
 * @link https://github.com/lbeckx
 * @version 1.0.170130
 * Class sqlGast
 */
class sqlGast{

    /**
     * The name of the Table
     * @var string
     */
	private $tableName = 'gast';

    /**
     * Check id the mysqli-object exists and call the createTable()-function
     * sqlGast constructor.
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
     * Return value from table by id
     * if $id = 'all' it will return all from table.
     * @param string $email
     * @return array|bool
     */
    public function selectAllFromTableByEmail($email = 'all'){
        $sql = 'SELECT * FROM `'.$this->tableName.'` WHERE `email` = \''.$email.'\';';

        if($email == 'all'){
            $sql = 'SELECT * FROM `'.$this->tableName.'`';
        }

        $result = $GLOBALS['mysql']->query($sql);

        if ($result->num_rows > 0 && $result !== false) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    /**
     * Insert a new entry into the database [$this->tableName]
     * @param $nachname
     * @param $vorname
     * @param $geschlecht
     * @param $geburtsdatum
     * @param $stammgast
     * @param $strasse
     * @param $plz
     * @param $ort
     * @return bool
     */
   public function insertIntoTable($nachname,$vorname,$geschlecht,$geburtsdatum,$stammgast,$strasse,$plz,$ort,$email){
	   $sql = "INSERT INTO ".$this->tableName." (
			nachname,
			vorname,
			geschlecht,
			geburtsdatum,
			stammgast,
			strasse,
			plz,
			ort,
			email
		) VALUES (
			'$nachname',
			'$vorname',
			'$geschlecht',
			'$geburtsdatum',
			'$stammgast',
			'$strasse',
			'$plz',
			'$ort',
			'$email'
		);";
	   
	   if ($GLOBALS['mysql']->query($sql) === TRUE) {
			return true;
		} else {
			echo "Error insert into database: " . $GLOBALS['mysql']->error;
            return false;
		}
   }

    /**
     * Erhöt den Wert Stammgast aus der Datenbank um 1
     * @param $email
     * @return bool
     */
   public function updateStammgastByEmail($email){
        $sql = "UPDATE ".$this->tableName." SET stammgast = stammgast + 1 WHERE `email` = '$email'";

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
				nachname VARCHAR(40) NOT NULL,
				vorname VARCHAR(40) NOT NULL,
				geschlecht VARCHAR(20) NOT NULL,
				geburtsdatum INT(12),
				stammgast INT(10),
				strasse VARCHAR(200) NOT NULL,
				plz VARCHAR(30) NOT NULL,
				ort VARCHAR(100) NOT NULL,
				email VARCHAR(30) NOT NULL
				)';
				
		if ($GLOBALS['mysql']->query($sql) === TRUE) {
			return true;
		} else {
			echo "Error creating database: " . $GLOBALS['mysql']->error;
			return false;
		}
   }
}