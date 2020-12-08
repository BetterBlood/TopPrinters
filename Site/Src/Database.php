<?php

/**
 * 
 * TODO : � compl�ter
 * 
 * Auteur : 
 * Date : 
 * Description :
 */

include "config.ini.php";

 class Database {


    // Variable de classe
    private $connector;

    /**
     * TODO: � compl�ter
     */
    public function __construct(){
        $user = $GLOBALS['MM_CONFIG']['database']['username'];
        $pass = $GLOBALS['MM_CONFIG']['database']['password'];
        $dbname = $GLOBALS['MM_CONFIG']['database']['dbname'];
        $host = $GLOBALS['MM_CONFIG']['database']['host'];
        $port = $GLOBALS['MM_CONFIG']['database']['port'];
        $charset = $GLOBALS['MM_CONFIG']['database']['charset'];
        try
        {
            $this->connector = new PDO('mysql:host='.$host.';port='.$port.';dbname='.$dbname.';charset='. $charset, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch(exception $e){
            echo "connexion impossible";
        }
        //$this->connector = new PDO('mysql:host=localhost;dbname=db_nickname_julleresche;charset=utf8' , 'root', 'root');
    }

    /**
     * TODO: � compl�ter
     */
    private function querySimpleExecute($query){

        // TODO: permet de pr�parer et d�ex�cuter une requ�te de type simple (sans where)
    }

    /**
     * TODO: � compl�ter
     */
    private function queryPrepareExecute($query, $binds){    
        $req = $this->connector->prepare($query);
        if(isset($binds))
        {
            foreach($binds as $bind)
            {
                $req->bindValue($bind['marker'], $bind['var'], $bind['type']);
            }
        }
        $req->execute();
        return $req;
    }

    /**
     * TODO: � compl�ter
     */
    private function formatData($req){
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * TODO: � compl�ter
     */
    private function unsetData($req){
        $req->closeCursor();
    }

    /**
     * TODO: � compl�ter
     */
    public function getAllPrinters(){
        $query = "SELECT * FROM t_printer";
        $req = $this->queryPrepareExecute($query,null);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    /**
     * TODO: � compl�ter
     */
    public function getSomePrinters($request){
        $query = "SELECT * FROM t_printer WHERE ";
        $req = $this->queryPrepareExecute($query,null);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    /**
     * TODO: � compl�ter
     */
    public function getPrinterByID($id){
        $query = 'SELECT * FROM t_printer WHERE  idPrinter =' . $id;
        $req = $this->queryPrepareExecute($query,null);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result[0];
    }

    public function deletePrinter($id){
        $query = 'DELETE FROM t_printer WHERE idPrinter =' . $id;
        $req = $this->queryPrepareExecute($query,null);
        $this->unsetData($req);
        header("location: home.php");
    }

    public function modifyPrinter($id, $gender, $nickname, $origin, $section){
        $query = 'UPDATE t_teacher SET teaGender="' . $gender . '", teaNickname="' . $nickname . '", teaNicknameOrigin="' . $origin . '", idSection=' . $section . ' WHERE idTeacher =' . $id;

        $req = $this->queryPrepareExecute($query,null);
        $this->unsetData($req);
        header("location: home.php");
    }

    public function getPrintersByPrice($expensive){
        if($expensive = true){
            $query = 'SELECT * FROM t_printer ORDER BY priPrice ASC';
        } else {
            $query = 'SELECT * FROM t_printer ORDER BY priPrice DESC';
        }

        $req = $this->queryPrepareExecute($query,null);
        $this->unsetData($req);
    }

    public function insertPrinter($lastName, $firstName, $gender, $nickName, $origin, $section){
        $query = "INSERT INTO t_printer (teaLastName, teaFirstName, teaGender, teaNickName, teaNicknameOrigin, idSection) VALUES (:lastname,:firstname,:gender,:nickname,:origin,:section)";
        $values = array(
            1=> array(
                'marker' => ':lastname',
                'var' => $lastName,
                'type' => PDO::PARAM_STR
            ),
            2=> array(
                'marker' => ':firstname',
                'var' => $firstName,
                'type' => PDO::PARAM_STR
            ),
            3=> array(
                'marker' => ':gender',
                'var' => $gender,
                'type' => PDO::PARAM_STR
            ),
            4=> array(
                'marker' => ':nickname',
                'var' => $nickName,
                'type' => PDO::PARAM_STR
            ),
            5=> array(
                'marker' => ':origin',
                'var' => $origin,
                'type' => PDO::PARAM_STR
            ),
            6=> array(
                'marker' => ':section',
                'var' => $section,
                'type' => PDO::PARAM_INT
            )
        );
        $req = $this->queryPrepareExecute($query,$values);
        $this->unsetData($req);
        header("location: home.php");
    }
 }
?>