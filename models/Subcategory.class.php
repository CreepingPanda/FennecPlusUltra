<?php
class SubCategory
{
	private $db;
	private $id;
	private $id_category;
	private $category;
	private $name;
	private $description;
	private $image;
	


	public function __construct($db)
	{
		$this->db = $db;
	}
	

	public function getId()
	{
		return $this->id;
	}
	public function getCategory()
	{
		if (!$this->category)
		{
			$categoryManager = new CategoryManager($this->db);
			$this->category = $categoryManager->findById($this->id_category);
		}
		return $this->category;
	}

	public function getName()
	{
		return $this->name;
	}
	public function getDescription()
	{
		return $this->description;
	}
	public function getImage()
	{
		return $this->image;
	}

	public function setCategory(Category $category)
	{
		$this->id_category = $category->getId();
		return true;
	}
	public function setName($name)
	{
		if (strlen($name) > 1 && strlen($name) < 255)
		{
			$this->name = $name;
			return true;
		}
		else
		{
			throw new Exception("text incorrect");
			
			
		}
	}
	public function setImage($image)
	{
		if (strlen($image) > 1 && strlen($image) < 511)
		{
			$this->image = $image;
			return true;
		}
		else
		{
			throw new Exception("image incorect");
			
		}
	}
	public function setDescription($description)
	{
		if (strlen($description) > 1 && strlen($description) < 511)
		{
			$this->description = $description;
			return true;
		}
		else
		{
			throw new Exception("text incorrect");
		}
	}

}
?>