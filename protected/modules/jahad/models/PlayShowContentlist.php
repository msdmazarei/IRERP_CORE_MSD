<?php
namespace IRERP\modules\jahad\models;

use IRERP\Basics\Models\IRDataModel;

use IRERP\Basics\Models\BasicNamedClass;
use IRERP\Basics\Annotations\scField;
use IRERP\Basics\Annotations\UI\IRUseInClientDS,
IRERP\Basics\Annotations\UI\IRClientName,
IRERP\Basics\Annotations\UI\IRTitle,
IRERP\Basics\Annotations\UI\IRPropertyType,
IRERP\Basics\Annotations\UI\IRParentGridMember,
IRERP\Basics\Annotations\UI\IRPickListMember,
IRERP\Basics\Annotations\UI\IRUseAsProfile,
IRERP\Basics\Annotations\UI\IRRequire
;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Id;
/**
 * @Entity
 * 
 * @author masoud
 *
 */
class PlayShowContentlist extends IRDataModel
{
	/**
	 * @ManyToOne(targetEntity="PlayShow",inversedBy="PlayShowContentlists")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRRequire
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRParentGridMember
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle=" نمایش ")
	 */
	protected $PlayShow;
	
	/**
	 * @Column(type="string",length=50)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRRequire
	 * @IRTitle(TitleType="STRING",Value="عنوان")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRParentGridMember
	 */
	protected $ContentTitle;
	
	/**
	 * @Column(type="string",length=500)
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="توضیحات")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 */
	protected $Description;
	
	
	
	public function getPlayShowName()
	{
	try {return $this->PlayShow->getPlayShowName();}catch(\Exception $ex){return '';}
	}
   public function setPlayShowName($v){}
public function getPlayShowID(){
	try {return $this->PlayShow->getid();}catch(\Exception $ex){return NULL;}
	}
	public function setPlayShowID($v){
	try {
		$this->PlayShow=new PlayShow();
		$this->PlayShow= $this->PlayShow->GetByID($v);
	}catch(\Exception $ex){}
	}
	/**
	 * 
	 * @scField(name="ContentTitle",type="string",title="آیتم",DoctrineField="ContentTitle")
	 */
	public function getContentTitle(){
	try {return $this->ContentTitle;}catch(\Exception $ex){return '';}
	}
	public function setContentTitle($v){$this->ContentTitle=$v;}
	
	/**
	 * 
	 * @scField(name="Description",type="string",title="توضیح",DoctrineField="Description")
	 */
	public function getDescription(){
	try {return $this->Description;}catch(\Exception $ex){return '';}
	}
	public function setDescription($v){$this->Description=$v;}
	
}
?>