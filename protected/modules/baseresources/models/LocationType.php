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
 * @Table (name="TBA002")
 * @author masoud
 * SampleData: Country,State,City,Village,Avenue,Street,...
 * TBName: TBA002
 */
class LocationType extends BaseResourceBasicClass
{
	/**
	 * @Column(type="string",length="50")
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="عنوان")
	 * @IRPropertyType(Type="string")
	 */
	protected $Title;
	/**
	 * @Column(type="string",length="500")
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="توضیحات")
	 * @IRPropertyType(Type="string")
	 */
	protected $Description;


	/**
	 * @OneToMany(targetEntity="SPECIAL_4_LOCTYP",mappedBy="LocationType") 
	 * @var SPECIAL_4_LOCTYP[]
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL")
	 * @IRDetailViewDefines(DetailTitle=@IRTitle(TitleType="STRING",Value="موقعیت های خاص"))
	 */
	protected $Specials;
	
	
	/**
	 * @ManyToOne(targetEntity="LocationType",inversedBy="Children")
	 * @var LocationType
	 * -----------
	 * Client Side Definations
	 * -----------
	 * IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="نوع پدر")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="ABSTRACT")
	 */
	protected $Parent;

	/**
	 * 
	 * @OneToMany(targetEntity="LocationType",mappedBy="Parent")
	 * @var LocationType[]
	 * -----------
	 * Client Side Definations
	 * -----------
	 * IRUseInClientDS
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL")
	 * @IRDetailViewDefines(DetailTitle="نوع های فرزند")
	 */
	protected $Children;
}
?>