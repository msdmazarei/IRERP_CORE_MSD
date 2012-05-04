<?php
namespace IRERP\modules\admin\models;

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
IRERP\Basics\Annotations\UI\IREnumRelation,
IRERP\Basics\Annotations\UI\IRRequire,
IRERP\Basics\Annotations\UI\IRInternalType,
IRERP\Basics\Annotations\Validation\IRVRequire

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
	 * @Column(type="string",length=50,name="Title")
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="TRANS",TransCat="IRERP",TransMsg="modules.admin.models.Menu.Title")
	 * @IRPropertyType(Type="string")
	 * @IRVRequire
	 */
	protected $_Title;
	public function getTitle(){return $this->_Title;}
	public function setTitle($value){$this->_Title=$value;}
	/**
	 * @Column(type="string",length="1500",name="Icon")
	 * Enter Icon for Menu
	 * @var string
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS(NotForProfile="SIMPLE")
	 * @IRTitle(TitleType="TRANS",TransCat="IRERP",TransMsg="modules.admin.models.Menu.Icon")
	 * @IRPropertyType(Type="string")
	 */
	protected $_Icon;
	public function getIcon(){return $this->_Icon;}
	public function setIcon($value){$this->_Icon=$value;}
	
	/**
	 * @ManyToOne(targetEntity="Menu",inversedBy="Children")
	 * @var Menu
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS(NotForProfile="SIMPLE")
	 * @IRTitle(TitleType="TRANS",TransCat="IRERP",TransMsg="modules.admin.models.Menu.Parent")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="SIMPLE",PostfixTitle=@IRTitle(TitleType="TRANS",TransCat="IRERP",TransMsg="modules.admin.models.Menu.Parent"))
	 * @IRInternalType(ClassName="\IRERP\modules\admin\models\Menu",RelationType="Simple") 
	 */
	protected $_Parent;
	public function getParent(){return $this->_Parent;}
	public function setParent($value){$this->_Parent=$value;}
	
	/**
	 * @OneToMany(targetEntity="Menu",mappedBy="Parent")
	 * @var Menu[]
	 */
	protected $_Children;
	public function getChildren(){return $this->_Children;}
	public function setChildren($value){$this->_Children=$value;}
	/**
	 * @Column(type="string",length=500,name="Command")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS(NotForProfile="SIMPLE")
	 * @IRTitle(TitleType="TRANS",TransCat="IRERP",TransMsg="modules.admin.models.Menu.Command")
	 * @IRPropertyType(Type="string")
	 */
	protected $_Command;
	public function getCommand(){return $this->_Command;}
	public function setCommand($value){$this->_Command=$value;}
	

	
}
?>
