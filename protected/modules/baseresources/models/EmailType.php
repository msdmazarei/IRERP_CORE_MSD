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
/**
 * @Entity 
 * Sample Data: WORK,PERSONALITY,...
 */
class EmailType extends BaseResources_ENUMSUPCLASS
{
	/**
	 * 
	 * @ManyToMany (targetEntity="CharacterType")
	 * @JoinTable (
	 *    name="TBM_EmailType_CharacterType",
	 *    joinColumns = {@JoinColumn (name="EmailType",referencedColumnName = "id")},
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