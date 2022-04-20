<?php

include_once '../../classes/Pedido.class.php';
include_once '../../functions/validation.php';
include_once '../../functions/textTransform.php';

use classes\Pedido as Pedido;

$idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : NULL;
$dtPedido = isset($_POST['dtPedido']) ? $_POST['dtPedido'] : NULL;
$dtPagamento = isset($_POST['dtPagamento']) ? $_POST['dtPagamento'] : NULL;
$dtNotaFiscal = isset($_POST['dtNotaFiscal']) ? $_POST['dtNotaFiscal'] : NULL;
$notaFiscal = isset($_POST['notaFiscal']) ? $_POST['notaFiscal'] : NULL;
$dtEnvio = isset($_POST['dtEnvio']) ? $_POST['dtEnvio'] : NULL;
$dtRecebimento = isset($_POST['dtRecebimento']) ? $_POST['dtRecebimento'] : NULL;
$tipoFrete = isset($_POST['tipoFrete']) ? $_POST['tipoFrete'] : NULL;
$rastreioFrete = isset($_POST['rastreioFrete']) ? $_POST['rastreioFrete'] : NULL;
$entregaendereco = isset($_POST['entregaendereco']) ? $_POST['entregaendereco'] : NULL;
$entregaNumero = isset($_POST['entregaNumero']) ? $_POST['entregaNumero'] : NULL;
$entregaCompl = isset($_POST['entregaCompl']) ? $_POST['entregaCompl'] : NULL;
$entregaBairro = isset($_POST['entregaBairro']) ? $_POST['entregaBairro'] : NULL;
$entregaCidade = isset($_POST['entregaCidade']) ? $_POST['entregaCidade'] : NULL;
$entregaUF = isset($_POST['entregaUF']) ? $_POST['entregaUF'] : NULL;
$entregaCEP = anyToCep(isset($_POST['entregaCEP']) ? $_POST['entregaCEP'] : NULL);
$entregaTelefone = anyToPhone(isset($_POST['entregaTelefone']) ? $_POST['entregaTelefone'] : NULL);
$entregaRefer = isset($_POST['entregaRefer']) ? $_POST['entregaRefer'] : NULL;
$valorTotal = anyToFloat(isset($_POST['valorTotal']) ? $_POST['valorTotal'] : NULL);
$qtdItems = isset($_POST['qtdItems']) ? $_POST['qtdItems'] : NULL;
$dtDevolucao = isset($_POST['dtDevolucao']) ? $_POST['dtDevolucao'] : NULL;
$motivoDevolucao = isset($_POST['motivoDevolucao']) ? $_POST['motivoDevolucao'] : NULL;

validateInt($idUsuario, 11, 'ID do usuário inválido!');
notNull($idUsuario, 'O ID do usuário não pode ser nulo!');
validateDate($dtPedido, 'Data do pedido inválida!');
notNull($dtPedido, 'A data do pedido não pode ser nula!');
validateDate($dtPagamento, 'Data do pagamento inválida!');
validateDate($dtNotaFiscal, 'Data da nota fiscal inválida!');
validateStr($notaFiscal, 0, 'Nota fiscal inválida!');
validateDate($dtEnvio, 'Data do envio inválida!');
validateDate($dtRecebimento, 'Data do recebimento inválida!');
validateFrete($tipoFrete, 'Tipo de frete inválido!');
notNull($tipoFrete, 'O tipo de frete não pode ser nulo!');
validateStr($rastreioFrete, 255, 'Rastreio do frete inválido!');
validateStr($entregaendereco, 50, 'Endereço de entrega inválido!');
notNull($entregaendereco, 'O endereço de entrega não pode ser nulo!');
validateStr($entregaNumero, 10, 'Número de entrega inválido!');
notNull($entregaNumero, 'O número de entrega não pode ser nulo!');
validateStr($entregaCompl, 50, 'Complemento de entrega inválido!');
notNull($entregaCompl, 'O complemento de entrega não pode ser nulo!');
validateStr($entregaBairro, 30, 'Bairro de entrega inválido!');
notNull($entregaBairro, 'O bairro de entrega não pode ser nulo!');
validateStr($entregaCidade, 50, 'Cidade de entrega inválido!');
notNull($entregaCidade, 'A cidade de entrega não pode ser nula!');
validateUf($entregaUF, 'UF de entrega inválida!');
notNull($entregaUF, 'A UF de entrega não pode ser nula!');
validateCep($entregaCEP, 'CEP de entrega inválido!');
notNull($entregaCEP, 'O CEP de entrega não pode ser nulo!');
validatePhone($entregaTelefone, 'Telefone de entrega inválido!');
validateStr($entregaRefer, 255, 'Referência de entrega inválida!');
validateDecimal($valorTotal, 12, 2, 'Valor total inválido!');
notNull($valorTotal, 'O valor total não pode ser nulo!');
validateInt($qtdItems, 11, 'Quantidade de itens inválida!');
notNull($qtdItems, 'A quantidade de itens não pode ser nula!');
validateDate($dtDevolucao, 'Data de devolução inválida!');
validateStr($motivoDevolucao, 0, 'Motivo de devolução inválido!');

$pedido = new Pedido(0, $idUsuario, $dtPedido, $dtPagamento, $dtNotaFiscal, $notaFiscal, $dtEnvio, $dtRecebimento, $tipoFrete, $rastreioFrete, $entregaendereco, $entregaNumero, $entregaCompl, $entregaBairro, $entregaCidade, $entregaUF, $entregaCEP, $entregaTelefone, $entregaRefer, $valorTotal, $qtdItems, $dtDevolucao, $motivoDevolucao);
$pedido->save();
if ($pedido->getResultSet() == 0) {
    echo 'Pedido cadastrado com sucesso!';
} else {
    echo 'Ocorreu um erro ao salvar o pedido!';
}

?>