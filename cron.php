<?php
    echo "CiscoCDNi Cron\n";

    require_once 'always.php'; //Creates new $intercon object
    $intercon -> cron(); //Calls cron function of Interconnection.php via CiscoCDNi.php
?>