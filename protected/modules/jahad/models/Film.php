<?php
namespace IRERP\modules\jahad\models;

use Doctrine\ORM\Mapping\Column;
use IRERP\Basics\Models\IRDataModel,
    IRERP\Basics\Annotations\scField;
use IRERP\modules\jahad\models\FilmEducationalGoal;
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
 * @Entity 
 */
class Film extends IRDataModel
{
	
	
	
	 // <================== Define Class Properties
	/**
	 * @Column(type="string",length=50)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRRequire
	 * @IRTitle(TitleType="STRING",Value="نام فیلم")
	 * @IRClientName(ClientName="filmname")
	 * @IRPropertyType(Type="String")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRParentGridMember
	 */
	protected $FilmName;
	/**
	 * @Column(type="string",length=10)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRRequire
	 * @IRTitle(TitleType="STRING",Value="زمان فیلم")
	 * @IRClientName(ClientName="filmtime")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 */
	protected $FilmTime;
	/**
	 * @Column(type="string",length=50)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="تاریخ تولید")
	 * @IRClientName(ClientName="prdate")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 */
	protected $ProductionDate;
	/**
	 * @Column(type="string",length=50)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="مونتاژ")
	 * @IRClientName(ClientName="montage")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 */
	protected $Montage;
	/**
	 * @Column(type="string",length=50)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * 
	 * @IRTitle(TitleType="STRING",Value="کد فیلم")
	 * @IRClientName(ClientName="filmcode")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRParentGridMember
	 */
	protected $FilmCode;
	/**
	 * @Column(type="string",length=50)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRRequire
	 * @IRTitle(TitleType="STRING",Value="خلاصه فیلم")
	 * @IRClientName(ClientName="abstract")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 */
	protected $FilmabstracFile;
	/**
	 * @ManyToOne(targetEntity="FilmProductionFormat")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS(Profile="a")
	 * @IRTitle(TitleType="STRING",Value="قالب تولید")
	 * @IRClientName(ClientName="prformat")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRParentGridMember
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle=" قالب تولید ")
	 */
	protected $ProductionFormat;
	
