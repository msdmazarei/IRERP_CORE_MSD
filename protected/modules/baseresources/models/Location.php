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
 * @Table (name="TBA001")
 * SampleData: Iran,Englnd,Tehran,London,...
 * TableName: TBA001
 * @author Nsm.Seifi
 *
 */
class Location extends BaseResourceBasicClass
{
	/**
	 * 
	 * @Column (type = "float",nullable = true)
	 * @var double
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="طول جفرافیایی")
	 * @IRPropertyType(Type="string")
	 */
	protected $X;

	/**
	 * 
	 * @Column (type = "float",nullable = true)
	 * @var double
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="عرض جغرافیایی")
	 * @IRPropertyType(Type="string")
	 */
	protected $Y;
	
	/**
	 * 
	 * @Column (type = "float",nullable = true)
	 * @var double
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="ارتفاع از سطح دریا")
	 * @IRPropertyType(Type="string")
	 */
	protected $Z;
	
	/**
	 * 
	 * @Column (type = "string",nullable = false)
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
	 * 
	 * @Column (type = "string",nullable = true)
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
	 * @ManyToOne (targetEntity="Location")
	 * 
	 * @var Location
	 * -----------
	 * Client Side Definations
	 * -----------
	 * IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="موقیت پدر")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="ABSTRACT")
	 */
	protected $ParentLoc;

	/**
	 * 
	 * @ManyToOne (targetEntity="LocationType")
	 * @var LocationType
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="نوع")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="ABSTRACT")
	 */
	protected $LocType;
	
}
?>