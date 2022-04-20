<?php

include_once '../../classes/Usuario.class.php';
include_once '../../functions/validation.php';
include_once '../../functions/textTransform.php';

use classes\Usuario as Usuario;

$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$senha = isset($_POST['senha']) ? $_POST['senha'] : NULL;
$idNivelUsuario = isset($_POST['idNivelUsuario']) ? $_POST['idNivelUsuario'] : NULL;
$nome = isset($_POST['nome']) ? $_POST['nome'] : NULL;
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : NULL;
$endereco = isset($_POST['endereco']) ? $_POST['endereco'] : NULL;
$bairro = isset($_POST['bairro']) ? $_POST['bairro'] : NULL;
$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : NULL;
$uf = isset($_POST['uf']) ? $_POST['uf'] : NULL;
$cep = isset($_POST['cep']) ? $_POST['cep'] : NULL;
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : NULL;
$foto = isset($_POST['foto']) ? $_POST['foto'] : NULL;

validateEmail($email, 'Email inválido!');
validateStr($email, 100, 'Email muito grande!');
notNull($email, 'O email não pode ser nulo!');
validateStr($senha, 64, 'Senha inválida!');
notNull($senha, 'A senha não pode ser nula!');
validateInt($idNivelUsuario, 11, 'ID do nível de usuário inválido!');
notNull($idNivelUsuario, 'O ID do nível de usuário não pode ser nulo!');
validateStr($nome, 50, 'Nome inválido!');
notNull($nome, 'O nome não pode ser nulo!');
validateCpf($cpf, 'CPF inválido!');
notNull($cpf, 'O CPF não pode ser nulo!');
validateStr($endereco, 50, 'Endereço inválido!');
notNull($endereco, 'O endereço não pode ser nulo!');
validateStr($bairro, 30, 'Bairro inválido!');
notNull($bairro, 'O bairro não pode ser nulo!');
validateStr($cidade, 50, 'Cidade inválida!');
notNull($cidade, 'A cidade não pode ser nula!');
validateUf($uf, 'UF inválida!');
notNull($uf, 'A UF não pode ser nula!');
validateCep($cep, 'CEP inválido!');
notNull($cep, 'O CEP não pode ser nulo!');
validatePhone($telefone, 'Telefone inválido!');
validateStr($foto, 255, 'Foto inválida!');

$usuario = new Usuario(0, $email, $senha, $idNivelUsuario, $nome, $cpf, $endereco, $bairro, $cidade, $uf, $cep, $telefone, $foto, NULL);
$usuario->save();
if ($usuario->getResultSet() == 0) {
    echo 'Usuário cadastrado com sucesso!';
} else {
    echo 'Ocorreu um erro ao salvar o usuário!';
}

?>