	/**
	 * @ManyToOne(targetEntity="Human")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRClientName(ClientName="client")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * 
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle=" سفارش دهنده ")
	 */
	protected $Client;
	/**
	 * @ManyToOne(targetEntity="FilmSystemType")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS(Profile="a")
	 * @IRTitle(TitleType="STRING",Value="نوع سیستم")
	 * @IRClientName(ClientName="systype")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle=" نوع سیستم ")
	 */
	protected $SystemType;
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="Film_Executives",
	 *      joinColumns={@JoinColumn(name="Film_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Executive_id", referencedColumnName="id")}
 	 *      )
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS(Profile="a")
	 * @IRTitle(TitleType="STRING",Value="مجریان")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="Detail")
	 * @var Human
	 */
	protected $Executives;
	
	/**
	 * @OneToMany(targetEntity="FilmContentlist",mappedBy="Film")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS(Profile="a")
	 * @IRTitle(TitleType="STRING",Value="فهرست")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @var FilmContentlist
	 */
	protected $FilmContentlists;
	/**
	 * 
	 * @ManyToMany(targetEntity="FilmEducationalGoal")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS(Profile="a")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle="فیلم")
	 * @var FilmEducationalGoal
	 */
	protected $EducationalGoals;
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="Film_TechnicalExperts",
	 *      joinColumns={@JoinColumn(name="Film_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="TechnicalExpert_id", referencedColumnName="id")}
 	 *      )
 	 * -----------
 	 * Client Side Definations
 	 * -----------
 	 * @IRUseInClientDS
 	 * -----------
 	 * Internal Relation Definations
 	 * -----------
 	 * @IRUseAsProfile(TargetProfile="Detail",PostfixTitle="فیلم")
	 * @var Human
	 */
	protected $TechnicalExperts;
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="Film_Speakers",
	 *      joinColumns={@JoinColumn(name="Film_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Speaker_id", referencedColumnName="id")}
 	 *      )
 	 * -----------
 	 * Client Side Definations
 	 * -----------
 	 * @IRUseInClientDS
 	 * @IRTitle(TitleType="STRING",Value="گویندگان")
 	 * -----------
 	 * Internal Relation Definations
 	 * -----------
 	 * @IRUseAsProfile(TargetProfile="Detail1")

	 * @var Human
	 */
	protected $Speakers;
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
	 * @var Human
     * @JoinTable(name="Film_Senarists",
	 *      joinColumns={@JoinColumn(name="Film_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Senarist_id", referencedColumnName="id")}
 	 *      )
 	 * -----------
 	 * Client Side Definations
 	 * -----------
 	 * @IRUseInClientDS(Profile="a")
 	 * @IRTitle(TitleType="STRING",Value="سناریو نویسان")
 	 * -----------
 	 * Internal Relation Definations
 	 * -----------
 	 * @IRUseAsProfile(TargetProfile="Detail")

	 */
	protected $Senarists;
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="Film_Actors",
	 *      joinColumns={@JoinColumn(name="Film_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Actor_id", referencedColumnName="id")}
 	 *      )
 	 * -----------
 	 * Client Side Definations
 	 * -----------
 	 * @IRUseInClientDS(Profile="a")
 	 * @IRTitle(TitleType="STRING",Value="بازیگران")
 	 * -----------
 	 * Internal Relation Definations
 	 * -----------
 	 * @IRUseAsProfile(TargetProfile="Detail")


	 * @var Human
	 */
	protected $Actors;
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="Film_Writers",
	 *      joinColumns={@JoinColumn(name="Film_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Writer_id", referencedColumnName="id")}
 	 *      )
 	 * -----------
 	 * Client Side Definations
 	 * -----------
 	 * @IRUseInClientDS(Profile="a")
 	 * @IRTitle(TitleType="STRING",Value="نویسندگان")
 	 * -----------
 	 * Internal Relation Definations
 	 * -----------
 	 * @IRUseAsProfile(TargetProfile="Detail")

	 * @var Human
	 */
	protected $Writers;
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
	 * 
     * @JoinTable(name="Film_Directors",
	 *      joinColumns={@JoinColumn(name="Film_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Director_id", referencedColumnName="id")}
 	 *      )
 	 * -----------
 	 * Client Side Definations
 	 * -----------
 	 * @IRUseInClientDS(Profile="a")
 	 * @IRTitle(TitleType="STRING",Value="کارگردانان")
 	 * Internal Relation Definations
 	 * -----------
 	 * @IRUseAsProfile(TargetProfile="Detail")
	 * @var Human
	 */
	protected $Directors;
	
	 //=============== Class Properties ===================>
	
	/**
	 * 
	 * @scField(name="FilmName",type="string",title="نام فیلم",DoctrineField="FilmName")
	 */
	public function getFilmName(){
	try {return $this->FilmName;}catch(\Exception $ex){return '';}
	}
	public function setFilmName($v){$this->FilmName=$v;}
	/**
	 * 
	 * @scField(name="FilmTime",type="string",title="زمان فیلم",DoctrineField="FilmTime")
	 */
	
	public function getFilmTime(){
	try {return $this->FilmTime;}catch(\Exception $ex){return '';}
	}
	public function setFilmTime($v){$this->FilmTime=$v;}
	
		/**
	 * 
	 * @scField(name="ProductionDate",type="string",title="تاریخ تولید",DoctrineField="ProductionDate")
	 */
	
		public function getProductionDate(){
	try {return $this->ProductionDate;}catch(\Exception $ex){return '';}
	}
	public function setProductionDate($v){$this->ProductionDate=$v;}
	
		/**
	 * 
	 * @scField(name="Montage",type="string",title="مونتاژ",DoctrineField="Montage")
	 */
	
		public function getMontage(){
	try {return $this->Montage;}catch(\Exception $ex){return '';}
	}
	public function setMontage($v){$this->Montage=$v;}
	
		/**
	 * 
	 * @scField(name="FilmCode",type="string",title="کد فیلم",DoctrineField="FilmCode")
	 */
	
	public function getFilmCode(){
	try {return $this->FilmCode;}catch(\Exception $ex){return '';}
	}
	public function setFilmCode($v){$this->FilmCode=$v;}
	
	
		/**
	 * 
	 * @scField(name="FilmabstracFile",type="string",title="پرونده خلاصه فیلم",DoctrineField="FilmabstracFile")
	 */
	
	
		public function getFilmabstracFile(){
	try {return $this->FilmabstracFile;}catch(\Exception $ex){return '';}
	}
	public function setFilmabstracFile($v){$this->FilmabstracFile=$v;}
	
	
	
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
	 * 
	 * @scField(name="SystemTypeName",type="string",title="نوع سیستم",DoctrineField="SystemType.Name")
	 */
	public function getSystemTypeName(){
	try {return $this->SystemType->getName();}catch(\Exception $ex){return '';}
	}
	public function setSystemTypeName($v){}
	/**
	 * 
	 * @scField(name="SystemTypeID",type="string",hidden=true,DoctrineField="SystemType.id")
	 */
	public function getSystemTypeID(){
	try {return $this->SystemType->getID();}catch(\Exception $ex){return NULL;}
	}
	public function setSystemTypeID($v){
	try {
		$this->SystemType=new FilmSystemType();
		$this->SystemType= $this->SystemType->GetByID($v);
	}catch(\Exception $ex){}
	}
	
	
	
	
	 
}
?>