<?php
    class Tarefa {
        //Atributos das tarefas semelhantes aos campos da tabelo no banco
        private $id;
        private $id_status;
        private $tarefa;
        private $data_cadastro;

        //Getters e Setters mágicos
        public function __get($atributo) {
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this->$atributo = $valor;
        }
    }
?>
