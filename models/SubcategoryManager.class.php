<?php
class SubCategoryManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db
	}
		public function create($name, $description, $image, Category $category){

	$subCategory = new SubCategory($this->db);

	 	 $valide = $subCategory->setDescription($description);
		if ($valide === true){

			$valide = $subCategory->setName($name);
			if ($valide === true){

				$valide = $subCategory->setImage($image);
				if ($valide === true){

					$valide = $subCategory->setCategory($category);
					if ($valide === true){

							$description = mysqli_real_escape_string($this->db, $subCategory->getDescription());
							$name = mysqli_real_escape_string($this->db, $subCategory->getName());
							$image = mysqli_real_escape_string($this->db, $subCategory->getImage());
							$id_category = $subCategory->getCategory()->getId();
							$query = "INSERT INTO subcategory (description, name, image, id_category) VALUES ('".$description."', '".$name."', '".$image."', '".$id_category."')";
							echo $query;
							$res = mysqli_query($this->db, $query);
							if ($res)
							{
								$id = mysqli_query($this->db);
								if ($id) 
								{
									return $this -> findById($id); 	
								} 
								else
								{	
									throw new Exception("internal server error");
								}
							}
					}
					else
					{
						return $valide;
					}
				}
				else
				{
					return $valide;
				}
			}
			else
			{
				return $valide;
			}
		}
		else
		{
			return $valide;
		}
	 }


	 public function delete(SubCategory $subCategory)
	 {
	 	$id = $subCategory->getId();
	 	$query = "DELETE FROM subcategory WHERE id='".$id."'";
	 	$res = mysqli_query($this->db, $query);
	 	if($res)
	 	{
	 		return true
	 	}


	 }











}



?>