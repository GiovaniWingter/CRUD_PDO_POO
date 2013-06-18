<?php

require_once '../../model/Cliente.class.php';

$cliente = new Cliente($_POST['txtNome'], $_POST['txtRg'], $_POST['txtCpf'], $_POST['rbSexo'], $_POST['txtDtNasc'], $_POST['txtEmail']);

echo $cliente->getNome();
echo "<br />".$cliente->getRg();
echo "<br />".$cliente->getCpf();
echo "<br />".$cliente->getEmail();
echo "<br />".$cliente->getDtNasc();
echo "<br />".$cliente->getSexo();
echo "<br />".$cliente->toHTML();


?>
