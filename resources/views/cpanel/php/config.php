<?php
    class DBMysql
    { 
        private $mysqli;
        private $config;

        public function __construct($configFile = 'config.ini')
        {
            $this->config = parse_ini_file($configFile, true)['database'];

            $this->mysqli = new mysqli(
                $this->config['host'],
                $this->config['user'],
                $this->config['password'],
                $this->config['dbname'],
                $this->config['port']
            );

            if ($this->mysqli->connect_error) {
                $this->mysqli= null;
            }

            $this->mysqli->set_charset("utf8"); // Configura charset
        }

        // Ejecutar una consulta y obtener resultados (SELECT)
        public function query($sql)
        {
            return $this->mysqli->query($sql);
        }

        // Ejecutar una consulta preparada
        public function prepare($sql)
        {
            return $this->mysqli->prepare($sql);
        }

        // Obtener la conexión si se necesita acceso directo
        public function getConexion()
        {
            return $this->mysqli;
        }

        // Cerrar la conexión
        public function close()
        {
            $this->mysqli->close();
        }
    }
?>