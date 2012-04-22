<?php
namespace IRERP\modules\jahad\models;

use IRERP\Basics\Models\IRDataModel,
    IRERP\Basics\Annotations\scField;
   
/**
 * @Entity 
 */
class SlideVision extends IRDataModel
{

	/**
	 * @ManyToOne(targetEntity="Title")
	 */
	protected $Title;
	/**
	 * 
	 * @scField(name="TitleName",type="string",title="عنوان",DoctrineField="Title.Name")
	 */
	public function getTitleName(){
	try {return $this->Title->getName();}catch(\Exception $ex){return '';}
	}
	public function setTitleName($v){}
	/**
	 * 
	 * @scField(name="TitleID",type="string",hidden=true,DoctrineField="Title.id")
	 */
	public function getTitleID(){
	try {return $this->Title->getID();}catch(\Exception $ex){return NULL;}
	}
	public function setTitleID($v){
	try {
		$this->Title=new Title();
		$this->Title= $this->Title->GetByID($v);
	}catch(\Exception $ex){}
	}
	
	/**
	 * @Column(type="string",length=10)
	 */
	protected $SlideVisionTime;
		/**
	 * 
	 * @scField(name="SlideVisionTime",type="string",title="زمان ",DoctrineField="SlideVisionTime")
	 */
	
	public function getSlideVisionTime(){
	try {return $this->SlideVisionTime;}catch(\Exception $ex){return '';}
	}
	public function setSlideVisionTime($v){$this->SlideVisionTime=$v;}
	
	/**
	 * @Column(type="string",length=50)
	 */
	protected $ProductionDate;
		/**
	 * 
	 * @scField(name="ProductionDate",type="string",title="تاریخ تولید",DoctrineField="ProductionDate")
	 */
	
		public function getProductionDate(){
	try {return $this->ProductionDate;}catch(\Exception $ex){return '';}
	}
	public function setProductionDate($v){$this->ProductionDate=$v;}
	
	/**
	 * @Column(type="string",length=50)
	 */
	protected $Montage;
		/**
	 * 
	 * @scField(name="Montage",type="string",title="مونتاژ",DoctrineField="Montage")
	 */
	
		public function getMontage(){
	try {return $this->Montage;}catch(\Exception $ex){return '';}
	}
	public function setMontage($v){$this->Montage=$v;}
	
	/**
	 * @Column(type="string",length=50)
	 */
	
	protected $SlideVisionCode;
		/**
	 * 
	 * @scField(name="SlideVisionCode",type="string",title="کد ",DoctrineField="SlideVisionCode")
	 */
	
	public function getSlideVisionCode(){
	try {return $this->SlideVisionCode;}catch(\Exception $ex){return '';}
	}
	public function setSlideVisionCode($v){$this->SlideVisionCode=$v;}
	
	
	/**
	 * @Column(type="string",length=50)
	 */
	protected $SlideVisionabstracFile;
		/**
	 * 
	 * @scField(name="SlideVisionabstracFile",type="string",title="پرونده خلاصه ",DoctrineField="SlideVisionabstracFile")
	 */
	
	
		public function getSlideVisionabstracFile(){
	try {return $this->SlideVisionabstracFile;}catch(\Exception $ex){return '';}
	}
	public function setSlideVisionabstracFile($v){$this->SlideVisionabstracFile=$v;}
	
	
	
	/**
	 * @ManyToOne(targetEntity="FilmProductionFormat")
	 */
	protected $ProductionFormat;
	/**
	 * 
	 * @scField(name="ProductionFormatName",type="string",title="قالب تولید",DoctrineField="ProductionFormat.Name")
	 */
	public function getProductionFormatName(){
	try {return $this->ProductionFormat->getName();}catch(\Exception $ex){return '';}
	}
	public function setProductionFormatName($v){}
	/**
	 * 
	 * @scField(name="ProductionFormatID",type="string",hidden=true,DoctrineField="ProductionFormat.id")
	 */
	public function getProductionFormatID(){
	try {return $this->ProductionFormat->getid();}catch(\Exception $ex){return NULL;}
	}
	public function setProductionFormatID($v){
	try {
		$this->ProductionFormat=new FilmProductionFormat();
		$this->ProductionFormat= $this->ProductionFormat->GetByID($v);
	}catch(\Exception $ex){}
	}
	
	
	
	
	
