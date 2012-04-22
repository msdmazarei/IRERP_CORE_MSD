<?php
namespace IRERP\modules\jahad\models;
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
 * @Entity
 * @author masoud
 *
 */
class Media extends IRDataModel{

	//<===================== Properties
	
	/**
	 * @Column(type="integer")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="تعداد برنامه")
	 * @IRPropertyType(Type="integet")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @var integer
	 */
	protected $tedad_barnameh;
	/**
	 * @Column(type="string")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRRequire
	 * @IRTitle(TitleType="STRING",Value="شماره")
	 * @IRPropertyType(Type="string")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRParentGridMember
	 * @var string
	 */
	protected $shomareh;
	
	/**
	 * @ManyToOne(targetEntity="Title")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRRequire
	 * @IRTitle(TitleType="STRING",Value="عنوان")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRPickListMember
	 * @IRParentGridMember
	 * @IRUseAsProfile(TargetProfile="ABSTRACT")
	 * @var Title
	 */
	protected $onvan;
	/**
	 * @ManyToOne(targetEntity="TVRD")
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
	 * @IRUseAsProfile(TargetProfile="ABSTRACT",PostfixTitle=" نوع برنامه ")
	 * @var TVRD
	 */
	protected $tv_rd;
	
	/**
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
	 * ManyToMany(targetEntity="Auidunce")
	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="مخاطبین")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL") 

	 * @var Auidunce[]
	 */
	protected $sathe_mokhatab;
	/**
	 * @ManyToMany(targetEntity="State")
 	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="استانها")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL") 

	 * @var state[]
	 */
	protected $ostan;
	/**
	 * @ManyToMany(targetEntity="Section",mappedBy="Media")
 	 * -----------
	 * Client Side Definations
	 * -----------
	 * @IRUseInClientDS
	 * @IRTitle(TitleType="STRING",Value="بخش ها")
	 * -----------
	 * Internal Relation Definations
	 * -----------
	 * @IRUseAsProfile(TargetProfile="DETAIL") 

	 * @var Section[]
	 */
	protected $bakhshha;
	
	//						 Properties ======================>
	public function getTitle(){return $this->onvan;}
	public function setTitle($ti){$this->onvan=$ti;}
	
	public function getMozu(){return $this->mozu;}
	public function setMozu($ti){$this->mozu=$ti;}
	
	public function getTV_RD(){return $this->tv_rd;}
	public function setTV_RD($ti){$this->tv_rd=$ti;}
	
	public function getSathe_Mokhatab(){return $this->sathe_mokhatab;}
	public function setSathe_Mokhatab($ti){$this->sathe_mokhatab=$ti;}
	
	public function getOstan(){return $this->ostan;}
	public function setOstan($ti){$this->ostan=$ti;}
		
	public function getTedad_Barnameh(){return $this->tedad_barnameh;}
	public function setTedad_Barnameh($ti){$this->tedad_barnameh=$ti;}
		
	public function getShomareh(){return $this->shomareh;}
	public function setShomareh($ti){$this->shomareh=$ti;}
	
	public function getBakhshha(){return $this->bakhshha;}
	public function setBakhshha($ti){$this->bakhshha=$ti;}
}
?>
