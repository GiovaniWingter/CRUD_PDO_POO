<?php
class Cliente {
        protected $idCliente;
        protected $nome;
	protected $rg;
	protected $cpf;
	protected $sexo;
	protected $dtNasc;
	protected $email;
	protected $nomeUsuario;
	protected $senha;
    
        function __construct($idCliente, $nome, $rg, $cpf, $sexo, $dtNasc, $email, $nomeUsuario, $senha) {
            $this->idCliente = $idCliente;
            $this->nome = $nome;
            $this->rg = $rg;
            $this->cpf = $cpf;
            $this->sexo = $sexo;
            $this->dtNasc = $dtNasc;
            $this->email = $email;
            $this->nomeUsuario = $nomeUsuario;
            $this->senha = $senha;
        }
        public function getNomeUsuario() { return $this->nomeUsuario; }
        public function setNomeUsuario($nomeUsuario) { $this->nomeUsuario = $nomeUsuario; }

        public function getSenha() { return $this->senha; }
        public function setSenha($senha) { $this->senha = $senha; }
                
        public function getIdCliente() { return $this->idCliente ; }
	public function setIdCliente($idCliente) { $this->idCliente = $idCliente; }
        
        public function getNome() { return $this->nome ; }
	public function setNome($nome) { $this->nome = $nome; }

	public function getRg() { return $this->rg;}
	public function setRg($rg) { $this->rg = $rg; }

	public function getCpf() { return $this->cpf; 	}
	public function setCpf($cpf) { $this->cpf = $cpf; }

	public function getSexo() { return $this->sexo; }
	public function setSexo($sexo) { $this->sexo = $sexo;}

	public function getDtNasc() { return $this->dtNasc; }
	public function setDtNasc($dtNasc) { $this->dtNasc = $dtNasc; }

	public function getEmail() { return $this->email; }
	public function setEmail($email) { $this->email = $email; }


	public function toHTML() {
            $table = "
                <table>
                    <caption>Novo Cliente</caption>
                <thead>
                    <tr>
                        <th>Atributos</th>
                        <th>Valores</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Nome:</td><td>$this->nome</td></tr>
                    <tr><td>E-mail:</td><td>$this->email</td></tr>
                    <tr><td>RG:</td><td>$this->rg</td></tr>
                    <tr><td>CPF:</td><td>$this->cpf</td></tr>
                    <tr><td>Sexo:</td><td>$this->sexo</td></tr>
                    <tr><td>Nascimento:</td><td>$this->dtNasc</td></tr>
                </tbody>
                </table>
            ";        
            return $table;
	}
}
?>