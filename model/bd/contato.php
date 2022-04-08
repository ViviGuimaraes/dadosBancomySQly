<?php
// _________________________________________________________________________________
// 
// Objetivo: Arquivo responsável por manipular os dados dentro do banco de dados
//(insert, update, select e delelte)
// Autor: Vívian Guimarães Vaz
// Data: 11/03/2022
// versão: 1.0
// __________________________________________________________________________________

//Neste arquivo tem as 4 operações do banco

//IMporte do arquivo que estavbelece a conexão com o BD
require_once('conexaomysql.php');


//função para realizar o insert no BD
function insertContato($dadosContato)
{

    $statusResposta= (boolean) false;


    //abre a conexão com BD
    $conexao =conexaoMysql();

     //monta o script e envia para o bd
    $sql = "insert into tblcontatos
                (nome,
                telefone,
                celular,
                email,
                obs)
            values(
                '".$dadosContato["nome"]."',
                '".$dadosContato["telefone"]."',
                '".$dadosContato["celular"]."',
                '".$dadosContato["email"]."',
                '".$dadosContato["obs"]."');";

                
            
    //Executa o script no BD
    //validação para verificar se o script está certo 
    if(mysqli_query($conexao,$sql))
    {
                //validação para verificar se uma linha foi acrescentada no BD
                if(mysqli_affected_rows($conexao))
                    $statusResposta =true;
                
    }
        //solicita o fechamento da conexão com o BD
        fecharconexaoMysql($conexao);

         return $statusResposta;
    
}

//função para realizar o update no BD
function updateContato($dadosContato)
{
    $statusResposta= (boolean) false;


    //abre a conexão com BD
    $conexao =conexaoMysql();

    //monta o script e envia para o bd
    $sql = "update tblcontatos set 
                nome       = '".$dadosContato["nome"]."',
                telefone   = '".$dadosContato["telefone"]."',
                celular    = '".$dadosContato["celular"]."',
                email     = '".$dadosContato["email"]."',
                obs        = '".$dadosContato["obs"]."'
                where idcontatos =".$dadosContato['id'];
            
       
            
    //Executa o script no BD
    //validação para verificar se o script está certo 
    if(mysqli_query($conexao,$sql))
    {
                //validação para verificar se uma linha foi acrescentada no BD
                if(mysqli_affected_rows($conexao))
                    $statusResposta =true;
                
    }
        //solicita o fechamento da conexão com o BD
        fecharconexaoMysql($conexao);

         return $statusResposta; 
}

//função para listar todos os contatos no BD
function selectAllContato()
{
    //Abre conexão com o BD
    $conexao = conexaoMysql();

    //Script oara listar todos os dados do BD
    $sql = " select * from tblcontatos order by idcontatos desc";


    //executa o script sql no BD e guarda o retorno dos dados, se houver 
    $result= mysqli_query($conexao, $sql);

    //Valida se o BD retornou todos os registro
    if($result)
    {

        //mysqli_fetch_assoc() - permite converter os dados do BD
        //em um array para a manipulação no PHP
        //Nesta repetição estamos, convertendo os dados do BD em
        // um array($srDados) além de o próprio while conseguir genrenciar a quantidade 
        // de vezes que deve ser feita a repetição

        $cont=0;

        while($srDados = mysqli_fetch_assoc($result))
        {
            //criar um array com os dados do DB
            $arrayDados[$cont] = array(


                  "id"          => $srDados['idcontatos'],
                "nome"          => $srDados['nome'],
                "telefone"      => $srDados['telefone'],
                "celular"       => $srDados['celular'],
                "email"         => $srDados['email'],
                "obs"           => $srDados['obs']
            );
            $cont++;
        }
        //solicita o fechamento da conexão com o BD
        fecharconexaoMysql($conexao);


        return $arrayDados;
    }
}

//função para excluir no BD
function deleteContato($id)
{
    $statusResposta= (boolean) false;
    $conexao = conexaoMysql();

    //script para deletar um registro no BD
    $sql ="delete from tblcontatos  where idcontatos=".$id;
    // echo($sql);
    // die;

    //valida se o script está correto, sem erro de sintaxe e executa o BD
   if (mysqli_query($conexao, $sql))
   {

        //valida se o BD teve sucesso na execução do script
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;

   }
        //fechar a conexão com o BD
        fecharconexaoMysql($conexao);


            return $statusResposta;
}

//função para buscar um contato no BD 
function selectByIdcontato($id)
{

    //Abre conexão com o BD
    $conexao = conexaoMysql();

    //Script oara listar todos os dados do BD
    $sql = " select * from tblcontatos where idcontatos =".$id;


    //executa o script sql no BD e guarda o retorno dos dados, se houver 
    $result= mysqli_query($conexao, $sql);

    //Valida se o BD retornou todos os registro
    if($result)
    {

        //mysqli_fetch_assoc() - permite converter os dados do BD
        //em um array para a manipulação no PHP
        //Nesta repetição estamos, convertendo os dados do BD em
        // um array($srDados) além de o próprio while conseguir genrenciar a quantidade 
        // de vezes que deve ser feita a repetição

        

        if($srDados = mysqli_fetch_assoc($result))
        {
            //criar um array com os dados do DB
            $arrayDados = array(


                  "id"          => $srDados['idcontatos'],
                "nome"          => $srDados['nome'],
                "telefone"      => $srDados['telefone'],
                "celular"       => $srDados['celular'],
                "email"         => $srDados['email'],
                "obs"           => $srDados['obs']
            );
                   //solicita o fechamento da conexão com o BD
        fecharconexaoMysql($conexao);


        return $arrayDados;
        }
    }

    
}

?>