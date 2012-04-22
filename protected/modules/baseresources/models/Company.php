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
IRERP\Basics\Annotations\UI\IRDetailViewDefines,
IRERP\Basics\Annotations\UI\IRInternalType
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
 * 
 * @Entity 
 * @Table (name="TBA006")
 * @IRTitle(TitleType="STRING",Value="شرکت")
 * @author Nsm.Seifi
 *
 */
class Company extends MainCharacter
{
	/**
	 * 
	 * @Column (type = "string",length="50")
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="کد اقتصادی")
	 * @IRPropertyType(Type="string")
	 */
	protected $CommericalCode;
	
	/**
	 * 
	 * @ManyToOne (targetEntity="Company",inversedBy="ChildrenCompany")
	 * @var Company
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS(Profile="GENERAL,ABSTRACT,DETAIL")
	 * @IRTitle(TitleType="STRING",Value=" شرکت پدر")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRInternalType(ClassName="\IRERP\modules\baseresources\models\Company",RelationType="Simple")
	 * @IREnumRelation
	 * @IRUseAsProfile(Profile="GENERAL,DETAIL",TargetProfile="JUSTCONAME",PostfixTitle=" شرکت پدر ")
	 * @IRUseAsProfile(Profile="ABSTRACT",TargetProfile="ABSTRACT1")
	 * @IRUseAsProfile(Profile="ABSTRACT1",TargetProfile="NONE")
	 * 
	 */
	protected $ParentCompany;
	/**
	 * 
	 * @OneToMany (mappedBy="ParentCompany",targetEntity="Company")
	 * @var Company[]
	 * -----------
	 * Client Side Definations
	 * -----------
	 * IRUseInClientDS
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL")
	 * @IRDetailViewDefines(DetailTitle=@IRTitle(TitleType="STRING",Value="شرکت های فرزند"))
	 * @IREnumRelation
	 */
	protected $ChildrenCompany;
	
}
?>