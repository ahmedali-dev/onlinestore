<?php


include __DIR__ . "/../config/config.php";
include __DIR__ . "/../models/model.php";
class database
{
    private $db;
    private $stmt;
    protected model $model;
    protected static model $model2;


    function __construct()
    {
        $this->model = new model();
        self::$model2 = new model();
        try {
            $this->db = new PDO("mysql:host=" . host . ";dbname=" . dbname, name, pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $this->db->prepare("select * from register");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $th) {
            echo "database error-> " . $th->getMessage();
        }
    }

    public static function getmodel()
    {
        return self::$model2;
    }


    function query($q)
    {
        $this->stmt = $this->db->prepare($q);
    }

    function bind($key, $value)
    {
        $this->stmt->bindValue($key, $value);
    }

    function exc()
    {
        return $this->stmt->execute();
    }

    function count()
    {
        return $this->stmt->rowCount();
    }

    function only()
    {
        self::exc();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    function all()
    {
        self::exc();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
}