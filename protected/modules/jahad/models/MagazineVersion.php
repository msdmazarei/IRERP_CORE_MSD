<?php

namespace IRERP\modules\jahad\models;

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
 * @Entity
 * @author masoud
 *
 */
class MagazineVersion extends IRDataModel
{
	// <=================== Properties
	/**
	 * @Column(type="string",length=15)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRRequire
	 * @IRTitle(TitleType="STRING",Value="شماره")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @var string
	 */
	protected $shomare;
	/**
	 * @Column(type="integer")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="تیراژ")
	 * @IRPropertyType(Type="integer")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @var integer
	 */
	protected $tirajh;
	/**
	 * @ManyToOne(targetEntity="Magazine",inversedBy="magver")
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
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle=" مجله ")
	 * @var Magazine
	 */
	protected $Magazine;
	/**
	 * @ManyToOne(targetEntity="Year")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRRequire
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle=" سال ")
	 * 
	 * 
	 * @var Year
	 */
	protected $year;
	
	/**
	 * @ManyToMany(targetEntity="Auidunce")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="مخاطبان")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL")
	 * @var Auidunce[]
	 */
	protected $mokhatab;		
	
	/**
	 * @ManyToMany(targetEntity="Size")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="قطع ها")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL")
	 * @var Size[]
	 */
	protected $Ghate;
	/**
	 * @ManyToMany(targetEntity="Human")
	 * @JoinTable(name="magver_Human_modirmasoul",
	 *     		 joinColumns={
	 *     					@JoinColumn
	 *     								(
	 *     									name="magver_id", 
	 *     									referencedColumnName="id"
	 *     								)
	 *     						},
	 *      inverseJoinColumns={
	 *      				@JoinColumn
	 *      							(
	 *      							name="human_id",
	 *      							referencedColumnName="id"
	 *      							)
	 *      					}
	 *      )
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="مدیر مسیولان")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL") 
	 * @var Human[]
	 */
	protected $modirmasoul;
	
	/**
	 * @ManyToMany(targetEntity="Human")
	 * @JoinTable(name="magver_Human_nevisandeh",
	 *     		 joinColumns={
	 *     					@JoinColumn
	 *     								(
	 *     									name="magver_id", 
	 *     									referencedColumnName="id"
	 *     								)
	 *     						},
	 *      inverseJoinColumns={
	 *      				@JoinColumn
	 *      							(
	 *      							name="human_id",
	 *      							referencedColumnName="id"
	 *      							)
	 *      					}
	 *      )
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="نویسندگان")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL") 
	 * @var Human[]
	 */
	protected $nevisandeh;
		
	//                      Properties ===================>
	//------------------------------------------
	/**
	 * 
	 * @scField(name="Magazineid",DoctrineField="Magazine.id",hidden=true)
	 */
	public function getMagazineid(){
		if(isset($this->Magazine))
		return $this->Magazine->getid();
	}
	public function setMagazineid($d){
		$tmp= new Magazine();
		
		$this->Magazine=$tmp->GetByID($d);
	
	}
	/**
	 * 
	 * @scField(name="MagazineTitle",DoctrineField="Magazine.onvan.Name",title="عنوان مجله")
	 */
	public function getMagazineTitle(){
		if(isset($this->Magazine))
		return $this->Magazine->getTitle()->getName();}
	public function setMagazineTitle(){}
/*	/**
	 * @Id @generatedValue(strategy="AUTO") @Column(type="integer")
	 * @var integer
	 *
protected $id;*/
public function getGhate(){return $this->Ghate;}
public function setGhate($g){ $this->Ghate=$g;}

public function getYear(){return $this->year;}
public function setYear($g){ $this->year=$g;}

/**
 * 
 * @scField(name="YearID",DoctrineField="year.id",hidden=true)
 */
public function getYearid(){return $this->year->getid();}
public function setYearid($id=NULL){
	if(isset($id)){
		$a = new Year();
	
		$this->year=$a->GetByID($id);
	}
}
/**
 * 
 * @scField(name="YearTitle",DoctrineField="year.Name",title="سال")
 */
public function getYearTitle(){if(isset($this->year))  return $this->year->getName();}
public function setYearTitle($a){} 



public function getModirMasoul(){return $this->modirmasoul;}
public function setModirMasoul($g){ $this->modirmasoul=$g;}
public function getNevisandeh(){return $this->nevisandeh;}
public function setNevisandeh($g){ $this->nevisandeh=$g;}

/**
 * 
 * @scField(name="Shomare",DoctrineField="shomare",title="شماره")
 */
public function getShomare(){return $this->shomare;}
public function setShomare($g){ $this->shomare=$g;}



/**
 * 
 * @scField(name="Tirajh",title="تیراژ",DoctrineField="tirajh")
 */
public function getTirajh(){return $this->tirajh;}
public function setTirajh($g){ $this->tirajh=$g;}


public function getMokhatab(){return $this->mokhatab;}
public function setMokhatab($g){ $this->mokhatab=$g;}



}
?>
