<?php
namespace IRERP\modules\admin\models;

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
\IRERP\Basics\Annotations\UI\IRRequire,
\IRERP\Basics\Annotations\UI\IRInternalType
;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;


/**
 * @Entity @Table(name="Menu")
 */
class Menu extends IRDataModel
{
	/**
	 * @Column(type="string",length=50)
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRRequire
	 * @IRTitle(TitleType="STRING",Value="عنوان منو")
	 * @IRPropertyType(Type="string")
	 */
	protected $Title;
	
	/**
	 * @Column(type="string",length="1500")
	 * Enter Icon for Menu
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS(NotForProfile="SIMPLE")
	 * @IRTitle(TitleType="STRING",Value="شمایل")
	 * @IRPropertyType(Type="string")
	 */
	protected $Icon;
	
	/**
	 * @ManyToOne(targetEntity="Menu",inversedBy="Children")
	 * @var Menu
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS(NotForProfile="SIMPLE")
	 * @IRTitle(TitleType="STRING",Value="منو پدر")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="SIMPLE")
	 * @IRInternalType(ClassName="\IRERP\modules\admin\models\Menu",RelationType="Simple") 
	 */
	protected $Parent;
	
	/**
	 * @OneToMany(targetEntity="Menu",mappedBy="Parent")
	 * @var Menu[]
	 */
	protected $Children;
	
	/**
	 * @Column(type="string",length=500)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS(NotForProfile="SIMPLE")
	 * @IRTitle(TitleType="STRING",Value="دستور")
	 * @IRPropertyType(Type="string")
	 */
	protected $Command;
	
}
?>
