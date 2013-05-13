<?php
    $config=array();
    $config['CDN'] = array();
    
    $config['libDir']=$_SERVER['DOCUMENT_ROOT'].'/CDNi/libs';
    $config['CDN']['id']='CiscoCDN';
    $config['CDN']['capabilities']='Uplne secky capabilities';
    $config['CDN']['footprint']=array('10.0.2.0/24','10.0.4.0/24','10.0.6.0/24');
    $config['CDN']['APIurl']='http://147.175.15.41/CDNi/SOAP.php';
    $config['CDN']['paths']['content'] = '/var/lib/cdn';

    $config['CDN']['databaseHost']='localhost';
    $config['CDN']['databaseName']='CDN';
    $config['CDN']['databaseUser']='CDN';

    $config['CDN']['CDSm']['host']='cdsm.cdn.ab.sk';
    $config['CDN']['CDSm']['port']=8443;
    $config['CDN']['CDSm']['userName'] = "admin";
    $config['CDN']['CDSm']['password'] = "Pok4hontas_";

    $config['CDN']['i']=array(); //Array in array $config['CDN']

    $config['CDN']['i']['databaseHost']='localhost';
    $config['CDN']['i']['databaseName']='CDNi';
    $config['CDN']['i']['databaseUser']='CDNi';
//    $config['CDN']['i']['databasePass']='';
    $config['CDN']['i']['peers'][0]['APIurl']='http://147.175.15.42/CDNi/SOAP.php';
    $config['CDN']['i']['peers'][0]['weight']=1.0;

    define ("MODE_DEBUG",true);
?>
