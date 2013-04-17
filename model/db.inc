<?php
/*
 *  Copyright (C) 2012
 *     Ed Rackham (http://github.com/a1phanumeric/PHP-MySQL-Class)
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// MySQL Class v0.8
class MySQL {

	// Base variables
	var $lastError;					// Holds the last error
	var $lastQuery;					// Holds the last query
	var $result;						// Holds the MySQL query result
	var $records;						// Holds the total number of records returned
	var $affected;					// Holds the total number of records affected
	var $rawResults;				// Holds raw 'arrayed' results
	var $arrayedResult;			// Holds an array of the result

	var $hostname;	// MySQL Hostname
	var $username;	// MySQL Username
	var $password;	// MySQL Password
	var $database;	// MySQL Database

	var $databaseLink;		// Database Connection Link



	/* *******************
	 * Class Constructor *
	 * *******************/

	function MySQL($database, $username, $password, $hostname='localhost'){
		$this->database = $database;
		$this->username = $username;
		$this->password = $password;
		$this->hostname = $hostname;

		$this->Connect();
	}



	/* *******************
	 * Private Functions *
	 * *******************/

	// Connects class to database
	// $persistant (boolean) - Use persistant connection?
	private function Connect($persistant = false){
		if($this->databaseLink){
			mysql_close($this->databaseLink);
		}

		if($persistant){
			$this->databaseLink = mysql_pconnect($this->hostname, $this->username, $this->password);
		}else{
			$this->databaseLink = mysql_connect($this->hostname, $this->username, $this->password);
		}

		if(!$this->databaseLink){
   		$this->lastError = 'Could not connect to server: ' . mysql_error($this->databaseLink);
			return false;
		}

		if(!$this->UseDB()){
			$this->lastError = 'Could not connect to database: ' . mysql_error($this->databaseLink);
			return false;
		}
		return true;
	}


	// Select database to use
	private function UseDB(){
		if(!mysql_select_db($this->database, $this->databaseLink)){
			$this->lastError = 'Cannot select database: ' . mysql_error($this->databaseLink);
			return false;
		}else{
			return true;
		}
	}


	// Performs a 'mysql_real_escape_string' on the entire array/string
	private function SecureData($data){
		if(is_array($data)){
			foreach($data as $key=>$val){
				if(!is_array($data[$key])){
					$data[$key] = mysql_real_escape_string($data[$key], $this->databaseLink);
				}
			}
		}else{
			$data = mysql_real_escape_string($data, $this->databaseLink);
		}
		return $data;
	}



	/* ******************
	 * Public Functions *
	 * ******************/

	// Executes MySQL query
	function ExecuteSQL($query){
		$this->lastQuery 	= $query;
		if($this->result 	= mysql_query($query, $this->databaseLink)){
			$this->records 	= @mysql_num_rows($this->result);
			$this->affected	= @mysql_affected_rows($this->databaseLink);

			if($this->records > 0){
				$this->ArrayResults();
				return $this->arrayedResult;
			}else{
				return true;
			}

		}else{
			$this->lastError = mysql_error($this->databaseLink);
			return false;
		}
	}


	// Adds a record to the database based on the array key names
	function Insert($vars, $table, $exclude = ''){

		// Catch Exclusions
		if($exclude == ''){
			$exclude = array();
		}

		array_push($exclude, 'MAX_FILE_SIZE'); // Automatically exclude this one

		// Prepare Variables
		$vars = $this->SecureData($vars);

		$query = "INSERT INTO `{$table}` SET ";
		foreach($vars as $key=>$value){
			if(in_array($key, $exclude)){
				continue;
			}
			//$query .= '`' . $key . '` = "' . $value . '", ';
			$query .= "`{$key}` = '{$value}', ";
		}

		$query = substr($query, 0, -2);

		return $this->ExecuteSQL($query);
	}

	// Deletes a record from the database
	function Delete($table, $where='', $limit='', $like=false){
		$query = "DELETE FROM `{$table}` WHERE ";
		if(is_array($where) && $where != ''){
			// Prepare Variables
			$where = $this->SecureData($where);

			foreach($where as $key=>$value){
				if($like){
					//$query .= '`' . $key . '` LIKE "%' . $value . '%" AND ';
					$query .= "`{$key}` LIKE '%{$value}%' AND ";
				}else{
					//$query .= '`' . $key . '` = "' . $value . '" AND ';
					$query .= "`{$key}` = '{$value}' AND ";
				}
			}

			$query = substr($query, 0, -5);
		}

		if($limit != ''){
			$query .= ' LIMIT ' . $limit;
		}

		return $this->ExecuteSQL($query);
	}


	// Gets a single row from $from where $where is true
	function Select($from, $where='', $orderBy='', $limit='', $like=false, $operand='AND'){
		// Catch Exceptions
		if(trim($from) == ''){
			return false;
		}

		$query = "SELECT * FROM `{$from}` WHERE ";

		if(is_array($where) && $where != ''){
			// Prepare Variables
			$where = $this->SecureData($where);

			foreach($where as $key=>$value){
				if($like){
					//$query .= '`' . $key . '` LIKE "%' . $value . '%" ' . $operand . ' ';
					$query .= "`{$key}` LIKE '%{$value}%' {$operand} ";
				}else{
					//$query .= '`' . $key . '` = "' . $value . '" ' . $operand . ' ';
					$query .= "`{$key}` = '{$value}' {$operand} ";
				}
			}

			$query = substr($query, 0, -5);

		}else{
			$query = substr($query, 0, -7);
		}

		if($orderBy != ''){
			$query .= ' ORDER BY ' . $orderBy;
		}

		if($limit != ''){
			$query .= ' LIMIT ' . $limit;
		}

		return $this->ExecuteSQL($query);

	}

	// Updates a record in the database based on WHERE
	function Update($table, $set, $where, $exclude = ''){
		// Catch Exceptions
		if(trim($table) == '' || !is_array($set) || !is_array($where)){
			return false;
		}
		if($exclude == ''){
			$exclude = array();
		}

		array_push($exclude, 'MAX_FILE_SIZE'); // Automatically exclude this one

		$set 		= $this->SecureData($set);
		$where 	= $this->SecureData($where);

		// SET

		$query = "UPDATE `{$table}` SET ";

		foreach($set as $key=>$value){
			if(in_array($key, $exclude)){
				continue;
			}
			$query .= "`{$key}` = '{$value}', ";
		}

		$query = substr($query, 0, -2);

		// WHERE

		$query .= ' WHERE ';

		foreach($where as $key=>$value){
			$query .= "`{$key}` = '{$value}' AND ";
		}

		$query = substr($query, 0, -5);

		return $this->ExecuteSQL($query);
	}

	// 'Arrays' a single result
	function ArrayResult(){
		$this->arrayedResult = mysql_fetch_assoc($this->result) or die (mysql_error($this->databaseLink));
		return $this->arrayedResult;
	}

	// 'Arrays' multiple result
	function ArrayResults(){

		if($this->records == 1){
			return $this->ArrayResult();
		}

		$this->arrayedResult = array();
		while ($data = mysql_fetch_assoc($this->result)){
			$this->arrayedResult[] = $data;
		}
		return $this->arrayedResult;
	}

	// 'Arrays' multiple results with a key
	function ArrayResultsWithKey($key='id'){
		if(isset($this->arrayedResult)){
			unset($this->arrayedResult);
		}
		$this->arrayedResult = array();
		while($row = mysql_fetch_assoc($this->result)){
			foreach($row as $theKey => $theValue){
				$this->arrayedResult[$row[$key]][$theKey] = $theValue;
			}
		}
		return $this->arrayedResult;
	}
}

