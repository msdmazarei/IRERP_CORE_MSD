<?php
namespace IRERP\modules\jahad\models;
use IRERP\Basics\Models\IRDataModel;

/**
 * @Entity
 * @author masoud
 *
 */
class Section extends IRDataModel
{
	/**
 	 * @ManyToOne(targetEntity="Media",inversedBy="bakhshha")
	 * @var integer
	 */
	protected $Media;
	
	/**
	 * @Id @generatedValue(strategy="AUTO") @Column(type="integer")
	 * @var integer
	 */
	protected $id;
		/**
		 * @Column(type="string")
		 * @var string
		 */
	protected $nobat;
	public function getNobat(){return $this->nobat;}
	public function setNobat($ti){$this->nobat=$ti;}
	/**
	 * @Column(type="string")
	 * @var Persian Date string
	 */
	
	protected $Pakhsh;
	public function getPakhsh(){return $this->Pakhsh;}
	public function setPakhsh($ti){$this->Pakhsh=$ti;}
/**
 * @Column(type="string")
 * @var Persian Date String
 */
	protected $enteshar;
	public function getEnteshar(){return $this->enteshar;}
	public function setEnteshar($ti){$this->enteshar=$ti;}
	/**
	 * @ManyToMany(targetEntity="Human")
	 * @JoinTable(name="section_Human_karshenas",
	 *     		 joinColumns={
	 *     					@JoinColumn
	 *     								(
	 *     									name="section_id", 
	 *     									referencedColumnName="id"
	 *     								)
	 *     						},
	 *      inverseJoinColumns={
	 *      				@JoinColumn
	 *      							(
	 *      							name="human_id",
	 *      							referencedColumnName="id"
	 *      							)
	 *      					}
	 *      )
	 * 
	 * @var Human[]
	 */
	protected $karshenas;
	public function getKarshenas(){return $this->karshenas;}
	public function setKarshenas($ti){$this->karshenas=$ti;}
	/**
	 * @Column(type="integer")
	 * @var integer
	 */
	protected $tirajh;
	public function getTirajh(){return $this->tirajh;}
	public function setTirajh($ti){$this->tirajh=$ti;}
	/**
	 * @ManyToMany(targetEntity="Human")
	 * @JoinTable(name="section_Human_sardabir",
	 *     		 joinColumns={
	 *     					@JoinColumn
	 *     								(
	 *     									name="section_id", 
	 *     									referencedColumnName="id"
	 *     								)
	 *     						},
	 *      inverseJoinColumns={
	 *      				@JoinColumn
	 *      							(
	 *      							name="human_id",
	 *      							referencedColumnName="id"
	 *      							)
	 *      					}
	 *      )
	 * 
	 * @var Human[]
	 */
	protected $sardabir;
	public function getSardabir(){return $this->sardabir;}
	public function setSardabir($ti){$this->sardabir=$ti;}
	
}
?>