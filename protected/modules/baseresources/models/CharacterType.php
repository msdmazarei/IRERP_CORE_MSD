<?php
namespace IRERP\modules\baseresources\models;
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
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity 
 * SampleData: Hoghughi,Haghighi,...
 */
class CharacterType extends BaseResources_ENUMSUPCLASS
{
	/**
	 * @Id @generatedValue(strategy="AUTO") @Column(type="integer")
	 * 
	 * @IRUseInClientDS()
	 * @IRClientName(ClientName="id")
	 * @IRPrimaryKey(NotForProfile="ABSTRACT,")
	 * @IRHidden
	 * @IRPropertyType(Type="integer")
	 * @IRParentGridMember
	 * @IRTitle(TitleType="STRING",Value="نوع شخصیت")
	 * @var integer
	 */
	protected $id = null;
} 
?>