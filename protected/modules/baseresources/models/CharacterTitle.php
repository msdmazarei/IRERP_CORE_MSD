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
IRERP\Basics\Annotations\UI\IRInternalType
;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\ManyToOne;
/**
 * @Entity
 * @IRTitle(TitleType="STRING",Value="عنوان")
 * @author masoud
 * SampleData: SHEREKAT,TAAVONI,AGHA,Khanum,...
 */
class CharacterTitle extends BaseResources_ENUMSUPCLASS
{
	

	/**
	 * 
	 * @ManyToMany (targetEntity="CharacterType")
	 * @JoinTable (
	 *    name="TBM_CharacterTitle_CharacterType",
	 *    joinColumns = {@JoinColumn (name="CharTit",referencedColumnName = "id")},
	 *    inverseJoinColumns = {@JoinColumn (name="charType", referencedColumnName = "id")}
	 *)
	 *
	 * * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS(Profile="GENERAL1")
	 * @IRTitle(TitleType="STRING",Value="قابل استفاده در ")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="Detail")
	 * 
	 * @var CharacterType[]
	 */
	protected $UseForCharTypes;
}
?>