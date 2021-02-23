<?php
    //Requires dos scripts necessários  
    require "../../app_lista_tarefas/tarefa.model.php";
    require "../../app_lista_tarefas/tarefa.service.php";
    require "../../app_lista_tarefas/conexao.php";

    //Testa se $_GET['acao'] está setada, se estiver usa valor da mesma, caso não, usa valor da variável $acao vinda do REQUEST em 'todas_tarefas.php';
    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    //Se valor $acao for INSERIR, faz tratativas de inserção
    if( $acao == 'inserir') {

        //Instacia objeto Tarefa e usa método SETTER mágico passando campo e dado 
        //a ser inserido no banco (recuperado da super global $_POST)
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $conexao = New Conexao();

        //Instacia objeto TarefaService passando parametros CONSTRUCT (de $conexao e $tarefa setados anteriormente)
        $tarefaService = new TarefaService($conexao, $tarefa);

        //Executa método INSERIR da classe TarefaService
        $tarefaService->inserir();

        //Redirecionamento após inserir e retornar sucesso!
        header('Location: nova_tarefa.php?inclusao=1');
   
    } 

    //Se valor $acao for RECUPERAR, faz tratativas de recuperação
    else if ($acao == 'recuperar') {
       
        $tarefa = New Tarefa();
        $conexao = New Conexao();

        $tarefaService = New TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperar();

    } 

    //Se valor $acao for ATUALIZAR, faz tratativas de atualização
    else if ($acao == 'atualizar') {
        
        $tarefa = New Tarefa();
        $tarefa->__set('id', $_POST['id']);
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $conexao = New Conexao();

        $tarefaService = New TarefaService($conexao, $tarefa);

        //Se valor retornado de atualização for TRUE (1), redireciona para todas_tarefas.php
        $tarefaService->atualizar();

        if(isset($_GET['pag']) && $_GET['pag'] == 'index') {
            header('Location: index.php');
        }else {
            header('Location: todas_tarefas.php');
        };

    }

    //Se valor $acao for REMOVER, faz tratativas de remoção
    else if ($acao == 'remover') {

        $tarefa = New Tarefa();
        $tarefa->__set('id', $_GET['id']);

        $conexao = New Conexao();

        $tarefaService = New TarefaService($conexao, $tarefa);
        
        $tarefaService->remover();

        if(isset($_GET['pag']) && $_GET['pag'] == 'index') {
            header('Location: index.php');
        }else {
            header('Location: todas_tarefas.php');
        };

    }

    //Se valor $acao for CONCLUIR, faz tratativas de conclusão
    else if ($acao == 'concluir') {

        $tarefa = New Tarefa();
        $tarefa->__set('id', $_GET['id']);
        $tarefa->__set('id_status', 2);

        $conexao = New Conexao();

        $tarefaService = New TarefaService($conexao, $tarefa);

        $tarefaService->concluir();
        
        if(isset($_GET['pag']) && $_GET['pag'] == 'index') {
            header('Location: index.php');
        }else {
            header('Location: todas_tarefas.php');
        };

    }

    //Se valor de $acao for RECUPERARPENDENTES, faz tratativas de recuperação
    else if ($acao == 'recuperarPendentes') {

        $tarefa = New Tarefa();
        $tarefa->__set('id_status', 1);

        $conexao = New Conexao();

        $tarefaService = New TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperarPendentes();

    }


    


?>