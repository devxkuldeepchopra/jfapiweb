<?php 

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: POST");

header("Access-Control-Max-Age: 3600");

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$model; 

if($data = json_decode(file_get_contents("php://input"))){

	$model = $data;

}

	require_once('PostClass.php');

	include 'conn.php';

	$Post = new Post($conn);

	$action="";

	if (isset($model)) {
		$action=$model->action;
	}

	if (isset($_POST["action"])) {
		$action=$_POST["action"];
	}

	if (isset($_GET['action'])) { 

		$action = $_GET['action']; 

	}

	if($action)
	{

		if ($action == 'GetPost') {
			$page = $model ? $model->page : $_POST["page"];
			$content = $model ? $model->content : $_POST["content"];
			$randPage = $model ? $model->randPage : $_POST["randPage"];
			$Data = $Post->GetPost($page,$content,$randPage);
			echo json_encode($Data);

		}

		if ($action == 'GetPostByUrl') {
			$url = $model ? $model->url : $_POST["url"];
			$Data = $Post->GetPostByPath($url);
			echo json_encode($Data);

		}

		if ($action == 'InsertPost') {
			if ( $_FILES['file']['error'] > 0 ){
				$Data  = $_FILES['file']['error'];
				echo json_encode($Data);
			}
			else {
			   $d =	date("Y-m-d-h-i-s");
			   $newFile = $_POST['filename'].$d.".".$_POST['extension'];
				if(move_uploaded_file($_FILES['file']['tmp_name'], '../web/src/assets/uploads/' . $newFile))
				{
					$Data = $Post->InsertPost($_POST['id'],$_POST['title'],$_POST['description'],$_POST['mypost'],$_POST['url'],$newFile,$_POST['video']);
					echo json_encode($Data);
				}

			}	

		}

		if ($action == 'UpdatePost') {

			$Data = $Post->UpdatePost();

			echo json_encode($Data);

		}

		if ($action == 'GetPostById') {

			$Data = $Post->GetPostById();

			echo json_encode($Data);

		}

		if ($action == 'DeletePost') {


			$Data = $Post->DeletePost($model->id);

			echo json_encode($Data);

		}

		if ($action == 'PostPagination') {

			$Data = $Post->PostPagination();

			echo json_encode($Data);

		}

	}

	

?>