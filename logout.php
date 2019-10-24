<?php
session_start();
unset($_SESSION["firstname"]);
header("Location: content");