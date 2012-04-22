<?php
namespace IRERP\modules\jahad\models;

use IRERP\Basics\Models\IRDataModel,
    IRERP\Basics\Annotations\scField;
use IRERP\modules\jahad\models\RadioEducationalGoal;    

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
class RadioSchool extends IRDataModel
{

		
	/**
	 * @Column(type="string",length=50)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRRequire
	 * @IRTitle(TitleType="STRING",Value="نام مدرسه")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRParentGridMember
	 */
	protected $RadioSchoolName;
/**
	 * 
	 * @scField(name="RadioSchoolName",type="string",title="نام ",DoctrineField="RadioSchoolName")
	 */
	public function getRadioSchoolName(){
	try {return $this->RadioSchoolName;}catch(\Exception $ex){return '';}
	}
	public function setRadioSchoolName($v){$this->RadioSchoolName=$v;}
	
	///////////////////////////////////////////////////////////////////////////
	
/**
	 * @Column(type="string",length=50)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="عنوان رادیو")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRParentGridMember
	 */
	protected $RadioTitle;
/**
	 * 
	 * @scField(name="RadioTitle",type="string",title="عنوان ",DoctrineField="RadioTitle")
	 */
	public function getRadioTitle(){
	try {return $this->RadioTitle;}catch(\Exception $ex){return '';}
	}
	public function setRadioTitle($v){$this->RadioTitle=$v;}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * @Column(type="string",length=500)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="توضیحات")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 */
	protected $RadioDescription;
	/**
	 * 
	 * @scField(name="RadioDescription",type="string",title="توضیحات ",DoctrineField="RadioDescription")
	 */
	public function getRadioDescription(){
	try {return $this->RadioDescription;}catch(\Exception $ex){return '';}
	}
	public function setRadioDescription($v){$this->RadioDescription=$v;}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
	 * @Column(type="string",length=50)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="شماره نشر")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRParentGridMember
	 */
	protected $PublicationNo;
	/**
	 * 
	 * @scField(name="PublicationNo",type="string",title="شماره نشریه ",DoctrineField="PublicationNo")
	 */
	public function getPublicationNo(){
	try {return $this->PublicationNo;}catch(\Exception $ex){return '';}
	}
	public function setPublicationNo($v){$this->PublicationNo=$v;}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	
