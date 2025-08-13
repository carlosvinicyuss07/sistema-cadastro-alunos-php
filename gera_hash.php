<?php

$senha = "cvsn1319";

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

echo "Senha original: " . $senha . "<br>";
echo "Senha hash: " . $senhaHash;
