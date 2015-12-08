<?php
class SubCategory
{
	private $db;
	private $id;
	private $id_category;
	private $name;
	private $description;
	private $image;
	public function__construct($db)
	{
		$this->db = $db;
	}
	public function getId()
	{
		return $this->id
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

	public function getCategory()
	{
		return $this->id_category;
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
		if (strlen($name) > 1 && strlen($name) < 31)
		{
			$this->name = $name;
			return true;
		}
		else
		{
			return "text incorrect";
		}
	}
	public function setImage($image)
	{
		if (strlen($image) > 1 && strlen($image) < 256)
		{
			$this->image = $image;
			return true;
		}
		else
		{
			return "image incorect";
		}
	}
	public function setDescription($description)
	{
		if (strlen($description) > 1 && strlen($description) < 256)
		{
			$this->description = $description;
			return true;
		}
		else
		{
			return "text incorrect";
		}
	}

}