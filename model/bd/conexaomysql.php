<?php
// _________________________________________________________________________________
// 
// Objetivo: Arquivo para criar conexão entre o BD e MySQL
// Autor: Vívian Guimarães Vaz
// Data: 25/02/2022
// versão: 1.0
// __________________________________________________________________________________


//  Existem 3 formas e criar a conexão com o BD e MYsql

// mysql_connet() -versão mais antiga do php (não oferece muita segurança)

// mysqli_connet() -versão mais atualizada do php para fazer conexão 
//  (ela permite ser usada para programção estruturada e POO)

// PDO() -versão mais eficiente e completa para conexão (é indicada pela segurança)



    //constantes para estabelcer a conexão 
    const SERVER = 'localhost';
    const USER = 'root';
    const PASSAWORD = 'bcd127';
    const DATABASE ='dbcontatos';

   
   $resultado = conexaoMysql();
   
//    echo("<pre>");
//    var_dump($resultado);
//    echo("</pre>");

//abre a conexão entre BD e Mysql
function conexaoMysql()
{ 
    
    $conexao =array();


    //Se a conexão for estabelecida com BD, teremos um array de dados sobre a conexão
     $conexao = mysqli_connect(SERVER,USER,PASSAWORD,DATABASE);


    //Validação para verificar se a conexão foi realizada com sucesso 
    if($conexao)
        return $conexao;
    else
        return false;
}


//fecha a conexão com o BD mysql

function fecharconexaoMysql($conexao)
{
   mysqli_close($conexao);  
}









?>