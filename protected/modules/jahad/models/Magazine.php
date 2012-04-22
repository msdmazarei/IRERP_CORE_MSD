<?php
namespace IRERP\modules\jahad\models;

use IRERP\models\DbEntity;
use IRERP\modules\jahad\models;
use IRERP\Basics\Annotations\scField;
use IRERP\Basics\Models\IRDataModel;
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
 * 
 * @author masoud
 * @Entity 
 * 
 */
class Magazine extends IRDataModel
{
	//<================ Properties
	/**
	 * @ManyToOne(targetEntity="Title")
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
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle=" مجله ")
	 * @var Title
	 */
	protected $onvan;
	/**
	 * @ManyToOne(targetEntity="MagazineType")
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
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle=" مجله ")
	 * 
	 * @var MagazineType
	 */
	protected $noe_majale;
	
	/**
	 * 
	 * @ManyToMany(targetEntity="Matter")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="موضوعات")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL")
	 * @var Matter[]
	 */
	protected $mozu;
	/**
	 * @OneToMany(targetEntity="MagazineVersion",mappedBy="Magazine")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="نسخه ها")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL")
	 * @var MagazineVersion[]
	 */
	protected $magver;
	//					Properties ==================>
	public function getTitle(){return $this->onvan;}
	public function setTitle($ti){$this->onvan=$ti;}
	
	/**
	 * @scField(type="string",name="TitleName",title="عنوان",DoctrineField="onvan.Name")
	 */
	public function getTitleName(){if(isset($this->onvan))return $this->onvan->getName();}
	public function setTitleName($v){}
	
	/**
	 * @scField(type="integer",name="onvan_id",title="عنوان",DoctrineField="onvan.id",hidden=true)
	 */
	public function getTitleid(){if(isset($this->onvan)) return $this->onvan->getid(); else return null;}
	public function setTitleid($id){
		$tit = new Title();
		$tit= $tit->GetByID($id);
		$this->onvan=$tit;
	}
	
	public function getMatters(){return $this->mozu;}
	public function setMatters($m){$this->mozu=$m;}
	
	public function getMagType(){return $this->noe_majale;}
	public function setMagType($m){$this->noe_majale=$m;}

	/**
	 * @scField(type="string",name="MagTypeName",title="نوع مجله",DoctrineField="noe_majale.Name")
	 */
	public function getMagTypeName(){return $this->noe_majale->getName();}
	public function setMagTypeName(){}
	
	/**
	 * @scField(type="integer",name="MagTypeid",title="نوع مجله",DoctrineField="noe_majale.id")
	 */
	public function getMagTypeid(){return $this->noe_majale->getid();}
	public function setMagTypeid($nid){$magt = new MagazineType();$this->noe_majale=$magt->GetByID($nid);}
	
	
	public function getVersions(){return $this->magver;}
	public function setVersions($vers){$this->magver=$vers;}
	
}

?>
