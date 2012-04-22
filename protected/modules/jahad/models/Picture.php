<?php
namespace IRERP\modules\jahad\models;

use IRERP\modules\jahad\models\PictureType;
use Symfony\Component\Console\Input\StringInput;
use IRERP\Basics\Models\IRDataModel;
use IRERP\Basics\Annotations\scField;
use IRERP\Basics\Annotations\UI\IRUseInClientDS,
IRERP\Basics\Annotations\UI\IRClientName,
IRERP\Basics\Annotations\UI\IRTitle,
IRERP\Basics\Annotations\UI\IRPropertyType,
IRERP\Basics\Annotations\UI\IRParentGridMember,
IRERP\Basics\Annotations\UI\IRPickListMember,
IRERP\Basics\Annotations\UI\IRUseAsProfile,
IRERP\Basics\Annotations\UI\IRRequire
;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Id;
/**
 * 
 * Enter description here ...
 * @author man-prim
 *@Entity
 */
class Picture extends IRDataModel
{
	// <================== Properties
	/**
	 * @var string
	 * @Column(type="string",length=500)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRRequire
	 * @IRTitle(TitleType="STRING",Value="پرونده")
	 * @IRPropertyType(Type="FILE")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 */
	protected $PicFile;
	
	/**
	 * @var String
	 * @Column(type="string",length=50)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRRequire
	 * @IRTitle(TitleType="STRING",Value="کد عکس")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRParentGridMember
	 */
	protected $piccode;
	
	/**
	 * @var string
	 * @Column(type="string",length=50)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="تاریخ عکس برداردی")
	 * @IRPropertyType(Type="DATE")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 */
	protected $shotdate;
	/**
	 * @var Human
	 * @ManyToOne(targetEntity="Human")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle=" سفارش دهنده ")
	 */
	protected $client;
	/**
	 * @var Title
	 * @ManyToOne(targetEntity="Title")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRRequire
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRParentGridMember
	 * @IRUseAsProfile(TargetProfile="ABSTRACT")
	 */
	protected $title;
	/**
	 * @var Size
	 * @ManyToOne(targetEntity="Size")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle=" اندازه ")
	 * 
	 */
	protected $Size;
	/**
	 * 
	 * @var Resulation
	 * @ManyToOne(targetEntity="Resulation")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle=" کیفیت ")
	 */
	protected $resulation;
	/**
	 * @var Location
	 * @ManyToOne(targetEntity="Location")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="ABSTRACT", PostfixTitle=" مکان ")
	 * 
	 */
	protected $Location;
	/**
	 * @var Human
	 * @ManyToOne(targetEntity="Human")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="ABSTRACT", PostfixTitle=" عکاس ")
	 */
	protected $Photographer;
	
	/**
	 * @var PictureType
	 * @ManyToOne(targetEntity="PictureType")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle=" نوع عکس ")
	 * 
	 */
	protected $pictype;
	/**
	 * @var PictureFormat
	 * @ManyToOne(targetEntity="PictureFormat")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRParentGridMember
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle=" قالب عکس ")
	 */
	protected $picformat;
	
	
	//                     Properties ===================>
	/**
	 * 
	 * @scField(name="TitleName",type="string",title="عنوان",DoctrineField="title.Name")
	 */
	public function getTitleName(){
	try {return $this->title->getName();}catch(\Exception $ex){return '';}
	}
	public function setTitleName($v){}
	/**
	 * 
	 * @scField(name="TitleID",type="string",hidden=true,DoctrineField="title.id")
	 */
	public function getTitleID(){
	try {return $this->title->getID();}catch(\Exception $ex){return NULL;}
	}
	public function setTitleID($v){
	try {
		$this->title=new Title();
		$this->title= $this->title->GetByID($v);
	}catch(\Exception $ex){}
	}
	
	/**
	 * 
	 * @scField(name="ShotDate",type="string",DoctrineField="shotdate",title="تاریخ عکسبرداری")
	 */
	public function getShotDate(){
	try {return $this->shotdate;}catch(\Exception $ex){return '';}
	}
	public function setShotDate($v){$this->shotdate=$v;}
	
	
	/**
	 * 
	 * @scField(name="ClientFirstName",type="string",DoctrineField="client.fname",title="نام سفارش دهنده")
	 */
	public function getClientFirstName(){
	try {return $this->client->getFirstName();}catch(\Exception $ex){return '';}
	}
	public function setClientFirstName($v){}
	/**
	 * 
	 * @scField(name="ClientLastName",type="string",DoctrineField="client.lname",title="نام خانوادگی سفارش دهنده")
	 */
	public function getClientLastName(){
	try {return $this->client->getLastName();}catch(\Exception $ex){return '';}
	}
	public function setClientLastName($v){}
	
	/**
	 * 
	 * @scField(name="ClientID",type="string",hidden=true,DoctrineField="client.id")
	 */
	public function getClientID(){
	try {return $this->client->getid();}catch(\Exception $ex){return NULL;}
	}
	public function setClientID($v){
	try {
		$this->client=new Human();
		$this->client= $this->client->GetByID($v);
	}catch(\Exception $ex){}
	}
	
	
	
	/**
	 * 
	 * @scField(name="PicCode",type="string",DoctrineField="piccode",title="کد عکس")
	 */
	public function getPicCode(){
	try {return $this->piccode;}catch(\Exception $ex){return '';}
	}
	public function setPicCode($v){$this->piccode=$v;}
	
