<?php
/**
 * Auteur : Juliardo Guideiner
 * Date : 08.12.2020
 * Description : Page de la classe Database
 */

include "config.ini.php";

 class Database {


    // Variable de classe
    private $connector;

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
    }

    private function querySimpleExecute($query){

        // TODO: permet de pr�parer et d�ex�cuter une requ�te de type simple (sans where)
    }

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

    private function formatData($req){
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    private function unsetData($req){
        $req->closeCursor();
    }

    public function getPrintersMark(){
        $query = "SELECT * FROM t_printer LEFT OUTER JOIN t_mark ON t_printer.idMark = t_mark.idMark";
        $req = $this->queryPrepareExecute($query,null);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    public function getPrintersMaker(){
        $query = "SELECT * FROM t_printer LEFT OUTER JOIN t_maker ON t_printer.idMaker = t_maker.idMaker";
        $req = $this->queryPrepareExecute($query,null);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    public function getAllPrinters(){
        $query = "SELECT * FROM t_printer";
        $req = $this->queryPrepareExecute($query,null);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    public function getSomePrinters($request){
        $query = $request;
        $req = $this->queryPrepareExecute($query,null);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    public function getPrinterByID($id){
        $query = 'SELECT * FROM t_printer NATURAL JOIN t_maker NATURAL JOIN t_mark WHERE idPrinter =' . $id;
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

    public function getPrintersBySpeed(){
        $query = 'SELECT * FROM t_printer ORDER BY priSpeed DESC';

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

    public function getSomePrintersByMark()
    {
        $query = 'SELECT * FROM t_printer ORDER BY idMark ASC';
        return $this->getSomePrinters($query);
    }

    public function getSomePrintersByMaker()
    {
        $query = 'SELECT * FROM t_printer ORDER BY idMaker ASC';
        return $this->getSomePrinters($query);
    }
}
?>