<?php
include 'config/config.php';

User::endSession();
header('Location: ./');
