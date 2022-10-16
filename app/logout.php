<?php
session_start();

unset($_SESSION['username'], $_SESSION['isAdmin'], $_SESSION['userId']);

header('Location: /');
