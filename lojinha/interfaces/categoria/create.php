<?php

include_once '../../classes/Categoria.class.php';
include_once '../../functions/validation.php';

use classes\Categoria as Categoria;

$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : NULL;

validateStr($descricao, 30, 'Descrição inválida!');
notNull($descricao, 'A descrição não pode ser nula!');

$categoria = new Categoria(0, $descricao);
$categoria->save();

if ($categoria->getResultSet() == 0) {
    echo 'Categoria cadastrada com sucesso!';   
} else {
    echo 'Ocorreu um erro ao salvar a categoria!';
}

?>