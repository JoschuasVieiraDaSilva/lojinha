<?php

include_once '../../classes/Institucional.class.php';
include_once '../../functions/validation.php';
include_once '../../functions/textTransform.php';

use classes\Institucional as Institucional;

$nome = isset($_POST['nome']) ? $_POST['nome'] : NULL;
$cpf_cnpj = anyToCpf(isset($_POST['cpf_cnpj']) ? $_POST['cpf_cnpj'] : NULL);
$tipoPessoa = isset($_POST['tipoPessoa']) ? $_POST['tipoPessoa'] : NULL;
$endereco = isset($_POST['endereco']) ? $_POST['endereco'] : NULL;
$bairro = isset($_POST['bairro']) ? $_POST['bairro'] : NULL;
$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : NULL;
$uf = isset($_POST['uf']) ? $_POST['uf'] : NULL;
$cep = anyToCep(isset($_POST['cep']) ? $_POST['cep'] : NULL);
$telefone = anyToPhone(isset($_POST['telefone']) ? $_POST['telefone'] : NULL);
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$logo = isset($_POST['logo']) ? $_POST['logo'] : NULL;

validateStr($nome, 50, 'Nome inválido!');
notNull($nome, 'O nome não pode ser nulo!');
validateCpf($cpf_cnpj, 'CPF ou CNPJ inválido!');
notNull($cpf_cnpj, 'O CPF ou CNPJ não pode ser nulo!');
validatePersonType($tipoPessoa, 'Tipo de pessoa inválido!');
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
validateEmail($email, 'Email inválido!');
validateStr($email, 100, 'Email muito grande!');
notNull($email, 'O email não pode ser nulo!');
validateStr($logo, 255, 'Logo inválida!');

$institucional = new Institucional(0, $nome, $cpf_cnpj, $tipoPessoa, $endereco, $bairro, $cidade, $uf, $cep, $telefone, $email, $logo);
$institucional->save();
if ($institucional->getResultSet() == 0) {
    echo 'Institucional cadastrado com sucesso!';
} else {
    echo 'Ocorreu um erro ao salvar o institucional!';
}

?>