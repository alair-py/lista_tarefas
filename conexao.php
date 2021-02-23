<?php
    class Conexao {
        //Atributos do banco de dados
        private $host = 'localhost';
        private $dbname = 'php_pdo';
        private $user = 'root';
        private $password = '';

        //Método para instanciar conexão com banco
        public function conectar() {
            try {
                $conexao = new PDO(
                    "mysql:host=$this->host;dbname=$this->dbname",
                    "$this->user",
                    "$this->password"
                );

                return $conexao;
            
             //Tratamento de erros
            } catch(PDOException $e) {
                echo '<p>'. $e->getMessage() .'</p>'; 
            }
        }
    }

?>