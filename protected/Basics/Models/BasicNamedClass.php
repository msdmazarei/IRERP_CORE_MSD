<?php
namespace IRERP\Basics\Models;
use \IRERP\Basics\Annotations\scField;
use Doctrine\ORM\Mapping\Column;
use 
IRERP\Basics\Annotations\UI\IRUseInClientDS,
IRERP\Basics\Annotations\UI\IRClientName,
IRERP\Basics\Annotations\UI\IRTitle,
IRERP\Basics\Annotations\UI\IRPropertyType,
IRERP\Basics\Annotations\UI\IRParentGridMember,
IRERP\Basics\Annotations\UI\IRPickListMember,
IRERP\Basics\Annotations\UI\IRUseAsProfile,
IRERP\Basics\Annotations\UI\IRPrimaryKey,
IRERP\Basics\Annotations\UI\IRHidden
;
   
/**
 * @Entity 
 * @Table(indexes={@Index(name="indx_Descrim",columns={"classname"})})
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="classname", type="string")
 * @DiscriminatorMap({
 * 						"TVR"="\IRERP\modules\jahad\models\TVRD",
 * 						"Mat"="\IRERP\modules\jahad\models\Matter",
 * 					  	"Tit"="\IRERP\modules\jahad\models\Title",
 * 						"MgT"="\IRERP\modules\jahad\models\MagazineType",
 * 						"Siz"="\IRERP\modules\jahad\models\Size",
 * 						"Yea"="\IRERP\modules\jahad\models\Year",
 * 						"Mag"="\IRERP\modules\jahad\models\MagNo",
 * 						"AUD"="\IRERP\modules\jahad\models\Auidunce",
 * 						"STA"="\IRERP\modules\jahad\models\State",
 * 						"NAT"="\IRERP\modules\jahad\models\Nationality",
 * 						"BNC"="BasicNamedClass",
 * 						"RES"="\IRERP\modules\jahad\models\Resulation",
 * 						"pif"="\IRERP\modules\jahad\models\PictureFormat",
 * 						"loc"="\IRERP\modules\jahad\models\Location",
 * 						"pit"="\IRERP\modules\jahad\models\PictureType",
 * 						"sub"="\IRERP\modules\jahad\models\Subject",
 * 						"fpf"="\IRERP\modules\jahad\models\FilmProductionFormat",
 * 						"fst"="\IRERP\modules\jahad\models\FilmSystemType",
 * 						"feg"="\IRERP\modules\jahad\models\FilmEducationalGoal"
 * 					})
 */

class BasicNamedClass extends IRDataModel
{
	

	 /**
     * @Column(type="string",length=50)
     * @IRUseInClientDS
     * @IRTitle(TitleType="STRING",Value="عنوان")
     * @IRClientName(ClientName="Name")
     * @IRPropertyType(Type="String")
     * @IRPickListMember 
     * @IRParentGridMember
     * @var string
     */

	protected $Name;
	 /**
     * @Column(type="string",length=1000,nullable=true)
     * @var string
     * @IRUseInClientDS(Profile="GENERAL,ABSTRACT,DETAIL")
     * @IRTitle(TitleType="STRING",Value="توضیحات")
     * @IRClientName(ClientName="Description")
     * @IRPropertyType(Type="String")
     * @IRPickListMember
     */
	protected $Description;
	 /*
     * @var string
     * Column(type="string",length=15)
     */
	protected $classname;
	
	
	/*******************
	 * BL Functions
	 */
	/**
	 * @scField(name="id",primaryKey=true,hidden=true,type="integer")
	 */
	public function getID(){return $this->id;}
	public function setID($newid){$this->id=$newid;}
	/**
	 * @scField(name="Name",type="string",title="نام",DoctrineField="Name")
	 */
	public function getName(){return $this->Name;}
	public function setName($newName){$this->Name=$newName;}
	/**
	 * @scField(name="Description",type="string",title="شرح",DoctrineField="Description")
	 */
	public function getDescription(){return $this->Description;}
	public function setDescription($newDesc){$this->Description=$newDesc;}
	
}
?>
