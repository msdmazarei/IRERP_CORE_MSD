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
/**
 * 
 * @Entity 
 * @Table (name="TBA003")
 * @author Nsm.Seifi
 * TBName: TBA003
 */
class Email extends ContactBase
{
	/**
	 * 
	 * @Column (type = "string",length="100")
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="نام حساب کاربری")
	 * @IRPropertyType(Type="string")
	 */
	protected $Account;

	/**
	 * 
	 * @Column (type = "string",length="100")
	 * 
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="کلمه عبور")
	 * @IRPropertyType(Type="string")
	 */
	protected $Password;
	
	/**
	 * 
	 * @Column (type = "string",length="100")
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="میزبان")
	 * @IRPropertyType(Type="string")
	 */
	protected $Host;

	/**
	 * 
	 * @ManyToOne (targetEntity="EmailType")
	 * @var EmailType
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="نوع پست الکترونیک")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="ABSTRACT")
	 */
	protected $EmailType;
	
	/**
	 * 
	 * @ManyToOne (targetEntity="MainCharacter")
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