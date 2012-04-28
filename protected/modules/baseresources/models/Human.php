<?php
namespace IRERP\modules\baseresources\models;
use IRERP\Basics\Validation\ModelValidationReturnClass;

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
IRERP\Basics\Annotations\UI\IREnumRelation
;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
/**
 * 
 * @Entity 
 * @Table (name="TBA007")
 * @author Nsm.Seifi
 *
 */
class Human extends MainCharacter
{
	/**
	 * 
	 * @Column(type = "string",length="50")
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="نام پدر")
	 * @IRPropertyType(Type="string")
	 */
	public $FatherName;
	
	/**
	 * 
	 * @Column(type = "string",length="50")
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="نام خانوادگی")
	 * @IRPropertyType(Type="string")
	 */
	public $LastName;
	
	/**
	 * 
	 * @Column(type = "string",length="50")
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="کد ملی")
	 * @IRPropertyType(Type="string")
	 */
	public $NationalCode;
}
?>