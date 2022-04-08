<?php


// variáveis declaradas como tratativa para não dar erro 
// no HTML citando que a variável não foi declarada
$nome=(string)null;
$obs =(string) null;

//essa variável foi criada para diferenciar no action do formulário
//qual a condição deveria ser levada para a router (inserir ou editar).
//nas condições abaixos, mudamos o action dessa variável para ação de editar.
$form=(string) "router.php?component=contatos&action=inserir";

if(session_status())
{
    if(!empty($_SESSION['dadosContato']))
    {
       
        $id         =$_SESSION['dadosContato']['id'];
        $nome       =$_SESSION['dadosContato']['nome'];
        $telefone   =$_SESSION['dadosContato']['telefone'];
        $celular    =$_SESSION['dadosContato']['celular'];
        $email      =$_SESSION['dadosContato']['email'];
        $obs        =$_SESSION['dadosContato']['obs'];
        
        //mudamos a ação do form para editar a ação do click do botão salvar
        $form = "router.php?component=contatos&action=editar&id=".$id;

        //destroi uma variável da memória do servidor 
        unset($_SESSION['dadosContato']);
    }
}




?>


<!DOCTYPE>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title> Cadastro </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        


    </head>
    <body>
       
        <div id="cadastro"> 
            <div id="cadastroTitulo"> 
                <h1> Cadastro de Contatos </h1>
                
            </div>
            <div id="cadastroInformacoes">
                <form  action="<?=$form?>" name="frmCadastro" method="post" >
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Nome: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtNome" value="<?=$nome?>" placeholder="Digite seu Nome" maxlength="100">
                        </div>
                    </div>
                                     
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Telefone: </label>
                        </div>
                         <div class="cadastroEntradaDeDados"> <!-- @ = forma de esconder o erro do código  -->
                            <input type="tel" name="txtTelefone" value="<?=@$telefone?>">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Celular: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">  <!-- inssert é uma forma de declarar a variável no php -->
                            <input type="tel" name="txtCelular" value="<?= isset($celular)? $celular:null ?>">
                        </div>
                    </div>
                   
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Email: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">  <!-- inssert é uma forma de declarar a variável no php -->
                            <input type="email" name="txtEmail" value="<?= isset($email) ? $email: null ?>">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Observações: </label>
                        </div>
                        <div class="cadastroEntradaDeDados"> <!--a variável foi declarada no php no início da tela -->
                            <textarea name="txtObs" cols="50" rows="7"><?=$obs?></textarea>
                        </div>
                    </div>
                    <div class="enviar">
                        <div class="enviar">
                            <input type="submit" name="btnEnviar" value="Salvar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="consultaDeDados">
            <table id="tblConsulta" >
                <tr>
                    <td id="tblTitulo" colspan="6">
                        <h1> Consulta de Dados.</h1>
                    </td>
                </tr>
                <tr id="tblLinhas">
                    <td class="tblColunas destaque"> Nome </td>
                    <td class="tblColunas destaque"> Celular </td>
                    <td class="tblColunas destaque"> Email </td>
                    <td class="tblColunas destaque"> Opções </td>
                </tr>
                <?php
                
                require_once('controller/controllerContatos.php');
                // chama a função que vai retornas os dados do contato
                $listContato = listarContato();


                //estrutura de repetição para retornar os dados da array
                //e printar a tela
                foreach($listContato as $item)

                {
                
                ?>
               
                <tr id="tblLinhas">
                    <td class="tblColunas registros"><?= $item['nome']?></td>
                    <td class="tblColunas registros"><?= $item['celular']?></td>
                    <td class="tblColunas registros"><?= $item['email']?></td>
                   
                    <td class="tblColunas registros">
                        <a href= "router.php?component=contatos&action=buscar&id=<?=$item['id']?>"> 
                            <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
                          </a>

                            <a onclick="return confirm('Deseja realmente excluir o contato ?')" href="router.php?component=contatos&action=deletar&id=<?=$item['id']?>">
                            <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir">
                            </a>

                            <img src="img/search.png" alt="Visualizar" title="Visualizar" class="pesquisar">
                    </td>
                </tr>

                <?php
                }
                ?>

            </table>
        </div>
    </body>
</html>