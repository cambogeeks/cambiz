
<?php
	session_start();
	date_default_timezone_set('Asia/Bangkok');
	require_once 'class.user.php';
	$user_home = new USER();
	 
	// initilize all variable
	$params = $columns = $totalRecords = $data = array();

	$params = $_REQUEST;

	//define index of column
	$columns = array( 
		0 =>'id',
		1 =>'text_title', 
		2 => 'description',
		3 => 'photo'
	);

	$where = $sqlTot = $sqlRec = "";

	// check search value exist
	if( !empty($params['search']['value']) ) {   
		$where .=" WHERE ";
		$where .=" ( text_title LIKE '".$params['search']['value']."%' ";    
		$where .=" OR description LIKE '".$params['search']['value']."%' ";

		$where .=" OR photo LIKE '".$params['search']['value']."%' )";
	}

	// getting total number records without any search
	$sql = "SELECT * FROM `content` ";
	$sqlTot .= $sql;
	$sqlRec .= $sql;
	//concatenate search sql if value exist
	if(isset($where) && $where != '') {

		$sqlTot .= $where;
		$sqlRec .= $where;
	}


 	$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";

	$queryTot = $user_home->runQuery($sqlTot);
	$queryTot-> execute();

	$totalRecords = $queryTot->fetchColumn(); 

	$queryRecords =$user_home->runQuery($sqlRec);
	$queryRecords -> execute();

	//iterate on results row and create new index array of data
	while( $row = $queryRecords->fetch(PDO::FETCH_ASSOC)) { 
		$data[] = $row;
	}	

	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $data   // total data array
			);

	echo json_encode($json_data);  // send data as json format
?>
	