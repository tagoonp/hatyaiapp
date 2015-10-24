<?php
$options = [
    'cost' => 11,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];
echo password_hash("1234", PASSWORD_BCRYPT, $options)."\n";
?>
