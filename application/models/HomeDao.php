<?php
set_include_path($_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/'.get_include_path());
include_once 'db_connection.php';
include_once 'BaseDao.php';
include_once 'ContentAttachmentDao.php';
include_once '../services/CasaService.php';

/**
* 
*/
class HomeDao extends BaseDao{
	
	public function create($recomms){
		$recom_arr = explode(';', $recomms);
		$data = array();
		foreach ($recom_arr as $value) {
			$casaService = new CasaService();
			if (!empty($value)) {
				$casa = $casaService->getWholeCasa($value);
				$casa_arr = array(
					'id' => $casa->id,
					'name' => $casa->name,
					'pic' => $casa->main_photo_name,
					'theme' => $casa->tags[0]->name
					);
				array_push($data, $casa_arr);
			}
		}
		var_dump($data);

	}
}

?>