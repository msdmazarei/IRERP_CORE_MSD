<?php
namespace  IRERP\modules\baseresources\models;
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
 * 
 * @Entity 
 * @Table (name="TBA004")
 * @author Nsm.Seifi
 *
 */
class Telephone extends ContactBase
{
	/**
	 * 
	 * @Column (type = "string",length="50",nullable = false)
	 * 
	 * @var string
	 * 
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="شماره")
	 * @IRPropertyType(Type="string")
	 */
	protected $Number;
	/**
	 * 
	 * @Column (type = "string",length=500,nullable = true)
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
	 * 
	 * @ManyToOne (targetEntity="TelephoneType")
	 * @var TelephoneType
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="نوع تلفن")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="ABSTRACT")
	 */
	protected $TelephoneType;
	
	/**
	 * 
	 * @ManyToOne (	targetEntity="MainCharacter")
	 * @var MainCharacter
	 * -----------
	 * Client Side Definations
	 * -----------
	 * IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="شخص")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="ABSTRACT")
	 */
	protected $Character;
	
}
?>