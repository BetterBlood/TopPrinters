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

    public function getPrintersByPrice($expensive){
        if($expensive){
            $query = 'SELECT * FROM t_printer ORDER BY priPrice ASC';
        } else {
            $query = 'SELECT * FROM t_printer ORDER BY priPrice DESC';
        }

        $req = $this->queryPrepareExecute($query,null);
        $result = $this->formatData($req);
        $this->unsetData($req);
        return $result;
    }

    public function getPrintersBySpeed(){
        $query = 'SELECT * FROM t_printer ORDER BY priPrintingSpeed DESC';

        $req = $this->queryPrepareExecute($query,null);
        
        $result = $this->formatData($req);

        $this->unsetData($req);
        
        return $result;
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