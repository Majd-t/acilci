<?php

session_start();
session_destroy(); // وقف الجلسة
header("Location: ../register/login.php");