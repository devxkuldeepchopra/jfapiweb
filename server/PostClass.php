<?php

class Post 

{

	private $conn;

	public function __construct($conn) 

	{

		$this->conn = $conn;

	}

	public function GetPost($page,$content,$rendPage){

		$limit = 0;

		$upto = $content;

		$data = array();

		if($page > 1){

			$limit = $page*$upto-$upto;

		}

		if($rendPage){

			$limit = $rendPage;

		}		

		$query = $this->conn->prepare("SELECT `Id`,`Title`,`Url`,`ImageUrl` FROM `post` LIMIT $limit,$upto");			

		$query->execute();

		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		$data['post'] = $result;	

        return $data;

	}

	public function GetPostByPath($url){		

		$query = $this->conn->prepare("SELECT * FROM `post` LEFT OUTER JOIN `postvideo` ON `post`.`Id` = `postvideo`.`PostId` WHERE `post`.`Url` = :url");	

		$query->bindParam(':url', $url);

		$query->execute();		

		$result = $query->fetchAll(PDO::FETCH_ASSOC);	

        return $result;

	}

	public function InsertPost($id,$title,$description,$post,$url,$ImageUrl,$video){
		$stmt1;
		if($id){
			$id = (int) $id;
			$stmt1 = $this->conn->prepare("UPDATE `post` SET `Title` = :title, `Description` = :description, `Post` = :post, `Url` = :url, `ImageUrl` = :imageUrl WHERE `post`.`Id` = :id");			
			$stmt2 = $this->conn->prepare("UPDATE `postvideo` SET `Video` = :video WHERE `postvideo`.`Id` = :id;");
			$stmt1->bindParam(':id', $id);
			$stmt2->bindParam(':id', $id);
		}
		else{
			$stmt1 = $this->conn->prepare("INSERT INTO `post` (`Title`, `Description`, `Post`, `Url`, `ImageUrl`) VALUES (:title, :description, :post, :url, :imageUrl)");
			$stmt2 = $this->conn->prepare("INSERT INTO `postvideo` (`PostId`, `Video`) VALUES (LAST_INSERT_ID(), :video);");
		}		
		$stmt1->bindParam(':title', $title);
		$stmt1->bindParam(':description', $description);
		$stmt1->bindParam(':post', $post);
		$stmt1->bindParam(':url', $url);
		$stmt1->bindParam(':imageUrl', $ImageUrl);
	
		$stmt2->bindParam(':video', $video);
		$stmt1->execute();
		$stmt2->execute();
		return  $this->conn->lastInsertId();	

	}

	public function UpdatePost(){}

	public function DeletePost($id){
		$query = $this->conn->prepare("DELETE FROM `postvideo` WHERE `PostId`= :id");
		$query->bindParam(':id', $id);
		$query->execute();
		$query = $this->conn->prepare("DELETE FROM `post` WHERE `Id`= :id");
		$query->bindParam(':id', $id);
		$query->execute();
		$count = $query->rowCount();
		return $count;

	}

	public function GetPostById(){}



	public function PostPagination(){

		$query = $this->conn->prepare("SELECT COUNT(*) as total FROM `post`");

		$query->execute();

		$count = $query->fetchAll(PDO::FETCH_ASSOC);

		$data = $count;

		return $data;

	}



	public function ImageUpload($image){

		$query = $this->conn->prepare("INSERT INTO `post` (`ImageUrl`) VALUES (:ImageUrl);");

		$query->bindParam(':ImageUrl', $image);

		$query->execute();

		return  $this->conn->lastInsertId();	

	}

}

?>