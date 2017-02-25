<?php
class Database {
    private static $vcapServicesKey = "VCAP_SERVICES";
    private static $composeForMysqlKey = "compose-for-mysql";

    private $connection; //mysql connection
    private $serviceUri;
    private $credentials;
    private $database;
    private $serverPort;

    public function __construct($testUri) {
        if ($testUri) {
            $this->serviceUri = $testUri;
            $this->makeConnection();
        }

        if (isset($_ENV[self::$vcapServicesKey])) {
            $vcap_services = json_decode ($_ENV[self::$vcapServicesKey]);
            $dbCredentials = $vcap_services->{self::$composeForMysqlKey}[0]->credentials;
            $this->serviceUri = $dbCredentials->uri;
            $this->parse($this->serviceUri);
            $this->makeConnection();
        } else {
            
        }
    }

    private function parse() {
        $tmp = str_replace("mysql://", "", $this->serviceUri); //echo var_dump($tmp) ."<br>";
        $this->credentials = explode(":", explode("@", $tmp)[0]); //echo var_dump($this->credentials) . "<br>";
        $this->database = explode("/", $tmp)[1]; //echo var_dump($this->database) . "<br>";
        $this->serverPort = explode(":", explode("/", explode("@", $tmp)[1])[0]); //echo var_dump($this->serverPort) . "<br>";
    }
    
    private function makeConnection() {
        $this->connection = new mysqli(
                $this->serverPort[0], // server
                $this->credentials[0], // name
                $this->credentials[1], // password
                $this->database,    //database name
                $this->serverPort[1]); // server port
    }
}
?>

<?php 
    $mysql = @new mysqli(
            "10.211.50.18", // server
            "root", // name
            "Root#123", // password
            "mysql",    //database name
            "3306"); // server port
    $result = $mysql->query("select * from user");
    $result = $result->fetch_array(MYSQL_ASSOC);
    foreach ($result as $key => $value) {
        echo $key . " " . $value . "<br>";
    }
?>