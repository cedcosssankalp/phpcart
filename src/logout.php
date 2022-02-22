<?php
session_start();
session_unset();
session_destroy();
echo "<h2>Logged Out Successfully</h2>";