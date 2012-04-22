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
class RadioContentList extends IRDataModel
{
	/**
	 * @ManyToOne(targetEntity="RadioSchool",inversedBy="ContentList")
	 */
	protected $RadioSchool;
	public function getRadioSchoolName()
	{
	try {return $this->RadioSchool->getRadioSchoolName();}catch(\Exception $ex){return '';}
	}
   public function setRadioSchoolName($v){}
public function getRadioSchoolID(){
	try {return $this->RadioSchool->getid();}catch(\Exception $ex){return NULL;}
	}
	public function setRadioSchoolID($v){
	try {
		$this->RadioSchool=new RadioSchool();
		$this->RadioSchool= $this->RadioSchool->GetByID($v);
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