	/**
	 * @ManyToOne(targetEntity="Human")
	 */
	protected $Client;
	/**
	 * 
	 * @scField(name="ClientFirstName",type="string",DoctrineField="Client.fname",title="نام سفارش دهنده")
	 */
	public function getClientFirstName(){
	try {return $this->Client->getFirstName();}catch(\Exception $ex){return '';}
	}
	public function setClientFirstName($v){}
	/**
	 * 
	 * @scField(name="ClientLastName",type="string",DoctrineField="Client.lname",title="نام خانوادگی سفارش دهنده")
	 */
	public function getClientLastName(){
	try {return $this->Client->getLastName();}catch(\Exception $ex){return '';}
	}
	public function setClientLastName($v){}
	
	/**
	 * 
	 * @scField(name="ClientID",type="string",hidden=true,DoctrineField="Client.id")
	 */
	public function getClientID(){
	try {return $this->Client->getid();}catch(\Exception $ex){return NULL;}
	}
	public function setClientID($v){
	try {
		$this->Client=new Human();
		$this->Client= $this->Client->GetByID($v);
	}catch(\Exception $ex){}
	}
	
	
	
	

	
	
	/**
	 * @OneToMany(targetEntity="SlideVisionContentlist",mappedBy="SlideVision")
	 * @var SlideVisionContentlist
	 */
	protected $SlideVisionContentlists;
	/**
	 * 
	 * @ManyToMany(targetEntity="FilmEducationalGoal")
	 * @var FilmEducationalGoal
	 */
	protected $EducationalGoals;
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="SlideVision_TechnicalExperts",
	 *      joinColumns={@JoinColumn(name="SlideVision_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="TechnicalExpert_id", referencedColumnName="id")}
 	 *      )
	 * @var Human
	 */
	protected $TechnicalExperts;
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="SlideVision_Speakers",
	 *      joinColumns={@JoinColumn(name="SlideVision_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Speaker_id", referencedColumnName="id")}
 	 *      )
	 * @var Human
	 */
	protected $Speakers;
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
	 * @var Human
     * @JoinTable(name="SlideVision_Senarists",
	 *      joinColumns={@JoinColumn(name="SlideVision_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Senarist_id", referencedColumnName="id")}
 	 *      )
	 */
	protected $Senarists;
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="SlideVision_PhotoGraphists",
	 *      joinColumns={@JoinColumn(name="SlideVision_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="PhotoGraphist_id", referencedColumnName="id")}
 	 *      )
	 * @var Human
	 */
	protected $PhotoGraphists;
	
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
	 * 
     * @JoinTable(name="SlideVision_Directors",
	 *      joinColumns={@JoinColumn(name="SlideVision_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Director_id", referencedColumnName="id")}
 	 *      )
	 * @var Human
	 */
	protected $Directors;
	
	/**
	 * @ManyToMany(targetEntity="Auidunce")
	 * @var Auidunce
	 */
	protected $Audiences;
	
/**
	 * @Column(type="string",length=50)
	 */
	protected $ProductedIn;
	/**
	 * 
	 * @scField(name="ProductedIn",type="string",title="تهیه شده در ",DoctrineField="ProductedIn")
	 */
	public function getProductedIn(){
	try {return $this->ProductedIn;}catch(\Exception $ex){return '';}
	}
	public function setProductedIn($v){$this->ProductedIn=$v;}
	
	
	
	
	 
}
?>