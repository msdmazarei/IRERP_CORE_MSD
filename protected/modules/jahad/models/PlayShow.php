<?php
namespace IRERP\modules\jahad\models;

use IRERP\Basics\Models\IRDataModel,
    IRERP\Basics\Annotations\scField;
   

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
class PlayShow extends IRDataModel
{

	// <===================== Properties
	/**
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
	protected $Title;
	/**
	 * @Column(type="string",length=10)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="مدت زمان")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 */
	protected $PlayShowTime;
	/**
	 * @Column(type="string",length=50)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="مرکز")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRParentGridMember
	 */
	protected $Center;
	/**
	 * @Column(type="string",length=50)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="کد")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRParentGridMember
	 */
	protected $PlayShowCode;
	/**
	 * @Column(type="string",length=50)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="خلاصه")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 */
	protected $PlayShowabstracFile;
	/**
	 * @OneToMany(targetEntity="PlayShowContentlist",mappedBy="PlayShow")
	 * @var PlayShowContentlist
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="فهرست")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 */
	protected $PlayShowContentlists;
	/**
	 * 
	 * @ManyToMany(targetEntity="FilmEducationalGoal")
	 * @var FilmEducationalGoal
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="اهداف")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 
	 */
	protected $EducationalGoals;
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="PlayShow_TechnicalExperts",
	 *      joinColumns={@JoinColumn(name="PlayShow_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="TechnicalExpert_id", referencedColumnName="id")}
 	 *      )
	 * @var Human
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="کارشناسان فنی")
	 * -----------
	 * Internal Relation Definations
	 * -----------

	 */
	protected $TechnicalExperts;
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="PlayShow_Speakers",
	 *      joinColumns={@JoinColumn(name="PlayShow_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Speaker_id", referencedColumnName="id")}
 	 *      )
	 * @var Human
 	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="گویندگان")
	 * -----------
	 * Internal Relation Definations
	 * -----------

	 */
	protected $Speakers;
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
	 * @var Human
     * @JoinTable(name="PlayShow_Actors",
	 *      joinColumns={@JoinColumn(name="PlayShow_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Actor_id", referencedColumnName="id")}
 	 *      )
 	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="بازیگران")
	 * -----------
	 * Internal Relation Definations
	 * -----------

	 */
	protected $Actors;
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="PlayShow_Writers",
	 *      joinColumns={@JoinColumn(name="PlayShow_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Writer_id", referencedColumnName="id")}
 	 *      )
	 * @var Human
 	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="نویسندگان")
	 * -----------
	 * Internal Relation Definations
	 * -----------

	 */
	protected $Writers;
	
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
	 * 
     * @JoinTable(name="PlayShow_Directors",
	 *      joinColumns={@JoinColumn(name="PlayShow_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Director_id", referencedColumnName="id")}
 	 *      )
	 * @var Human
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="کارگردانان")
	 * -----------
	 * Internal Relation Definations
	 * -----------

	 */
	protected $Directors;
	
	
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
	 * 
     * @JoinTable(name="PlayShow_Producers",
	 *      joinColumns={@JoinColumn(name="PlayShow_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Producer_id", referencedColumnName="id")}
 	 *      )
	 * @var Human
 	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="تهیه کننده")
	 * -----------
	 * Internal Relation Definations
	 * -----------

	 */
	protected $Producers;
	
	
	/**
	 * @ManyToMany(targetEntity="Auidunce")
	 * @var Auidunce
 	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="مخاطبان")
	 * -----------
	 * Internal Relation Definations
	 * -----------

	 */
	protected $Audiences;
	
	// 						  Properties ======================>
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
	 * 
	 * @scField(name="PlayShowTime",type="string",title="زمان ",DoctrineField="PlayShowTime")
	 */
	
	public function getPlayShowTime(){
	try {return $this->PlayShowTime;}catch(\Exception $ex){return '';}
	}
	public function setPlayShowTime($v){$this->PlayShowTime=$v;}
	
	
		/**
	 * 
	 * @scField(name="Center",type="string",title="مرکز",DoctrineField="Center")
	 */
	
		public function getCenter(){
	try {return $this->Center;}catch(\Exception $ex){return '';}
	}
	public function setCenter($v){$this->Center=$v;}
	
		/**
	 * 
	 * @scField(name="PlayShowCode",type="string",title="کد ",DoctrineField="PlayShowCode")
	 */
	
	public function getPlayShowCode(){
	try {return $this->PlayShowCode;}catch(\Exception $ex){return '';}
	}
	public function setPlayShowCode($v){$this->PlayShowCode=$v;}
	
	
		/**
	 * 
	 * @scField(name="PlayShowabstracFile",type="string",title="پرونده خلاصه ",DoctrineField="PlayShowabstracFile")
	 */
	
	
		public function getPlayShowabstracFile(){
	try {return $this->PlayShowabstracFile;}catch(\Exception $ex){return '';}
	}
	public function setPlayShowabstracFile($v){$this->PlayShowabstracFile=$v;}
	
	
	
	
	 
}
?>