	/**
	 * 
	 * @scField(name="ResulationName",type="string",title="وضوح تصویر",DoctrineField="resulation.Name")
	 */
	public function getResulationName(){
	try {return $this->resulation->getName();}catch(\Exception $ex){return '';}
	}
	public function setResulationName($v){}
	/**
	 * 
	 * @scField(name="ResulationID",type="string",hidden=true,DoctrineField="resulation.id")
	 */
	public function getResulationID(){
	try {return $this->resulation->getID();}catch(\Exception $ex){return NULL;}
	}
	public function setResulationID($v){
	try {
		$this->resulation=new Resulation();
		$this->resulation= $this->resulation->GetByID($v);
	}catch(\Exception $ex){}
	}
	
	
	/**
	 * 
	 * @scField(name="SizeName",type="string",title="قطع عکس",DoctrineField="Size.Name")
	 */
	public function getSizeName(){
	try {return $this->Size->getName();}catch(\Exception $ex){return '';}
	}
	public function setSizeName($v){}
	/**
	 * 
	 * @scField(name="SizeID",type="string",hidden=true,DoctrineField="Size.id")
	 */
	public function getSizeID(){
	try {return $this->Size->getID();}catch(\Exception $ex){return NULL;}
	}
	public function setSizeID($v){
	try {
		$this->Size=new Size();
		$this->Size= $this->Size->GetByID($v);
	}catch(\Exception $ex){}
	}
	
	/**
	 * 
	 * @scField(name="LocationName",type="string",title="محل عکسبرداری",DoctrineField="Location.Name")
	 */
	public function getLocationName(){
	try {return $this->Location->getName();}catch(\Exception $ex){return '';}
	}
	public function setLocationName($v){}
	/**
	 * 
	 * @scField(name="LocationID",type="string",hidden=true,DoctrineField="Location.id")
	 */
	public function getLocationID(){
	try {return $this->Location->getID();}catch(\Exception $ex){return NULL;}
	}
	public function setLocationID($v){
	try {
		$this->Location=new Location();
		$this->Location= $this->Location->GetByID($v);
	}catch(\Exception $ex){}
	}
	/**
	 * 
	 * @scField(name="PhotographerFirstName",type="string",DoctrineField="Photographer.fname",title="نام عکاس")
	 */
	public function getPhotographerFirstName(){
	try {return $this->Photographer->getFirstName();}catch(\Exception $ex){return '';}
	}
	public function setPhotographerFirstName($v){}
	/**
	 * 
	 * @scField(name="PhotographerLastName",type="string",DoctrineField="Photographer.lname",title="نام خانوادگی عکاس")
	 */
	public function getPhotographerLastName(){
	try {return $this->Photographer->getLastName();}catch(\Exception $ex){return '';}
	}
	public function setPhotographerLastName($v){}
	
	/**
	 * 
	 * @scField(name="PhotographerID",type="string",hidden=true,DoctrineField="Photographer.id")
	 */
	public function getPhotographerID(){
	try {return $this->Photographer->getid();}catch(\Exception $ex){return NULL;}
	}
	public function setPhotographerID($v){
	try {
		$this->Photographer=new Human();
		$this->Photographer= $this->Photographer->GetByID($v);
	}catch(\Exception $ex){}
	}
	
	/**
	 * 
	* @scField(name="PictureFormatName",type="string",title="فرمت عکس",DoctrineField="picformat.Name")
	 */
	public function getPictureFormatName(){
	try {return $this->picformat->getName();}catch(\Exception $ex){return '';}
	}
	public function setPictureFormatName($v){}
	/**
	 * 
	 * @scField(name="PictureFormatID",type="string",hidden=true,DoctrineField="picformat.id")
	 */
	public function getPictureFormatID(){
	try {return $this->picformat->getID();}catch(\Exception $ex){return NULL;}
	}
	public function setPictureFormatID($v){
	try {
		$this->picformat=new PictureFormat();
		$this->picformat= $this->picformat->GetByID($v);
	}catch(\Exception $ex){}
	}
	
	/**
	 * 
	 * @scField(name="PictureTypeName",type="string",title="نوع عکس",DoctrineField="pictype.Name")
	 */
	public function getPictureTypeName(){
	try {return $this->pictype->getName();}catch(\Exception $ex){return '';}
	}
	public function setPictureTypeName($v){}
	/**
	 * 
	 * @scField(name="PictureTypeID",type="string",hidden=true,DoctrineField="pictype.id")
	 */
	public function getPictureTypeID(){
	try {return $this->pictype->getID();}catch(\Exception $ex){return NULL;}
	}
	public function setPictureTypeID($v){
	try {
		$this->pictype=new PictureType();
		$this->pictype= $this->pictype->GetByID($v);
	}catch(\Exception $ex){}
	}
	
	
	/**
	 * 
	 * Enter description here ...
	 * @var Subject
	 * @ManyToOne(targetEntity="Subject")
	 */
	protected $subject;
	/**
	 * 
	 * @scField(name="SubjectName",type="string",title="سوژه عکس",DoctrineField="subject.Name")
	 */
	public function getSubjectName(){
	try {return $this->subject->getName();}catch(\Exception $ex){return '';}
	}
	public function setSubjectName($v){}
	/**
	 * 
	 * @scField(name="SubjectID",type="string",hidden=true,DoctrineField="subject.id")
	 */
	public function getSubjectID(){
	try {return $this->subject->getID();}catch(\Exception $ex){return NULL;}
	}
	public function setSubjectID($v){
	try {
		$this->subject=new Subject();
		$this->subject= $this->subject->GetByID($v);
	}catch(\Exception $ex){}
	}
	
	
	/**
	 * 
	 * @scField(name="PicFile",type="string",title="پرونده",DoctrineField="PicFile")
	 */
	public function getPicFile(){
	try {return $this->PicFile;}catch(\Exception $ex){return '';}
	}
	public function setPicFile($v){$this->PicFile=$v;}
	
	
	
}

?>