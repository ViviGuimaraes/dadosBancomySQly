<?PHp
// ___________________________________________________________________________

// Objetivo: Arquivo responnsável pela manipulação de dados de contatos
//obs: este arquivo fará a ponte entre a view e model

// Autor: Vívian Guimarães Vaz
// Data: 04/03/2022
// Versão: 1.0
// ___________________________________________________________________________


//Função para receber dados da View e encaminhar para a model 
function inserirContato ($dadosContato)
{
    // var_dump($dadosContato);
    //validação para verificar se objeto está vazio 
    if(!empty($dadosContato))
    {

        //validação de caixa vazia  dos elemtos nomes, ceular e email, pois são obrigatórios no BD
        if(!empty($dadosContato['txtNome']) && !empty($dadosContato['txtCelular']) && !empty($dadosContato['txtEmail']))
        {
                        echo('teste');
                    //criação do array de dados que será encaminhado a model 
                    //para inserir no BD, é importante criar este array conforme as manipulação do BD

                    //OBS: criar os nomes do array conforme os nomes dos atributos doBD
                    $arrayDados = array (

                        "nome"        => $dadosContato['txtNome'],
                        "telefone"    => $dadosContato['txtTelefone'],
                        "celular"     => $dadosContato['txtCelular'],
                        "email"       => $dadosContato['txtEmail'],
                        "obs"         => $dadosContato['txtObs']
                        
                    );

                    //import do arquivo de modelagem para manipulação do BD
                    require_once('./model/bd/contato.php');

                    //chamar a função que fará o insert do BD (esta função está no BD)
                    if(insertContato($arrayDados))
                        return true;
                    else
                        return array("idErro" => 1, "message" => "Não foi possível inserir os dados no Banco de Dados!");
                  
        }  else
            return array("idErro" => 2, "message" => "Existem campos obrigatórios que não foram preenchidos!");
    }
}

//Função para receber dados da View e encaminhar para a model (ATUALIZADA)
function atualizarContato ($dadosContato, $id)
{
    // var_dump($dadosContato);

    //validação para verificar se objeto está vazio 
    if(!empty($dadosContato))
    {

        //validação de caixa vazia  dos elemtos nomes, ceular e email, pois são obrigatórios no BD
        if(!empty($dadosContato['txtNome']) && !empty($dadosContato['txtCelular']) && !empty($dadosContato['txtEmail']))
        {
            //validação para garantir que o id seja valido
            if(!empty($id) && $id !=0 && is_numeric($id))
            {
            
                    //criação do array de dados que será encaminhado a model 
                    //para inserir no BD, é importante criar este array conforme as manipulação do BD

                    //OBS: criar os nomes do array conforme os nomes dos atributos doBD
                    $arrayDados = array (
    
                        "id"          => $id,
                        "nome"        => $dadosContato['txtNome'],
                        "telefone"    => $dadosContato['txtTelefone'],
                        "celular"     => $dadosContato['txtCelular'],
                        "email"       => $dadosContato['txtEmail'],
                        "obs"         => $dadosContato['txtObs']
                        
                    );

                    //import do arquivo de modelagem para manipulação do BD
                    require_once('./model/bd/contato.php');

                    //chamar a função que fará o insert do BD (esta função está no BD)
                    if(updateContato($arrayDados))
                        return true;
                    else
                        return array("idErro" => 1, "message" => "Não foi possível atualizar os dados no Banco de Dados!");
            }  else
                return array ('idErro' => 4,
                'message' => 'Não é possível editarc v um registro sem informar um ID válido'
                );


        } else
            return array("idErro" => 2, "message" => "Existem campos obrigatórios que não foram preenchidos!");
    }
}
//Função para realizar a exclusão do contato
function excluirContato ($id)
{
    //validação para verificar seo id contém um número valido
    if($id !=0 && !empty($id) && is_numeric($id))
    {
        //importação do arquivo contato
        require_once('model/bd/contato.php');

        //chama a função model e valida s e o retorno foi verdadeiro ou faldo
        if(deleteContato($id))
            return true;
        else 
            return array ('idErro' => 3,
                                'message' => 'O banco de dados não pode excluir o registro.'
                            );
    }
    else 
        return array ('idErro' => 4,
                        'message' => 'Não é possível excluir um registro sem informar um ID válido'
                        );
}


//função para solicitar os dados da model e encaminhar a lista 
//de contaos para a view
function listarContato ()
{
    //import do arquivo que vai buscar os dados do BD
    require_once('model/bd/contato.php');

    //chama a função que vai buscar os dados no BD
    $dados = selectAllContato();

    if(!empty($dados))
        return $dados;
    else
        return false;
}


//função para buscar um contato através do id do registro 
function buscarContato($id)
{
    //validação para verificar seo id contém um número valido
    if($id !=0 && !empty($id) && is_numeric($id))
    {
        //import do arquivo de contato
        require_once('model/bd/contato.php');

        //chama a função da model que vai buscar no BD
        $dados = selectByIdContato($id);

        //valida se existem dados para serem devolvidos 
        if(!empty($dados))

            return $dados;
        else 
            return false;

    }else

    return array ('idErro' => 4,
                        'message' => 'Não é possível excluir um registro sem informar um ID válido'
                        );
     
}







?>