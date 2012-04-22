<?php
namespace IRERP\modules\jahad\models;
use IRERP\Basics\Models\IRDataModel;

use 
IRERP\Basics\Annotations\UI\IRUseInClientDS,
IRERP\Basics\Annotations\UI\IRClientName,
IRERP\Basics\Annotations\UI\IRTitle,
IRERP\Basics\Annotations\UI\IRPropertyType,
IRERP\Basics\Annotations\UI\IRParentGridMember,
IRERP\Basics\Annotations\UI\IRPickListMember,
IRERP\Basics\Annotations\UI\IRUseAsProfile,
IRERP\Basics\Annotations\UI\IRPrimaryKey,
IRERP\Basics\Annotations\UI\IRHidden,
IRERP\Basics\Annotations\UI\IREnumRelation
;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity @Table(name="Human")
 */
class Human extends IRDataModel
{
	/**
	 * @Column(type="string",length=50)
	 * @IRUseInClientDS(Profile="Detail1,")
	 * @IRTitle(TitleType="STRING",Value="نام")
	 * @IRClientName(ClientName="FirstName")
	 * @IRPropertyType(Type="STRING")
	 * @IRPickListMember
	 * @IRParentGridMember
	 */
	protected $fname;
	/**
	 * @Column(type="string",length=50)
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="نام خانوادگی")
	 * @IRClientName(ClientName="LastName")
	 * @IRPropertyType(Type="STRING")
	 * @IRPickListMember
	 * @IRParentGridMember
	 */
	protected $lname;
	/**
	 * @Column(type="string",length=50,nullable=true)
 	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="کد ملی")
	 * @IRClientName(ClientName="NationalCode")
	 * @IRPropertyType(Type="STRING")
	 * @IRPickListMember
	 */
	protected $NationalCode;
	/**
	 * @Column(type="string",length=50,nullable=true)
 	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="نام پدر")
	 * @IRClientName(ClientName="FatherName")
	 * @IRPropertyType(Type="STRING")
	 */
	protected $fathername;
	/**
	 * @Column(type="string",length=50,nullable=true)
 	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="شماره تلفن")
	 * @IRClientName(ClientName="PhoneNumber")
	 * @IRPropertyType(Type="STRING")
	 */
	protected $phoneno;
	/**
	 * @ManyToOne(targetEntity="Nationality")
	 * @var Nationality
	 * @IRUseInClientDS
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle=" ملیت ")
	 * @IRParentGridMember
	 */
	protected $nationality;
	/**
	 *
	 * @Column(type="string",length=50,nullable=true)
 	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="کد پستی")
	 * @IRClientName(ClientName="PostalCode")
	 * @IRPropertyType(Type="STRING")
	 */
	protected $postalcode;
	
	
	/**
	 *
	 * @scField(type="string",title="نام",DoctrineField="fname",name="FirstName")
	 */
	public function getFirstName(){
		return $this->fname;
	}
	public function setFirstName($name){
		$this->fname=$name;
	}
		/**
	 *
	 * @scField(
	 * 	type="string",
	 * 	title="نام خانوادگی",
	 * 	DoctrineField="lname",
	 * 	name="LastName"
	 * )
	 *
	 */
	public function getLastName(){
		return $this->lname;
	}
	public function setLastName($LName){
		$this->lname=$LName;
	}
		/**
	 *
	 * @scField(
	 * 	type="string",
	 * 	title="کدملی",
	 * 	DoctrineField="NationalCode",
	 * 	name="NationalCode"
	 * )
	 */
	public function getNationalCode(){
		return $this->NationalCode;
	}
	public function setNationalCode($nl){
		$this->NationalCode=$nl;
	}
		/**
	 *
	 * @scField(
	 *	type="string",
	 * 	title="نام پدر",
	 * 	DoctrineField="fathername",
	 * 	name="FatherName"
	 * )
	 */
	public function getFatherName(){
		return $this->fathername;
	}
	public function setFatherName($fn){
		$this->fathername=$fn;
	}
	
	/**
	 *
	 * @scField(
	 * 	type="string",
	 * 	title="کدپستی",
	 * 	name="PostalCode",
	 * 	DoctrineField="postalcode"
	 * )
	 */
	
	
	public function getPostalCode(){
		return $this->postalcode;
	}
	public function setPostalCode($pl){
		$this->postalcode=$pl;
	}
		/**
	 *
	 * @scField(
	 * 	type="string",
	 * 	title="ملیت",
	 * 	DoctrineField="nationality.Name",
	 * 	name="NationalityTitle"
	 * )
	 */
	public function getNationality(){
		if(isset($this->nationality)){
		try{
		return $this->nationality->getName();}
		catch (\CException $e){return '';}
		}
	}
	public function setNationality($nl) {
		/*$this->nationality=$nl;*/
	}

	/**
	 *
	 * @scField(
	 * 	type="integer",
	 * 	hidden=true,
	 * 	name="NationalityID"
	 * )
	 */
	public function getNationalityID(){
		if(isset($this->nationality))
			return $this->nationality->getID();
		else
			return null;
	}
	public function setNationalityID($nid){
		//Reterive Nationality Object From Data Bank
		$nationality= new Nationality();
		$nationality= $nationality->GetByID($nid);
		$this->nationality=$nationality;
	}
	/**
	 *
	 * @scField(type="string",title="شماره تلفن",DoctrineField="phoneno",name="PhoneNo")
	 */
	public function getPhoneNo(){
		return $this->phoneno;
	}
	public function setPhoneNo($p){
		$this->phoneno=$p;
	}

	

	

}
?>