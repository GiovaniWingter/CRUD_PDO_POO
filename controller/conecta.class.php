<?php
final class Conecta {
  
    private function __construct() {}

    public static function getConexao($arq){
        
        if(file_exists($arq)){
            $db = parse_ini_file($arq);
        }else{
            throw new Exception("Arquivo não encontrado: $arq");
        }
        
        $usuario = isset($db['usuario']) ? $db['usuario'] : NULL;
        $senha = isset($db['senha']) ? $db['senha'] : NULL;
        $nome = isset($db['nome']) ? $db['nome'] : NULL;
        $host = isset($db['host']) ? $db['host'] : NULL;
        $sgbd = isset($db['sgbd']) ? $db['sgbd'] : NULL;
        $porta = isset($db['porta']) ? $db['porta'] : NULL;
        
        switch ($sgbd){
            case 'mysql':
                $porta = $porta ? $porta : '3306';
            try {
                $conexao = new PDO("mysql:host={$host};port={$porta};dbname={$nome}",$usuario,$senha);
            
            }  catch (PDOException $e){
                print_r($e);
            }
                
                break;
            
            case 'mssql':
                $conexao =  new PDO( "sqlsrv:server={$host};database=$nome", $usuario,$senha);
                break;            
        }
        
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexao;
    }
      
 
}
?>