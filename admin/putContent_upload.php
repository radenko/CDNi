<?
    require_once 'header.php';
    require_once 'db.php';

    var_dump($_REQUEST,$_FILES);
    
    function processFileUpload($file) {
	global $config,$db;
	
	var_dump($file,$db);
    
	move_uploaded_file($file['tmp_name'], $config['CDN']['paths']['content'].'/'.$file['name']);
    }
    
    foreach ($_FILES as $file) {
	switch ($file['error']) {
		case UPLOAD_ERR_OK:
			processFileUpload($file);
		break;
	}
    }
    
    require_once 'footer.php';
?>