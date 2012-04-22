<?php
namespace IRERP\modules\jahad\models;

use IRERP\Basics\Models\BasicNamedClass;


use Doctrine\ORM\Mapping\Column;
use IRERP\Basics\Models\IRDataModel,
    IRERP\Basics\Annotations\scField;
use IRERP\modules\jahad\models\FilmEducationalGoal;
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
class FilmContentlist extends IRDataModel
{
	// <==================== Properties
	/**
	 * @ManyToOne(targetEntity="Film",inversedBy="FilmContentlists")
	 */
	protected $Film;
	/**
	 * @Column(type="string",length=50)
	 */
	protected $ContentTitle;
	/**
	 * @Column(type="string",length=500)
	 */
	protected $Description;
	
	
	//                       Properties ====================>
	public function getFilmName()
	{
	try {return $this->Film->getFilmName();}catch(\Exception $ex){return '';}
	}
   public function setFilmName($v){}
public function getFilmID(){
	try {return $this->Film->getid();}catch(\Exception $ex){return NULL;}
	}
	public function setFilmID($v){
	try {
		$this->Film=new Film();
		$this->Film= $this->Film->GetByID($v);
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