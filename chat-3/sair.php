<?php
session_start();

unset($_SESSION['usuario_id']);
unset($_SESSION['nome']);
header('Location: index.php');