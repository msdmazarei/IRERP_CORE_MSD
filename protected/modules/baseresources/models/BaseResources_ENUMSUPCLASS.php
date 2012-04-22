<?php
namespace IRERP\modules\baseresources\models;
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
IRERP\Basics\Annotations\UI\IRPickListDisplayField
;

use Doctrine\ORM\Mapping\Column;

/**
 * @Entity 
 * @Table(name="TBA000",indexes={@Index(name="indx_Descrim",columns={"classname"})})
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="classname", type="string")
 * @DiscriminatorMap({
 * 						"CompanyType"="IRERP\modules\baseresources\models\CompanyType",
 * 						"CharacterType"="IRERP\modules\baseresources\models\CharacterType",
 * 						"EmailType"="IRERP\modules\baseresources\models\EmailType",
 * 						"TelephoneType"="IRERP\modules\baseresources\models\TelephoneType",
 * 						"PostalAddressType"="IRERP\modules\baseresources\models\PostalAddressType",
 * 						"SPECIAL_4_LOCTYP"="IRERP\modules\baseresources\models\SPECIAL_4_LOCTYP",
 * 						"CharacterTitle"="IRERP\modules\baseresources\models\CharacterTitle",
 * 						"BaseResources_ENUMSUPCLASS"="IRERP\modules\baseresources\models\BaseResources_ENUMSUPCLASS"  
 * 					})
 */
class BaseResources_ENUMSUPCLASS extends BaseResourceBasicClass
{

	 /**
     * @Column(type="string",length=50)
     * @IRUseInClientDS
     * @IRTitle(TitleType="STRING",Value="عنوان")
     * @IRClientName(ClientName="Name")
     * @IRPropertyType(Type="String")
     * @IRPickListMember 
     * @IRParentGridMember
     * @IRPickListDisplayField
     * @var string
     */
	protected $Title;
	public function getTitle(){return $this->Title;}
	public function setTitle($v){$this->Title=$v;}
	 /**
     * @Column(type="string",length=1000,nullable=true)
     * @var string
     * @IRUseInClientDS(Profile="GENERAL,DETAIL")
     * @IRTitle(TitleType="STRING",Value="توضیحات")
     * @IRClientName(ClientName="Description")
     * @IRPropertyType(Type="String")
     * @IRPickListMember
     */
	protected $Description;
	public function setDescription($v){$this->Description=$v;}
	 /*
     * @var string
     * Column(type="string",length=15)
     */
	protected $classname;	
}
?>