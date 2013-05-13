<?php
    require_once 'Interconnection.php';
    require_once 'ciscoCDSClient.php';


class CiscoCDNi extends Interconnection {
    private $cdsmObj=null;
    
    private function cdsm () {
        global $config;
        
        if ( is_null($this -> cdsmObj) )
            $this -> cdsmObj = new CiscoCDSClient($config['CDN']['CDSm']);
        
        return $this -> cdsmObj;
    }
 
    function onInterconnectionComplete ($interconnection) {
        $interID = $interconnection['interconID'];
        $cdnID = $interconnection['CDNid'];
        $client = $this -> cdsm(); 
  
        $res = $client -> createContentOrigin('orig'.str_replace('.','',$cdnID),'147.175.15.42','ngncdn.cdn.ab.sk');
        foreach ($res as $name => $val) {
            $this->setStaticData($interID, "origin_$name", $val);
        }
        
        $originID = $this->getStaticData($interID,'origin_Id_');
        
        if (isset($originID) && $originID) {
            //echo "Creating service with origin: $originID<br/>";
            
            $res = $client -> createDeliveryService(str_replace('.','_',$cdnID),$originID);
            foreach ($res as $name => $val) {
                $this->setStaticData($interID, "service_$name", $val);
            }            
            //var_dump($res);
        }
	
		$deliveryID = $this->getStaticData($interID,'service_Id_');
					
		if (isset($deliveryID) && $deliveryID) {
            //echo "Adding SE to delivery service";
            
            $res = $client -> assignSEtoDS(str_replace('.','_',$cdnID), $deliveryID);
            
			foreach ($res as $name => $val) {
                $this->setStaticData($interID, "SEtoDS_$name", $val);
            }            
			
            var_dump($res);
        }
    }
    
    function getManifest($contentID) {
        header('Content-type:text/xml');
        
        $DBcontentID = $this->db->escape_string($contentID);
        $this->db->select('content','*',array('WHERE'=>"contentID='$DBcontentID'"));
        $content = $this->db->fetch_assoc();
        if (!$content) {
            throw new Exception ("Unable to find content with ID: $contentID");
        }
        
        $this->db->select('interconnections','*',array("WHERE" => "interconID=$content[interconID]"));
        $intercon = $this->db->fetch_assoc();
        $originServer = $intercon['CDNid'];
        $url=parse_url($content['url']);
        $baseName=basename($url['path']);
        
        echo "
          <CdnManifest> 
          <server name='$originServer'>  
             <host name='$url[host]' proto='$url[scheme]' port='80' /> 
          </server> 
          <item cdn-url='$baseName' server='$originServer'  src='$url[path]' type='prepos' playServer='http' ttl='300'/> 
          </CdnManifest>
        ";
    }
    
    function setContentBasicMetadata($CDNid,$contentID,$metadata) {
        $pres = parent::setContentBasicMetadata($CDNid, $contentID, $metadata);
        
        $client = $this -> cdsm();

        $DBcontentID = $this->db->escape_string($contentID);
        $this->db->select('content','*',array('WHERE'=>"contentID='$DBcontentID'"));
        $content = $this->db->fetch_assoc();
        if (!$content) {
            throw new Exception ("Unable to find content with ID: $contentID");
        }

        $this->db->select("interconnections","*",array('WHERE'=>"CDNid='".$this->db->escape_string($CDNid)."'"));
        if ($this->db->errno()) throw new Exception($this->db->error ());
        $intercon = $this->db->fetch_assoc();  
        $res = $client->addContent($intercon,$content);
        
        return true;
//        $deliveryServiceId = $this->getStaticData($interconID, 'service_Id_');
//        $res = $client ->addContent($deliveryServiceId, "http://147.175.15.41/CDNi/Manifest.php?contentID=$contentID",100000,100000);
    }
}

?>
