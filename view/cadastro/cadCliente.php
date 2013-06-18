<?php
require_once 'controller/conecta.class.php';
require_once 'model/Cliente.class.php';
require_once 'model/ClienteDAO.class.php';
$conexao = Conecta::getConexao("config/bd_mssql.ini");
$objClienteDAO = new ClienteDAO();

$acao = isset($_GET['acao']) ? $_GET['acao'] : 0;
$idCliente = isset($_GET['id']) ? $_GET['id'] : 0;

//somente quando enviado via formulário
$acaoPost = isset($_POST['acao']) ? $_POST['acao'] : 0 ; 

//insert
    if($acaoPost == 1){
        
        $nome = isset($_POST['txtNome']) ? $_POST['txtNome'] : "" ;
        $rg = isset($_POST['txtRg']) ? $_POST['txtRg'] : "" ;
        $cpf = isset($_POST['txtCpf']) ? $_POST['txtCpf'] : "" ;
        $sexo = isset($_POST['rbSexo']) ? $_POST['rbSexo'] : "" ;
        $dtNasc = isset($_POST['txtDtNasc']) ? $_POST['txtDtNasc'] : "" ;
        $email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : "" ;
        $nomeUser = isset($_POST['txtNomeUsuario']) ? $_POST['txtNomeUsuario'] : "" ;
        $senhaUser = isset($_POST['txtSenha']) ? $_POST['txtSenha'] : "" ;
        
        $objCliente = new Cliente(NULL, $nome, $rg, $cpf, $sexo, $dtNasc, $email,$nomeUser,$senhaUser);
        $objClienteDAO->addCliente($conexao, $objCliente);
    }
//update
    if($acaoPost == 2){
        
    }


?>

<?php 
    if($acao == 0 || $acao == 3){
        //verificar se é exclusão
        if($acao == 3){
            //codificação da exclusão;
            $objClienteDAO->deletaCliente($conexao, $idCliente);
        }
?>
<table>
    <caption>Clientes</caption>
    <thead>
        <tr>
            <th>Nome</th>
            <th>e-mail</th>
            <th>RG</th>
            <th>CPF</th>
            <th colspan="2">Ação</th>
        </tr>
    </thead>
    <tbody>
    <?php echo $objClienteDAO->selectClienteToHTML($conexao); $conexao = NULL;?>
    </tbody>
</table>
<input type="button" class="btn" onclick="window.location='index.php?view=cadastro&page=cadcliente&acao=1'" name="novoCliente" value="Novo">
<?php
    }else{
?>


<form method="post" action="index.php?view=cadastro&page=cadcliente">
    <h2>Cadastro de Cliente</h2>
    <input type="hidden" name="acao" value="<?php echo $acao; ?>">
    <input type="hidden" name="idCliente" value="<?php echo $idCliente; ?>">
    <label>Nome:</label><input required type="text" name="txtNome" /> <br />
    <label>RG:</label><input class="peq" type="text" name="txtRg" /> <br />
    <label>CPF:</label><input pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="999.999.999-99" placeholder="999.999.999-99" required class="peq" type="text" name="txtCpf" /> <br />
    <label>Sexo:</label><input required type="radio" class="rbSexo" value="M" name="rbSexo"><label class="lblSexo" >Masculino</label>
    <input type="radio" class="rbSexo" value="F" name="rbSexo"><label class="lblSexo" >Feminino</label><br />
    <label>Nascimento</label><input required class="mini" type="text" name="txtDtNasc" id="txtDtNasc" /><br/>
    <label>e-mail:</label><input required type="email" name="txtEmail" id="txtEmail"/><br />
    <label>Nome de usuário:</label><input class="med"  required type="text" name="txtNomeUsuario" id="txtNomeUsuario"/><br />
    <label>Senha:</label><input class="peq"  required type="password" name="txtSenha" id="txtSenha"/><br />
    <label>Confirme a senha:</label><input class="peq"  onInput="checaSenha(this)" required type="password" name="txtSenhaConf" id="txtSenhaConf"/><br />
    <input class="btn" type="reset" value="Limpar"><input class="btn" type="submit" value="Enviar"/>
    <br>
    <input type="button" class="btn" value="Voltar" onclick="window.location='index.php?view=cadastro&page=cadcliente'">
</form>
    

<?php
   }
?>

