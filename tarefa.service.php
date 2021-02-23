<?php
    //CRUD da aplicação
    class TarefaService {
        private $conexao;
        private $tarefa;

        //Método Construtor inicial assim que instacia a classe
        public function __construct(Conexao $conexao, Tarefa $tarefa) {
            $this->conexao = $conexao->conectar();
            $this->tarefa = $tarefa;
        }

        //Create
        public function inserir() { 
            //Query de inserção utilizando PREPARE preventivo contra SQL Injection (prepare e bindvalue)
            $query = 'insert into 
                        tb_tarefas(tarefa) 
                      values
                        (:tarefa)';
                        
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
            $stmt->execute();
        }

        //Read
        public function recuperar() {
            //Consulta trazendo tarefas da tb_tarefas e status da tb_status por left join
            $query = 'select 
                        t.id, s.status, t.tarefa 
                      from 
                        tb_tarefas as t
                      left join 
                        tb_status as s 
                      on
                        (t.id_status = s.id)';

            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        }

        //Update
        public function atualizar() {

            $query = 'update
                        tb_tarefas
                      set
                        tarefa = :tarefa
                      where
                        id = :id';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
            $stmt->bindValue(':id', $this->tarefa->__get('id'));
            return $stmt->execute();

        }

        //Delete
        public function remover() {

            $query = 'delete from
                        tb_tarefas
                      where
                        id = :id';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $this->tarefa->__get('id'));
            return $stmt->execute();

        }

        //CONCLUIR TAREFAS REALIZADAS
        public function concluir() {

          $query = 'update
                      tb_tarefas
                    set
                      id_status = :id_status
                    where
                      id = :id';

          $stmt = $this->conexao->prepare($query);
          $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
          $stmt->bindValue(':id', $this->tarefa->__get('id'));
          return $stmt->execute();

      }

      public function recuperarPendentes() {

        $query = 'select 
                    t.id, s.status, t.tarefa 
                  from 
                    tb_tarefas as t
                  left join 
                    tb_status as s 
                  on
                    (t.id_status = s.id)
                  where
                    t.id_status = :id_status';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

      }

    }
?>