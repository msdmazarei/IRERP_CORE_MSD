<?php
namespace IRERP\Basics\Descriptors;
use IRERP\Basics\Descriptors\DataSource;
use Doctrine\DBAL\Types\BooleanType;
use IRERP\Basics\ClientFrameWork;


class DataSourceField extends DescriptorBase
{
	
	protected $title='';
	/**
	 * Indicates to FieldName
	 * @var string
	 */
	protected $FieldName='';
	/**
	 * 
	 * Indicates to field type that can be string or integer or double
	 * @var string (string or integer or double)
	 */
	protected $FieldType='string';
	/**
	 * 
	 * Inicates that this Field is Hidden
	 * @var Boolean
	 */
	protected $Hidden=false;
	/**
	 * 
	 * Indicates that this field is Primary Key
	 * @var Boolean
	 */
	protected $PrimaryKey=false;
	
	protected $ReflectionProperty=NULL;
	protected $IRMClass;
	
	public function getIRMClass(){return $this->Cls;}
	public function setIRMClass($v){$this->Cls=$v;}
	
	/**
	 * 
	 * Indicates DataSource That This Field Must Set From It, This Use in PickList Fields or like that 
	 * @var DataSource
	 */
	protected $HelpDataSource;
	
	/**
	 * Indicates That This Field Must Be Hide in Form View Of DataSource
	 * @var Boolean
	 */
	protected $HideInForm;
	
	public function getHideInForm(){return $this->HideInForm;}
	public function setHideInForm($v){$this->HideInForm=$v;}
	
	public function getHelpDataSource(){return $this->HelpDataSource;}
	public function setHelpDataSource($v){$this->HelpDataSource=$v;}
	
	public function setFieldName($v){$this->FieldName=$v;}
	public function getFieldName(){return $this->FieldName;}
	
	public function setFieldType($v){$this->FieldType=$v;}
	public function getFieldType(){return $this->FieldType;}

	public function setHidden($v){$this->Hidden=$v;}
	public function getHidden(){return $this->Hidden;}

	public function setPrimaryKey($v){$this->PrimaryKey=$v;}
	public function getPrimaryKey(){return $this->PrimaryKey;}
	
	public function getTitle(){return $this->title;}
	public function setTitle($d){$this->title=$d;}
	
	public function getReflectionProperty(){return $this->ReflectionProperty;}
	public function setReflectionProperty($v){$this->ReflectionProperty=$v;}
	
	
	public function GenerateClientCode($ClientFrameWork)
	{
		$fname =$this->getFieldName();
		$type=$this->getFieldType();
		if($this->getHidden()) $hidden='true'; else $hidden='false';
		if($this->getPrimaryKey()) $pk='true'; else $pk='false';
		$tit = $this->getTitle();
		$str='';
		switch($ClientFrameWork){
			case ClientFrameWork::SmartClient:
				$str="{hidden:$hidden,name:\"$fname\",primaryKey:\"$pk\",type:\"$type\",title:\"$tit\"}";
			break;
		}
		return $str;	
	}

	public function ToString()
	{
		$rtn='<tr>';
		$rtn='<td> FieldName:'.$this->FieldName.' </td>';
		$rtn.='<td> title:'.$this->title.' </td>';
		$rtn.='<td> Type:'.$this->FieldType.' </td>';
		$rtn.='<td> Hidden:'.$this->Hidden.' </td>';
		$rtn.='<td> Primary:'.$this->PrimaryKey.'</td>';
		$rtn.='<td> HideInForm:'.$this->HideInForm.'</td>';
		$rtn.='<td> cls:'.str_replace('IRERP\\modules\\jahad\\models\\', '', get_class($this->Cls)) .'</td>';
		$rtn.='<td> prp:'.$this->ReflectionProperty->getName().'</td>';
		$rtn.='</tr>';
		return $rtn;
		
	}
}
	
	
	
	
	
	
	
	

?>