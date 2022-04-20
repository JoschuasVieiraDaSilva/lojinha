<?php

include_once '../../classes/NivelUsuario.class.php';
include_once '../../functions/validation.php';
include_once '../../functions/textTransform.php';

use classes\NivelUsuario as NivelUsuario;

$nivel = isset($_POST['nivel']) ? $_POST['nivel'] : NULL;

validateStr($nivel, 20, 'Nível de usuário inválido!');
notNull($nivel, 'O nível de usuário não pode ser nulo!');

$nivelUsuario = new NivelUsuario(0, $nivel);
$nivelUsuario->save();
if ($nivelUsuario->getResultSet() == 0) {
    echo 'Nível de usuário cadastrado com sucesso!';
} else {
    echo 'Ocorreu um erro ao salvar o nível de usuário!';
}

?>