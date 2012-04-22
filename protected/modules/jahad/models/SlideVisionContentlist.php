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
class SlideVisionContentlist extends IRDataModel
{
	/**
	 * @ManyToOne(targetEntity="SlideVision",inversedBy="SlideVisionContentlists")
	 */
	protected $SlideVision;
	public function getSlideVisionName()
	{
	try {return $this->SlideVision->getSlideVisionName();}catch(\Exception $ex){return '';}
	}
   public function setSlideVisionName($v){}
public function getSlideVisionID(){
	try {return $this->SlideVision->getid();}catch(\Exception $ex){return NULL;}
	}
	public function setSlideVisionID($v){
	try {
		$this->SlideVision=new SlideVision();
		$this->SlideVision= $this->SlideVision->GetByID($v);
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