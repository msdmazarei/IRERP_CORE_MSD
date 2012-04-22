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
IRERP\Basics\Annotations\UI\IREnumRelation
;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Entity;
/**
 * @Entity 
 * Sample Data: WORK,HOME,...
 */
class PostalAddressType extends BaseResources_ENUMSUPCLASS
{
	/**
	 * 
	 * @ManyToMany (targetEntity="CharacterType")
	 * @JoinTable (
	 *    name="TBM_PostalAddressType_CharacterType",
	 *    joinColumns = {@JoinColumn (name="PostalAddressType",referencedColumnName = "id")},
	 *    inverseJoinColumns = {@JoinColumn (name="charType", referencedColumnName = "id")}
	 *)
	 * @var CharacterType[]
	 * 
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="قابل استفاده برای")
	 * @IRPropertyType(Type="string")
	 */
	protected $UseForCharTypes;
} 
?>