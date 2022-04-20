<?php

include_once '../../classes/Estoque.class.php';
include_once '../../functions/validation.php';
include_once '../../functions/textTransform.php';

use classes\Estoque as Estoque;

$idProduto = isset($_POST['idProduto']) ? $_POST['idProduto'] : NULL;
$dtEntrada = isset($_POST['dtEntrada']) ? $_POST['dtEntrada'] : NULL;
$quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : NULL;
$dtFabricacao = isset($_POST['dtFabricacao']) ? $_POST['dtFabricacao'] : NULL;
$dtVencimento = isset($_POST['dtVencimento']) ? $_POST['dtVencimento'] : NULL;
$nfCompra = isset($_POST['nfCompra']) ? $_POST['nfCompra'] : NULL;
$precoCompra = anyToFloat(isset($_POST['precoCompra']) ? $_POST['precoCompra'] : NULL);
$icmsCompra = anyToFloat(isset($_POST['icmsCompra']) ? $_POST['icmsCompra'] : NULL);
$precoVenda = anyToFloat(isset($_POST['precoVenda']) ? $_POST['precoVenda'] : NULL);
$qtdVendida = isset($_POST['qtdVendida']) ? $_POST['qtdVendida'] : NULL;
$qtdOcorrencia = isset($_POST['qtdOcorrencia']) ? $_POST['qtdOcorrencia'] : NULL;
$ocorrencia = isset($_POST['ocorrencia']) ? $_POST['ocorrencia'] : NULL;

validateInt($idProduto, 11, 'ID do produto inválido!');
notNull($idProduto, 'O ID do produto não pode ser nulo!');
validateDate($dtEntrada, 'Data de entrada inválida!');
notNull($dtEntrada, 'A data de entrada não pode ser nula!');
validateInt($quantidade, 11, 'Quantidade inválida!');
notNull($quantidade, 'A quantidade não pode ser nula!');
validateDate($dtFabricacao, 'Data de fabricação inválida');
validateDate($dtVencimento, 'Data de vencimento inválida');
validateStr($nfCompra, 0, 'Nota fiscal inválida!');
validateDecimal($precoCompra, 15, 2, 'Preço da compra inválido!');
notNull($precoCompra, 'O preço da compra não pode ser nulo!');
validateDecimal($icmsCompra, 15, 2, 'ICMS da compra inválido!');
notNull($icmsCompra, 'O ICMS não pode ser nulo!');
validateDecimal($precoVenda, 15, 2, 'Preço da venda inválido!');
notNull($precoVenda, 'O preço da venda não pode ser nulo!');
validateInt($qtdVendida, 11, 'Quantidade vendida inválida!');
notNull($qtdVendida, 'A quantidade vendida não pode ser nula!');
validateInt($qtdOcorrencia, 11, 'Quantidade de ocorrência inválida!');
validateStr($ocorrencia, 1024, 'Ocorrência inválida!');

$estoque = new Estoque(0, $idProduto, $dtEntrada, $quantidade, $dtFabricacao, $dtVencimento, $nfCompra, $precoCompra, $icmsCompra, $precoVenda, $qtdVendida, $qtdOcorrencia, $ocorrencia);
$estoque->save();

if ($estoque->getResultSet() == 0) {
    echo 'Estoque cadastrado com sucesso!';
} else {
    echo 'Ocorreu um erro ao salvar o estoque!';
}

?>