/**
	 * @Column(type="string",length=50)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="کد نشر")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRParentGridMember
	 */
	protected $PublicationCode;
	/**
	 * 
	 * @scField(name="PublicationCode",type="string",title="کد نشریه ",DoctrineField="PublicationCode")
	 */
	public function getPublicationCode(){
	try {return $this->PublicationCode;}catch(\Exception $ex){return '';}
	}
	public function setPublicationCode($v){$this->PublicationCode=$v;}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="RadioSchool_Publishers",
	 *      joinColumns={@JoinColumn(name="RadioSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Publishers_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="ناشران")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL",PostfixTitle="ناشر")
	 */
		protected $Publishers;
	////////////////////////////////////////////////////////////////////////////////////////////////
	
/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="RadioSchool_Writers",
	 *      joinColumns={@JoinColumn(name="RadioSchool_id", referencedColumnName="id")},
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
	 * @IRUseAsProfile(TargetProfile="DETAIL",PostfixTitle="")

	 */
	protected $Writers;
	////////////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="RadioSchool_TechnicalExperts",
	 *      joinColumns={@JoinColumn(name="RadioSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="TechnicalExpert_id", referencedColumnName="id")}
 	 *      )
	 * @var Human
 	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="کارشناسان فنی ")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL",PostfixTitle="")
	 */
	protected $TechnicalExperts;
	////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="RadioSchool_TechnicalSupervisors",
	 *      joinColumns={@JoinColumn(name="RadioSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="TechnicalSupervisor_id", referencedColumnName="id")}
 	 *      )
	 * @var Human
  	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="بازرسان فنی ")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL",PostfixTitle="")


	 */
	protected $TechnicalSupervisors;
	////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="RadioSchool_RadioPrints",
	 *      joinColumns={@JoinColumn(name="RadioSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="RadioPrints_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
	  	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="چاپ های رادیویی")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL",PostfixTitle="")


	 */
		protected $RadioPrints;
	////////////////////////////////////////////////////////////////////////////////////////////////
		/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="RadioSchool_TypeSetters",
	 *      joinColumns={@JoinColumn(name="RadioSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="TypeSetter_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
	 * 
  	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="تنظیم کنندگان تایپ")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL",PostfixTitle="")


	 */
	protected $TypeSetters;
	////////////////////////////////////////////////////////////////////////////////////////////////
		/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="RadioSchool_Editors",
	 *      joinColumns={@JoinColumn(name="RadioSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Editor_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
	  	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="ویرایشگران")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL",PostfixTitle="")


	 */
	protected $Editors;
	////////////////////////////////////////////////////////////////////////////////////////////////
		/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="RadioSchool_PageStylists",
	 *      joinColumns={@JoinColumn(name="RadioSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="PageStylist_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
	 *
  	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="صفحه آرا ها")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL",PostfixTitle="")


	 */
	protected $PageStylists;
	////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="RadioSchool_Graphists",
	 *      joinColumns={@JoinColumn(name="RadioSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Graphist_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
  	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="گرافیست ها")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL",PostfixTitle="")
	 */
	protected $Graphists;
	////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="RadioSchool_Preparators",
	 *      joinColumns={@JoinColumn(name="RadioSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Preparator_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
  	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="تهیه کنندگان")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL",PostfixTitle="")


	 */
	protected $Preparators;
	////////////////////////////////////////////////////////////////////////////////////////////////
/**
	 * @Column(type="string",length=50)
	 */
	protected $PublicationDate;
	/**
	 * 
	 * @scField(name="PublicationDate",type="string",title="تاریخ انتشار ",DoctrineField="PublicationDate")
	 */
	public function getPublicationDate(){
	try {return $this->PublicationDate;}catch(\Exception $ex){return '';}
	}
	public function setPublicationDate($v){$this->PublicationDate=$v;}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	 * @Column(type="string",length=50)
	 */
	protected $DistributionDate;
	/**
	 * 
	 * @scField(name="DistributionDate",type="string",title="تاریخ پخش ",DoctrineField="DistributionDate")
	 */
	public function getDistributionDate(){
	try {return $this->DistributionDate;}catch(\Exception $ex){return '';}
	}
	public function setDistributionDate($v){$this->DistributionDate=$v;}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	
/**
	 * @Column(type="string",length=50)
	 */
	protected $Tirajh;
	/**
	 * 
	 * @scField(name="Tirajh",type="string",title="تیراژ ",DoctrineField="Tirajh")
	 */
	public function getTirajh(){
	try {return $this->Tirajh;}catch(\Exception $ex){return '';}
	}
	public function setTirajh($v){$this->Tirajh=$v;}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="RadioSchool_LitoGraphists",
	 *      joinColumns={@JoinColumn(name="RadioSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="LitoGraphist_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
	  	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="لیتوگرافیست ها")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL",PostfixTitle="")
	 */
	protected $LitoGraphists;
	////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * @Column(type="string",length=500)
	 */
	protected $Address;
	/**
	 * 
	 * @scField(name="Address",type="string",title="آدرس ",DoctrineField="Address")
	 */
	public function getAddress(){
	try {return $this->Address;}catch(\Exception $ex){return '';}
	}
	public function setAddress($v){$this->Address=$v;}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	 * @Column(type="string",length=50)
	 */
	protected $Tel;
	/**
	 * 
	 * @scField(name="Tel",type="string",title="تلفن ",DoctrineField="Tel")
	 */
	public function getTel(){
	try {return $this->Tel;}catch(\Exception $ex){return '';}
	}
	public function setTel($v){$this->Tel=$v;}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	
/**
	 * @Column(type="string",length=50)
	 */
	protected $Fax;
	/**
	 * 
	 * @scField(name="Fax",type="string",title="دورنگار ",DoctrineField="Fax")
	 */
	public function getFax(){
	try {return $this->Fax;}catch(\Exception $ex){return '';}
	}
	public function setFax($v){$this->Fax=$v;}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	
/**
	 * @Column(type="string",length=50)
	 */
	protected $PublicationPeriod;
	/**
	 * 
	 * @scField(name="PublicationPeriod",type="string",title="نوبت چاپ ",DoctrineField="PublicationPeriod")
	 */
	public function getPublicationPeriod(){
	try {return $this->PublicationPeriod;}catch(\Exception $ex){return '';}
	}
	public function setPublicationPeriod($v){$this->PublicationPeriod=$v;}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="RadioSchool_BookBinders",
	 *      joinColumns={@JoinColumn(name="RadioSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="BookBinders_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
	 */
		protected $BookBinders;
	////////////////////////////////////////////////////////////////////////////////////////////////
/**
	 * @Column(type="string",length=50)
	 */
	protected $CenterName;
	/**
	 * 
	 * @scField(name="CenterName",type="string",title="نام مرکز ",DoctrineField="CenterName")
	 */
	public function getCenterName(){
	try {return $this->CenterName;}catch(\Exception $ex){return '';}
	}
	public function setCenterName($v){$this->CenterName=$v;}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	 * @ManyToMany(targetEntity="Auidunce")
	 * @var Auidunce
	 */
	protected $Audiences;
	////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * @OneToMany(targetEntity="RadioContentList",mappedBy="RadioSchool")
	 * @var RadioContentList
	 */
	protected $ContentList;
	////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * @Column(type="string",length=50)
	 */
	
	
	protected $AbstractFile;
	/**
	 * 
	 * @scField(name="AbstractFile",type="string",title="پرونده خلاصه ",DoctrineField="AbstractFile")
	 */
	
	
		public function getAbstractFile(){
	try {return $this->AbstractFile;}catch(\Exception $ex){return '';}
	}
	public function setAbstractFile($v){$this->AbstractFile=$v;}
	
	///////////////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	 * 
	 * @ManyToMany(targetEntity="FilmEducationalGoal")
	 * @var FilmEducationalGoal
	 */
	protected $EducationalGoals;
	
	
	
}