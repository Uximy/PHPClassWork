<?php
    class DB {
        function connect($host, $dbuser, $dbpassword, $dbname)
        {
            try {
                $db = new PDO("mysql:host=$host;dbname=$dbname", $dbuser,$dbpassword);
    
                $db->query('CREATE TABLE IF NOT EXISTS User (`id` INT NOT NULL AUTO_INCREMENT , `Login` VARCHAR(255) NOT NULL, `Email`  VARCHAR(255) NOT NULL, `Password` VARCHAR(255) NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB');
    
                return $db;
            }
            catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            
        }
    }
?>