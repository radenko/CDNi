<?php
    require_once 'always.php';
  
    $res = $intercon -> setContentBasicMetadata(
        'cdn.ngnlab.eu',
        'content2',
        array('title'=>'content2')        
    );
    
    var_dump($res);
    
/*    $intercon -> onInterconnectionComplete(array(
        'interconID' => 1,
        'CDNid' => 'cdn.ngnlab.eu',
        'peerURL' => 'http://147.175.15.42/CDNi/SOAP.php',
        'peerStatus' => null,
        'localStatus' => 'complete'
    ));*/
//    $intercon -> setOffer('CiscoCDN', 'http://212.89.230.69/CiscoCDNi');
?>
