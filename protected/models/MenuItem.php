<?php
namespace IRERP\models;

use IRERP\Basics\Models\IRDataModel,
	 IRERP\Basics\Annotations\scField;

/**
 * @Entity @Table(name="MenuItem")
 */
class MenuItem extends IRDataModel
{
	/**
	 * @Column(type="string",length=50)
	 * @var string
	 */
	protected $Title;
	
	/**
	 * @Column(type="string",length="1500")
	 * Enter Icon for MenuItem
	 * @var string
	 */
	protected $Icon;
	
	/**
	 * @ManyToOne(targetEntity="MenuItem",inversedBy="Children")
	 * @var MenuItem
	 */
	protected $Parent;
	
	/**
	 * @OneToMany(targetEntity="MenuItem",mappedBy="Parent")
	 * @var MenuItem[]
	 */
	protected $Children;
	
	/**
	 * @Column(type="string",length=500)
	 */
	protected $Command;
	
	/**
	 * 
	 * BL Functions
	 * @scField(name="Title",DoctrineField="Title",
	 * 			type="string",length="100",title="عنوان منو")
	 */
	public function getTitle(){return $this->Title;}
	public function setTitle($value){$this->Title=$value;}
	/**
	 * 
	 * @scField(name="IconPath",DoctrineField="Icon",
	 * 			type="string",length="500",title="مسیر آیکون")
	 */
	public function getIcon(){return $this->Icon;}
	public function setIcon($value){$this->Icon=$value;}
	/**
	 * @scField(name="Command",DoctrineField="Command",type="string",length=200,title="دستور منو") 
	 */
	public function getCommand(){return $this->Command;}
	public function setCommand($value){$this->Command=$value;}
	
	
	/**
	 * 
	 * @scField(name="ParentTitle",DoctrineField="Parent.Title",type="string",length=100,title="منوی پدر")
	 */
	public function getParentTitle(){
		if ($this->getParent()==null) return '';
		return $this->getParent()->getTitle();
	}
	public function setParentTitle($v){}
	/**
	 * @scField(name="ParentId",DoctrineField="Parent",foreignKey="Id",hidden=true)
	 * Enter description here ...
	 */	
	public function getParentId(){
		if (($parent = $this->getParent()) == null)
			return NULL;
		else
			return $parent->getid();
	}
	public function setParentById($value){
		//Check That there is an object with this ID
		$parent = $this->GetByID($value);
		if($parent!=NULL)
			$this->setParent($parent);
		else
			$this->setParent(NULL);
	}
	
	/**
	 * @scField(name="IsSubmenu", type="bool") 
	 * @return bool
	 */
	public function getIsSubmenu(){
		return (count($this->Children) > 0);
	}
	public function getChildren(){return $this->Children;}
	public function setChildren($value){$this->Children=$value;}
	
	public function getParent(){return $this->Parent;}
	public function setParent($value){$this->Parent=$value;}
	
}
?>
