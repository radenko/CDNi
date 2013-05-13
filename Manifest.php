<?php
    if (!isset($_REQUEST['contentID']))
        throw new Exception("content ID is required parameter");

    require_once 'always.php';    
    $intercon -> getManifest($_REQUEST['contentID']);
?>