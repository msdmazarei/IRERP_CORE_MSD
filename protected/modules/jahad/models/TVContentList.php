<?php
namespace IRERP\modules\jahad\models;

use IRERP\Basics\Models\IRDataModel;

use IRERP\Basics\Models\BasicNamedClass;
use IRERP\Basics\Annotations\scField;

/**
 * @Entity
 * 
 * @author masoud
 *
 */
class TVContentList extends IRDataModel
{
	/**
	 * @ManyToOne(targetEntity="TVSchool",inversedBy="ContentList")
	 */
	protected $TVSchool;
	public function getTVSchoolName()
	{
	try {return $this->TVSchool->getTVSchoolName();}catch(\Exception $ex){return '';}
	}
   public function setTVSchoolName($v){}
public function getTVSchoolID(){
	try {return $this->TVSchool->getid();}catch(\Exception $ex){return NULL;}
	}
	public function setTVSchoolID($v){
	try {
		$this->TVSchool=new TVSchool();
		$this->TVSchool= $this->TVSchool->GetByID($v);
	}catch(\Exception $ex){}
	}
	/**
	 * @Column(type="string",length=50)
	 */
	protected $ContentTitle;
	/**
	 * 
	 * @scField(name="ContentTitle",type="string",title="آیتم",DoctrineField="ContentTitle")
	 */
	public function getContentTitle(){
	try {return $this->ContentTitle;}catch(\Exception $ex){return '';}
	}
	public function setContentTitle($v){$this->ContentTitle=$v;}
	
	/**
	 * @Column(type="string",length=500)
	 */
	protected $Description;
	/**
	 * 
	 * @scField(name="Description",type="string",title="توضیح",DoctrineField="Description")
	 */
	public function getDescription(){
	try {return $this->Description;}catch(\Exception $ex){return '';}
	}
	public function setDescription($v){$this->Description=$v;}
	
}
?>