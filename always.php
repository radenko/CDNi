<?php
    require_once('config.php');
    
    if (isset($config['libDir'])) set_include_path(get_include_path().PATH_SEPARATOR.$config['libDir']);

    require_once 'Interconnection.php';
    require_once 'CiscoCDNi.php';
    
    $intercon = new CiscoCDNi($config['CDN']); //Call construct function interconnection.php via CiscoCDNi.php
?>
