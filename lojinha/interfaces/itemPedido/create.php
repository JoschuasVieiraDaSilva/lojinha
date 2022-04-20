<?php

include_once '../../classes/ItemPedido.class.php';
include_once '../../functions/validation.php';
include_once '../../functions/textTransform.php';

use classes\ItemPedido as ItemPedido;

$ordem = isset($_POST['ordem']) ? $_POST['ordem'] : NULL;
$idPedido = isset($_POST['idPedido']) ? $_POST['idPedido'] : NULL;
$idEstoque = isset($_POST['idEstoque']) ? $_POST['idEstoque'] : NULL;
$qtdItem = isset($_POST['qtdItem']) ? $_POST['qtdItem'] : NULL;
$dtDevolucao = isset($_POST['dtDevolucao']) ? $_POST['dtDevolucao'] : NULL;
$motivoDevolucao = isset($_POST['motivoDevolucao']) ? $_POST['motivoDevolucao'] : NULL;

validateInt($ordem, 11, 'Ordem inválida!');
notNull($ordem, 'A ordem não pode ser nula!');
validateInt($idPedido, 11, 'ID do pedido inválido!');
notNull($idPedido, 'O ID do pedido não pode ser nulo!');
validateInt($idEstoque, 11, 'ID do estoque inválido!');
notNull($idEstoque, 'O ID do estoque não pode ser nulo!');
validateInt($qtdItem, 11, 'Quantidade de itens inválida!');
notNull($qtdItem, 'A quantidade de itens não pode ser nula!');
validateDate($dtDevolucao, 'Data de devolução inválida!');
validateStr($motivoDevolucao, 0, 'Motivo de devolução inválido!');

$itemPedido = new ItemPedido(0, $ordem, $idPedido, $idEstoque, $qtdItem, $dtDevolucao, $motivoDevolucao);
$itemPedido->save();
if ($itemPedido->getResultSet() == 0) {
    echo 'Institucional cadastrado com sucesso!';
} else {
    echo 'Ocorreu um erro ao salvar o institucional!';
}

?>