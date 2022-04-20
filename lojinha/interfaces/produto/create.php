<?php

include_once '../../classes/Produto.class.php';
include_once '../../functions/validation.php';
include_once '../../functions/textTransform.php';

use classes\Produto as Produto;

$fabricante = isset($_POST['fabricante']) ? $_POST['fabricante'] : NULL;
$nome = isset($_POST['nome']) ? $_POST['nome'] : NULL;
$marca = isset($_POST['marca']) ? $_POST['marca'] : NULL;
$modelo = isset($_POST['modelo']) ? $_POST['modelo'] : NULL;
$idCategoria = isset($_POST['idCategoria']) ? $_POST['idCategoria'] : NULL;
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : NULL;
$unidadeMedida = isset($_POST['unidadeMedida']) ? $_POST['unidadeMedida'] : NULL;
$largura = anyToFloat(isset($_POST['largura']) ? $_POST['largura'] : NULL);
$altura = anyToFloat(isset($_POST['altura']) ? $_POST['altura'] : NULL);
$profundidade = anyToFloat(isset($_POST['profundidade']) ? $_POST['profundidade'] : NULL);
$peso = anyToFloat(isset($_POST['peso']) ? $_POST['peso'] : NULL);
$cor = isset($_POST['cor']) ? $_POST['cor'] : NULL;

validateStr($fabricante, 100, 'Fabricante inválido!');
notNull($fabricante, 'O fabricante não pode ser nulo!');
validateStr($nome, 100, 'Nome inválido!');
notNull($nome, 'O nome não pode ser nulo!');
validateStr($marca, 100, 'Marca inválida!');
notNull($marca, 'A marca não pode ser nula!');
validateStr($modelo, 100, 'Modelo inválido!');
notNull($modelo, 'O modelo não pode ser nulo!');
validateInt($idCategoria, 11, 'ID da categoria inválido!');
notNull($idCategoria, 'O ID da categoria não pode ser nulo!');
validateStr($descricao, 0, 'Descrição inválida!');
validateStr($unidadeMedida, 15, 'Unidade de medida inválida!');
validateDecimal($largura, 10, 3, 'Largura inválida!');
notNull($largura, 'A largura não pode ser nula!');
validateDecimal($altura, 10, 3, 'Altura inválida!');
notNull($altura, 'A altura não pode ser nula!');
validateDecimal($profundidade, 10, 3, 'Profundidade inválida!');
notNull($profundidade, 'A profundidade não pode ser nula!');
validateDecimal($peso, 10, 3, 'Peso inválido!');
notNull($peso, 'O peso não pode ser nulo!');
validateStr($cor, 7, 'Cor inválida!');
notNull($cor, 'A cor não pode ser nula!');


$produto = new Produto(0, $fabricante, $nome, $marca, $modelo, $idCategoria, $descricao, $unidadeMedida, $largura, $altura, $profundidade, $peso, $cor);
$produto->save();
if ($produto->getResultSet() == 0) {
    echo 'Produto cadastrado com sucesso!';
} else {
    echo 'Ocorreu um erro ao salvar o produto!';
}

?>