<?php

session_start();
session_unset();
session_destroy();

header('Location: /CH_module_a/C1');
