<?php

//SQL JOIN

class CDataBase
{
    private $server = 'localhost';

    private $user = 'id16822291_admin';
    private $pass = '228228228-Db';
    private $db = 'id16822291_cars';
    //private $user = 'mysql';
    //private $pass = 'mysql';
    //private $db = 'Cars';
    private $mysqli = null; //Готовое подключение

    function __construct()
    {
        $connect = new mysqli($this->server, $this->user, $this->pass, $this->db);

        if (!empty($connect->connect_errno)) {
            die('Error: Data base connect error (' . $connect->connect_errno . ') ' . $connect->connect_error);
        }

        $this->mysqli = $connect;
    }

    public function selectAll($tableName, $Sort)
    {
        if($Sort == 0){
            $sqlQuery = 'SELECT * FROM ' . $tableName;
        }
        else if($Sort == 1){
            $sqlQuery = 'SELECT * FROM '.$tableName.' ORDER BY `Name` ASC';
        }
        else if($Sort == 2){
            $sqlQuery = 'SELECT * FROM '.$tableName.' ORDER BY `Name` DESC';
        }
        else if($Sort == 3){
            $sqlQuery = 'SELECT * FROM '.$tableName.' ORDER BY `RequiredCar` ASC';
        }
        else if($Sort == 4){
            $sqlQuery = 'SELECT * FROM '.$tableName.' ORDER BY `Time` ASC';
        }
        else if($Sort == 5){
            $sqlQuery = 'SELECT * FROM '.$tableName.' ORDER BY `Time` DESC';
        }

        $obj = $this->mysqli->query($sqlQuery);

        if (!empty($this->mysqli->error_list)) {
            die('Error: Data base error (' . $this->mysqli->errno . ') ' . $this->mysqli->error);
        }

        $result = array();
        while ($row = $obj->fetch_assoc()) {
            $result[] = $row;
        };

        return $result;
    }

   public function selectLine($tableName, $whereFieldName = '', $whereVal = '')
   {
        $sqlQuery = 'SELECT * FROM ' . $tableName;
        if (!empty($whereFieldName) && !empty($whereVal)) {
            $sqlQuery .= ' WHERE ' . $whereFieldName . ' = "' . $whereVal . '"';
        }
        $obj = $this->mysqli->query($sqlQuery);
        if (!empty($this->mysqli->error_list)) {
            die('Error: Data base error (' . $this->mysqli->errno . ') ' . $this->mysqli->error);
        }
       return $obj->fetch_assoc();
    }

    public function Insert($tableName, $Name, $RequiredCar, $ContactNumber)
    {
        $sqlQuery = 'INSERT INTO ' . $tableName . ' (Name, RequiredCar, ContactNumber) VALUES ("' . $Name . '", "' . $RequiredCar . '", "' . $ContactNumber .'")';
        $this->mysqli->query($sqlQuery);
        // `car_order` (`ID`, `Name`, `Contact number`, `Required car`) VALUES ('1', 'Alisa Eotova', '88005553535', 'Trueno'), ('2', 'Ivan Govnov', '882281488', 'lancer 10');
        if (!empty($this->mysqli->error_list)) {
            die('Error: Data base error (' . $this->mysqli->errno . ') ' . $this->mysqli->error);
        }
    }

    public function InsertTimeInCarsTime()
    {
        $sqlQuery = 'SELECT MAX(`ID`) FROM `car_order`';
        $obj = $this->mysqli->query($sqlQuery);
        $row = $obj->fetch_assoc();
        $ID = $row["MAX(`ID`)"];
        $sqlQuery = 'INSERT INTO `car_order_times` (`ID_co`, `Time`) SELECT `ID`, `Time` FROM `car_order` WHERE  `ID` = "'.$ID.'"';
        $this->mysqli->query($sqlQuery);
        if (!empty($this->mysqli->error_list)) {
            die('Error: Data base error (' . $this->mysqli->errno . ') ' . $this->mysqli->error);
        }
    }

    public function Delete($tableName, $ID)
    {
        $sqlQuery = 'DELETE FROM ' . $tableName . ' WHERE `ID` = ' . $ID;
        $this->mysqli->query($sqlQuery);
        if (!empty($this->mysqli->error_list)) {
            die('Error: Data base error (' . $this->mysqli->errno . ') ' . $this->mysqli->error);
        }
    }

    public function DeleteWithKey($tableName, $tableLinkName, $ID)
    {
        $sqlQuery = 'DELETE FROM ' . $tableLinkName . ' WHERE `ID_co` = ' . $ID;
        $this->mysqli->query($sqlQuery);
        if (!empty($this->mysqli->error_list)) {
            die('Error: Data base error (' . $this->mysqli->errno . ') ' . $this->mysqli->error);
        }
        $sqlQuery = 'DELETE FROM ' . $tableName . ' WHERE `car_order`.`ID` = ' . $ID;
        $this->mysqli->query($sqlQuery);
        if (!empty($this->mysqli->error_list)) {
            die('Error: Data base error (' . $this->mysqli->errno . ') ' . $this->mysqli->error);
        }
    }

    public function Sort($tableName, $Sort)
    {
        $sqlQuery = 'SELECT * FROM '.$tableName.' ORDER BY `Name` ASC';
        $this->mysqli->query($sqlQuery);
        // `car_order` (`ID`, `Name`, `Contact number`, `Required car`) VALUES ('1', 'Alisa Eotova', '88005553535', 'Trueno'), ('2', 'Ivan Govnov', '882281488', 'lancer 10');
        if (!empty($this->mysqli->error_list)) {
            die('Error: Data base error (' . $this->mysqli->errno . ') ' . $this->mysqli->error);
        }
    }

}