/*
usage
include_once('/path/to/class.MySQL.php');

$oMySQL = new MySQL(MYSQL_NAME, MYSQL_USER, MYSQL_PASS, [MYSQL_HOST]);
MYSQL_NAME The name of your database
MYSQL_USER Your username for the server / database
MYSQL_PASS Your password for the server / database
MYSQL_HOST The hostname of the MySQL server (*optional*, defaults to 'localhost')

$oMySQL = new MySQL('my_database','username','password');
$oMySQL->ExecuteSQL($query);
ExecuteSQL() will return an array of results, or a true (if an UPDATE or DELETE).

Insert($vars, $table, $exclude = '')
Delete($table, $where='', $limit='', $like=false)
Select($from, $where='', $orderBy='', $limit='', $like=false, $operand='AND')

Insert(), Delete(), Select()

$newUser = array('username' => 'Thrackhamator');
$oMySQL->Insert($newUser, 'admin');

print_r($oMySQL->Select('admin'));
return array;

db = test
user = test
pass = test123
host = localhost

mysql> grant all privileges on test.* to test@localhost identified by 'test123' with grant option;

create table cron_data (
id int(11) not null auto_increment,
site_code varchar(20) not null,
site varchar(200) not null,
read_date datetime not null,
primary key (`id`),
key `site_code` (`site_code`),
key `read_date` (`read_date`)
) engine=innodb charset=utf8 comment='batch log';


*/
/*
$db = new MySQL('test1', 'test1', 'test123', 'localhost');

$params = array(
    'site_code' => 'prog106',
    'site' => 'localhost',
    'read_date' => date('Y-m-d H:i:s'),
);
$db->Insert($params, 'cron_data');

$result = $db->Select('cron_data');
print_r($result);
*/
?>
