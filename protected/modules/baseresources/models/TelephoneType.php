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
IRERP\Basics\Annotations\UI\IREnumRelation,
IRERP\Basics\Annotations\UI\IRDetailViewDefines
;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
/**
 * @Entity 
 * Sample Data: WORK,HOME,...
 */
class TelephoneType extends BaseResources_ENUMSUPCLASS
{
	/**
	 * 
	 * @ManyToMany (targetEntity="CharacterType")
	 * @JoinTable (
	 *    name="TBM_TelephoneType_CharacterType",
	 *    joinColumns = {@JoinColumn (name="TelephoneType",referencedColumnName = "id")},
	 *    inverseJoinColumns = {@JoinColumn (name="charType", referencedColumnName = "id")}
	 *)
	 * @var CharacterType[]
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL")
	 * @IRDetailViewDefines(DetailTitle=@IRTitle(TitleType="STRING",Value="قابل استفاده برای"))
	 */
	protected $UseForCharTypes;
	
} 
?>