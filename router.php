<?php

// ___________________________________________________________________________

// Objetivo: Arquivo de rota, para segmentar as ações pela View
// (dados de um formulário, listagem de dados, ação de excluir ou atualizar)

// Esse arquivo é responsável por encaminhar as solicitações para a controller

// Autor: Vívian Guimarães Vaz
// Data: 04/03/2022
// Versão: 1.0
// ___________________________________________________________________________


$action = (String) null;
$component = (String) null;
$nome = (String) null;



//Validação para verificar se a requisição é um POST de  formulário
if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET')

{


    //REcebemos dados via URL para saber se está solicitando e qual ação será
    //realizada
    $component = strtoupper($_GET['component']);
    $action    =strtoupper($_GET['action']);

   
   



    //estrutural condicional para verificar quem está solicitando algo pelo Rout
    switch($component)
    {
        case 'CONTATOS':

            //import  da controller contatos 
            require_once('controller/controllerContatos.php');

            //validação para identificar o tipo de ação que será realizada
            if($action =='INSERIR')
                    {
                        //chamar a função na controller
                        $resposta = inserirContato($_POST);
                        
                        //valida o tipo de dado que a controller retornou 
                        if(is_bool($resposta)) //se for bolleano
                        {
                        
                            //verificar se o retorno foi verdadeiro
                            if($resposta)
                                echo("<script>
                                        alert('Registro Inserido com sucesso !');
                                        windou.location.href ='index.php';
                                    </script>");

                            //se o retorno for um aaray signofica que houve um processo de inserção
                        }elseif (is_array($resposta)){

                            echo("<script>
                                alert('".$resposta['message']."');
                                windou.history.back();
                                </script>");
                            }
                    }
             elseif($action =='DELETAR')
                    {
                        
                        //Receber o id do registro que deverá ser excluído,
                        //que foi enviado pela url no link da imagem
                        //do excluir que foi acionado no index
                        $idContato = $_GET['id'];

                        //chamar a função excluir na controller
                        $resposta = excluirContato($idContato);

                        if(is_bool($resposta))
                        {
                            if($resposta)
                            {
                                echo("<script>
                                alert('Registro excluido com sucesso !');
                                windou.location.href ='index.php';
                                     </script>");
                            }
                        }
                        elseif(is_array($resposta))
                        {
                            echo("<script>
                            alert('".$resposta['message']."');
                            windou.history.back();
                             </script>");
                        }
                    }

             elseif($action =='BUSCAR')
                    {
                            //Receber o id do registro que deverá ser editado,
                            //que foi enviado pela url no link da imagem
                            //do editar que foi acionado no index
                            $idContato = $_GET['id'];


                            //chamar a função de busca  na controller
                            $resposta = buscarContato($idContato);

                            // var_dump($resposta);
                        

                            //Ativa a ultilização de variáveis de sessão no servidor
                            session_start();

                            //guarda em uma sessão os dados que o BD retornou para o Id
                            //OBS(essa variável de sessão será ultilizada na index.php, para colocar os dados nas caixas de textos.)
                            $_SESSION['dadosContato'] = $resposta;

                            //ultilizando o header também podemos chamar a index.php,
                            //porém haverá uma ação de carregamento do navegador
                            //(piscando a tela novamente)


                            //header('localtion: index.php');


                            //ultilizando o require_once iremos apenas importar, 
                            // a tela da index, assim não havendo um novo carregamneto, 
                            //da página.
                            require_once('index.php');
                    }

            elseif($action =='EDITAR')
                    {
                        //receber o id que foi encaminhada no action do form pela url
                        $idContato = $_GET['id'];
                       
                        //chamar a função para editar na  controller
                        $resposta = atualizarContato($_POST,$idContato);
                        
                        //valida o tipo de dado que a controller retornou 
                        if(is_bool($resposta)) //se for bolleano
                        {
                        
                            //verificar se o retorno foi verdadeiro
                            if($resposta)
                                echo("<script>
                                        alert('Registro Atualizado com sucesso !');
                                        windou.location.href ='index.php';
                                    </script>");

                            //se o retorno for um aaray signofica que houve um processo de inserção
                        }elseif (is_array($resposta)){

                            echo("<script>
                                alert('".$resposta['message']."');
                                windou.history.back();
                                </script>");
                            } 
                    }
                     break;
            }

        
    }










?>