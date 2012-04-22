<?php
namespace IRERP\modules\jahad\models;

use IRERP\Basics\Models\IRDataModel,
    IRERP\Basics\Annotations\scField;
 use IRERP\modules\jahad\models\TVEducationalGoal;     
/**
 * @Entity 
 */
class TVSchool extends IRDataModel
{
	
/**
	 * @Column(type="string",length=50)
	 */
	protected $TVSchoolName;
/**
	 * 
	 * @scField(name="TVSchoolName",type="string",title="نام ",DoctrineField="TVSchoolName")
	 */
	public function getTVSchoolName(){
	try {return $this->TVSchoolName;}catch(\Exception $ex){return '';}
	}
	public function setTVSchoolName($v){$this->TVSchoolName=$v;}
	
	///////////////////////////////////////////////////////////////////////////
	
/**
	 * @Column(type="string",length=50)
	 */
	protected $TVTitle;
/**
	 * 
	 * @scField(name="TVTitle",type="string",title="عنوان ",DoctrineField="TVTitle")
	 */
	public function getTVTitle(){
	try {return $this->TVTitle;}catch(\Exception $ex){return '';}
	}
	public function setTVTitle($v){$this->TVTitle=$v;}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	
/**
	 * @Column(type="string",length=500)
	 */
	protected $TVDescription;
	/**
	 * 
	 * @scField(name="TVDescription",type="string",title="توضیحات ",DoctrineField="TVDescription")
	 */
	public function getTVDescription(){
	try {return $this->TVDescription;}catch(\Exception $ex){return '';}
	}
	public function setTVDescription($v){$this->TVDescription=$v;}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
	 * @Column(type="string",length=50)
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
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="TVSchool_Publishers",
	 *      joinColumns={@JoinColumn(name="TVSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Publishers_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
	 */
	protected $Publishers;
	////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="TVSchool_Writers",
	 *      joinColumns={@JoinColumn(name="TVSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Writer_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
	 */
	protected $Writers;
	////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="TVSchool_TechnicalExperts",
	 *      joinColumns={@JoinColumn(name="TVSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="TechnicalExpert_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
	 */
	protected $TechnicalExperts;
	////////////////////////////////////////////////////////////////////////////////////////////////
		/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="TVSchool_TechnicalSupervisors",
	 *      joinColumns={@JoinColumn(name="TVSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="TechnicalSupervisor_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
	 */
	protected $TechnicalSupervisors;
	////////////////////////////////////////////////////////////////////////////////////////////////
/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="TVSchool_TVPrints",
	 *      joinColumns={@JoinColumn(name="TVSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="TVPrints_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
	 */	protected $TVPrints;
	////////////////////////////////////////////////////////////////////////////////////////////////
		/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="TVSchool_TypeSetters",
	 *      joinColumns={@JoinColumn(name="TVSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="TypeSetter_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
	 */
	protected $TypeSetters;
	////////////////////////////////////////////////////////////////////////////////////////////////
		/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="TVSchool_Editors",
	 *      joinColumns={@JoinColumn(name="TVSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Editor_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
	 */
	protected $Editors;
	////////////////////////////////////////////////////////////////////////////////////////////////
		/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="TVSchool_PageStylists",
	 *      joinColumns={@JoinColumn(name="TVSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="PageStylist_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
	 */
	protected $PageStylists;
	////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="TVSchool_Graphists",
	 *      joinColumns={@JoinColumn(name="TVSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Graphist_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
	 */
	protected $Graphists;
	////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * 
	 * @ManyToMany(targetEntity="Human")
     * @JoinTable(name="TVSchool_Preparators",
	 *      joinColumns={@JoinColumn(name="TVSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="Preparator_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
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
     * @JoinTable(name="TVSchool_LitoGraphists",
	 *      joinColumns={@JoinColumn(name="TVSchool_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="LitoGraphist_id", referencedColumnName="id")}
 	 *      )

	 * @var Human
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
     * @JoinTable(name="TVSchool_BookBinders",
	 *      joinColumns={@JoinColumn(name="TVSchool_id", referencedColumnName="id")},
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
	 * @OneToMany(targetEntity="TVContentList",mappedBy="TVSchool")
	 * @var TVContentList
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

