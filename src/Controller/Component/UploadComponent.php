<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Exception\Exception;

class UploadComponent extends Component
{
	public $max_files=3;

	public function uploadMany( $data = null, $subfolder = "" )
	{
		$this->log( "Loaded: ".count($data).". ".$data[0]);
		if( !empty( $data) ){
			if (count ($data) > $this->max_files)
			{
				throw new Exception("To many files. Max number is {$this->max_files}", 1);
			}

			foreach ($data as $file) {
				$this->upload($file,$subfolder);
			}

		}
	}

	public function upload( $file = null, $subfolder = "",$name = null)
	{
		if(!empty($subfolder))
			$subfolder = DS.$subfolder;

		$subdir = 'uploads'.$subfolder;

		//$filename = $name==null ? $file['name']:($name.".".substr(strrchr($filename,'.'),1));
		$filename= uniqid()."-".$file['name'];
		$file_tmp_name = $file['tmp_name'];
		$dir = WWW_ROOT.'img'.DS.$subdir;
		$allowed = array('png','jpg','jpeg','bmp','gif');
		if(!in_array(substr(strrchr($filename,'.'),1), $allowed))
		{
			throw new Exception("This file is not allowed", 1);
		}
		elseif(is_uploaded_file($file_tmp_name)){
			move_uploaded_file($file_tmp_name,$dir.DS.$filename);
		}

		return str_replace("\\","/",$subdir.DS.$filename);
	}

	public function delete($fileName)
	{
		unlink(WWW_ROOT.'img'.DS.$fileName);
	}
}

?>