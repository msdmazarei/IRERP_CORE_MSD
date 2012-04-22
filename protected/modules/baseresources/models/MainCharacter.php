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
 * @author Nsm.Seifi
 * @Entity
 * @Table (name="TBA008")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="classname", type="string")
 * @DiscriminatorMap({
 *      "Company" = "Company",
 *      "MainCharacter" = "MainCharacter", 
 *      "Human" = "Human"
 *      })
 */
class MainCharacter extends BaseResourceBasicClass
{
	/**
	 * 
	 * @ManyToOne (targetEntity="CharacterTitle",fetch="LAZY")
	 * @var CharacterTitle
	 * 
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS(NotForProfile="JUSTCONAME")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile = "ABSTRACT",PostfixTitle=" شخص ")
	 * @IREnumRelation
	 * @IRInternalType(ClassName="\IRERP\modules\baseresources\models\CharacterTitle",RelationType="Simple")
	 */
	public $CharacterTitle;
	public function getCharacterTitle(){return $this->CharacterTitle;}
	
	/**
	 * 
	 * @Column (type = "string",length="50")
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="نام ")
	 * @IRPropertyType(Type="string")
	 */
	public $Name;
	
	/**
	 * 
	 * @Column (type = "string",length="500")
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS(NotForProfile="JUSTCONAME")
	 * @IRTitle(TitleType="STRING",Value="توضیحات")
	 * @IRPropertyType(Type="string")
	 */
	public $Description;
	/**
	 * 
	 * @Column ( type = "string",length="1000000",nullable=true)
	 * @var string
	 */
	protected $Pic='1';
	/**
	 * 
	 * @ManyToOne (targetEntity="CharacterType")
	 * @var CharacterType
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS(NotForProfile="JUSTCONAME")
	 * @IRTitle(TitleType="STRING",Value="نوع شخصیت")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle=" نوع شخص ")
	 * @IRInternalType(ClassName="\IRERP\modules\baseresources\models\CharacterType",RelationType="Simple") 
	 */
	public $CharacterType;
	/**
	 * 
	 * @OneToMany (mappedBy="Character",targetEntity="PostalAddress")
	 * @var PostalAddress[]
	 * -----------
	 * Client Side Definations
	 * -----------
	 * IRUseInClientDS
	 * 
	 * -----------
	 * Internal Relation Definations
	 * -----------
 	 * @IRDetailViewDefines(DetailTitle=@IRTitle(TitleType="STRING",Value="آدرس های پستی"))
	 * @IRUseAsProfile(TargetProfile="DETAIL")
	 */
	protected $PostalAddresses;
	/**
	 * 
	 * @OneToMany (mappedBy="Character",targetEntity="Email")
	 * @var Email[]
	 * IRUseInClientDS
  	 * @IRDetailViewDefines(DetailTitle=@IRTitle(TitleType="STRING",Value="پست های الکترونیکی"))
	 * @IRUseAsProfile(TargetProfile="DETAIL")
	 */
	protected $Emails;
	/**
	 * 
	 * @OneToMany (mappedBy="Character",targetEntity="Telephone")
	 * @var Telephone[]
	 * IRUseInClientDS
	 * @IRDetailViewDefines(DetailTitle=@IRTitle(TitleType="STRING",Value="تلفن ها"))
	 * @IRUseAsProfile(TargetProfile="DETAIL")
	 */
	protected $Telephones;
	
	protected $classname;
	
	/**
	 * 
	 * @Column (type = "string",length="50",nullable=true)
	 * @var string
	 */
	protected $BirthDate='1';
	
	/**
	 * 
	 * @ManyToOne (targetEntity="Location") 
	 * Detail: Location | Location.LocationType=Country
	 * @var Location
	 * -----------
	 * Client Side Definations
	 * -----------
	 * IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="ملیت")
	 * @IRUseAsProfile(TargetProfile="ABSTRACT")
	 */
	public $Nationality;
	
}
?>