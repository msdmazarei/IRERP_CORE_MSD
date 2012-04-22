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
 * 
 * @Entity 
 * @Table (name="TBA005")
 * @author Nsm.Seifi
 *
 */
class PostalAddress extends ContactBase
{
	/**
	 * 
	 * @Column (type = "string",length="500",nullable = true)
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="توضیحات اضافی")
	 * @IRPropertyType(Type="string")
	 * 
	 */
	protected $ExtraDescription;
	/**
	 * 
	 * Plak Number
	 * @Column (type = "string",length="50",nullable = true)
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="شماره پلاک")
	 * @IRPropertyType(Type="string")
	 */
	protected $No;
	
	/**
	 * 
	 * @ManyToOne (targetEntity="PostalAddressType")
	 * @var PostalAddressType
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="نوع آدرس پستی")
	 * @IRUseAsProfile(TargetProfile="ABSTRACT")
	 */
	protected $PostalAddressType;
	
	/**
	 * 
	 * @ManyToOne (targetEntity="Location")
	 * @var Location
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="موقعیت جفرافیایی")
	 * @IRUseAsProfile(TargetProfile="ABSTRACT")
	 */
	protected $Location;
	/**
	 * 
	 * @ManyToOne (targetEntity="MainCharacter")
	 * @var MainCharacter
	 * -----------
	 * Client Side Definations
	 * -----------
	 * IRUseInClientDS(Profile="GENERAL")
	 * @IRTitle(TitleType="STRING",Value="شخصیت")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="ABSTRACT")
	 */
	protected $Character;
		
}