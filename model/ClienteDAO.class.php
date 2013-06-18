<?php

class ClienteDAO {

    private static $SELECT_ALL = "select * from cliente order by nome_cliente";
    
    private static $SELECT_ID = "select * from cliente where id_cliente = :id_cliente";
    
    private  static $DELETE_ID = "delete from cliente where id_cliente = :id_cliente";

    private static $INSERT = "insert into cliente(
                                    nomecliente,
                                    rg_cliente,
                                    cpf_cliente,
                                    sexo_cliente,
                                    dtNasc_cliente,
                                    email_cliente,
                                    nome_usuario,
                                    senha_usuario
                                    )
                                    values(
                                    :nome_cliente,
                                    :rg_cliente,
                                    :cpf_cliente,
                                    :sexo_cliente,
                                    :dtNasc_cliente,
                                    :email_cliente,
                                    :nome_usuario,
                                    :senha_usuario)
                               ";
    
    private static $UPDATE_ID = "update cliente set 
                                    nome_cliente = :nome_cliente,
                                    rg_cliente = :rg_cliente,
                                    cpf_cliente = :cpf_cliente,
                                    sexo_cliente = :sexo_cliente,
                                    dtNasc_cliente = :dtNasc_cliente,
                                    email_cliente = :email_cliente,
                                    nome_usuario = :nome_usuario,
                                    senha_usuario = :senha_usuario,
                                 where 
                                    id_cliente = :id_cliente
                                ";

    public function selectClienteToHTML(PDO $conexao){        
            try{
               $stmtSel = $conexao->query(ClienteDAO::$SELECT_ALL);
               $numLinhas = $stmtSel->rowCount();
               if($numLinhas == 0){
                   return "<tr><td  colspan='6'>Não existe registro cadastrado!! </td></tr>";
               }else{
                   $tabela = "";
                   $resultSet = $stmtSel->fetchAll();
                   foreach ($resultSet as $linha){
                       $tabela .= " <tr>
                            <td>".$linha['nome_cliente']."</td>
                            <td>$linha[6]</td>
                            <td>$linha[2]</td>
                            <td>$linha[3]</td>
                            <td class='btnFrm'><a href='index.php?view=cadastro&page=cadcliente&acao=2&id=$linha[0]'><img src='img/editar.jpg'> </a></td>
                            <td class='btnFrm'><a href='index.php?view=cadastro&page=cadcliente&acao=3&id=$linha[0]'><img src='img/excluir.jpg'> </a></td>
                        </tr>";
                   }
                   return $tabela;
               }
            }catch (PDOException $e){
                return $e; 
            }   
    }
    
    public function selectClienteID(PDO $conexao, $id){
        try{
         $stmtSelId = $conexao->prepare(ClienteDAO::$SELECT_ID);
         $stmtSelId->execute(
                   array(
                       ':id_cliente'=> $id
                   )
                 );
        $result = $stmtSelId->fetch(PDO::FETCH_OBJ);     // $result = $stmtSelId->fetch(PDO::FETCH_BOTH);        
        $objCliente = new Cliente(
            $result->id_cliente ,                        // $result[0] ou $result['id-cliente']
            $result->nome_cliente, 
            $result->rg_cliente, 
            $result->cpf_cliente, 
            $result->sexo_cliente, 
            $result->dtNasc_cliente, 
            $result->email_cliente,
            $result->nome_usuario,
            $result->senha_usuario                
        );
            return $objCliente;
        }catch (PDOException $e){
            return $e;
        }
    }

    public function deletaCliente(PDO $conexao , $id){
        try{
            $stmtDel = $conexao->prepare(ClienteDAO::$DELETE_ID);
            $stmtDel->execute(array(':id_cliente'=>$id));
            echo "<script type=\"text/javascript\" > showSuccessToast('Dados excluídos com sucesso!!'); </script>";
            return TRUE;            
        }  catch (PDOException $e){
            return $e;
        }
    }
        
    public function addCliente(PDO $conexao, Cliente $obj){
        try{
           $x = str_replace(".","",$obj->getCpf());
           $stmtIns = $conexao->prepare(ClienteDAO::$INSERT); 
           $stmtIns->execute(
                    array(
                        ':nome_cliente'=> $obj->getNome(),
                        ':rg_cliente'=> $obj->getRg(),
                        ':cpf_cliente'=> str_replace("-","",$x),
                        ':sexo_cliente'=> $obj->getSexo(),
                        ':dtNasc_cliente'=> $obj->getDtNasc(),
                        ':email_cliente'=> $obj->getEmail(),  
                        ':nome_usuario'=> $obj->getNomeUsuario(),  
                        ':senha_usuario'=> $obj->getSenha()  
                    )
                   );
           echo "<script type=\"text/javascript\" > showSuccessToast('Dados cadastrados com sucesso!!'); </script>";
           //return TRUE;
        }catch (PDOException $e){
            //return $e;
            echo "<script type=\"text/javascript\" > showErrorToast('".$e->getCode()."'); </script>";
        }
    }
        
    public function alterarCliente(PDO $conexao, Cliente $obj){
        try{
            $x = str_replace(".","",$obj->getCpf());
           $stmtUp = $conexao->prepare(ClienteDAO::$UPDATE_ID); 
           $stmtUp->execute(
               array(
                    ':nome_cliente'=> $obj->getNome(),
                    ':rg_cliente'=> $obj->getRg(),
                    ':cpf_cliente'=> str_replace("-","",$x),
                    ':sexo_cliente'=> $obj->getSexo(),
                    ':dtNasc_cliente'=> $obj->getDtNasc(),
                    ':email_cliente'=> $obj->getEmail(),
                    ':id_cliente'=> $obj->getIdCliente(),
                    ':nome_usuario'=> $obj->getNomeUsuario(),  
                    ':senha_usuario'=> $obj->getSenha()                     
                 )
               ); 
           echo "<script type=\"text/javascript\" > showSuccessToast('Dados Alterados com sucesso!!'); </script>";
           return TRUE;  
        }catch (PDOException $e){
        //return $e;
            echo "<script type=\"text/javascript\" > showErrorToast('".$e->getMessage()."'); </script>";
        }
    }
    
    
}
?>