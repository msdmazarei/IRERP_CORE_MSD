<?php
namespace IRERP\Basics\Descriptors;

use IRERP\Utils\ServerCacheHelper;

use IRERP\Basics\Annotations\UI\IRTitle;

use IRERP\Basics\Annotations\UI\IRDetailViewDefines;

use IRERP\Basics\ClientFrameWork;

use IRERP\Basics\Descriptors\DataSource;
use IRERP\Basics\Descriptors\DataViewSection;
use IRERP\Basics\Descriptors\DescriptorBase;
class Page extends DescriptorBase
{
	/**
	 * 
	 * Enter description here ...
	 * @var DataSource
	 */
		protected $DataSource;
	const form='FORM';
	const grid='grid';
	//section is a Grid with its form
	/**
	 * 
	 * Enter description here ...
	 * @var DataViewSection
	 */
	protected $Master=NULL;
	/**
	 * 
	 * Enter description here ...
	 * @var DataViewSection[]
	 */
	protected $Details = array();
	
	protected $DataSource_Ids = array();
	protected $Form_Ids= array();
	protected $Grid_Ids=array();
	
	/**
	 * 
	 * Get All DataSources That Need To View $DS , 
	 * All DataSources Had Direct Relation To $DS
	 * @param DataSource $DS
	 */
	protected function getAllChildDS(DataSource $DS)
	{
		$Dses=array();
		//First Details
		foreach ($DS->getDetails() as $dss) 
		{
			$Dses[]=$dss;
			foreach ($this->getAllChildDS($dss) as $_dss) $Dses[]=$_dss;
			foreach ($DS->getFields() as $f)
			{
				$__1=$f->getHelpDataSource();
				if(isset($__1))
				{
					$Dses[]=$__1;
					foreach ($__1->getDetails() as $_dss) $Dses[]=$_dss;
				}
			}
		}
		return $Dses;
	}
	
	public function __construct(DataSource $DS,DescriptorBase $Parent=NULL)
	{
		$this->DataSource = $DS;
		$this->setParentDescriptor($Parent);
		$this->MakePage();
	}
	
	protected function MakePage()
	{
		if(!isset($this->DataSource)) return;
		$this->Master=new DataViewSection($this->DataSource, $this);
		foreach ($this->DataSource->getDetails() as $dss)
			if($dss->getHasItsGRIDFORM())
			 if(!key_exists($dss->GetID(), $this->DataSource_Ids))
			 {
			 	$this->DataSource_Ids[$dss->GetID()]=$dss;
			 	$__tempvar=new DataViewSection($dss);
			 	$__tempvar->setParentDescriptor($this);
				$this->Details[]=$__tempvar;
			 }
	}
	
	public function GetID(){return 'PG'.$this->DataSource->getID();}
	public function getClientIRJSPage(){return 'Page_'.$this->GetID();}
	
	public function GetCatchID($PageID,$ClientFrameWork="SmartClient")
	{
		return 'PAGEUIGEN'.$PageID.$ClientFrameWork;
		
	}
	
	public function GenerateClientCode($ClientFrameWork)
	{
		$IRJSPage = $this->getClientIRJSPage();
		$rtn=ServerCacheHelper::GetFromCache($this->GetCatchID($IRJSPage));
		if($rtn!=NULL) return $rtn;
		
		switch ($ClientFrameWork)
		{
			case ClientFrameWork::SmartClient:
				
				
				if(count($this->Details)>0)
				{
					//Have Details
					$rtn='';
					$rtn.="var $IRJSPage = new IRERPJS_Page('".$IRJSPage."');";
					//Convert All DataSources
					//$rtn.=$this->DataSource->GenerateClientCode($ClientFrameWork);
					$this->DataSource_Ids[$this->DataSource->GetID()]=$this->DataSource;
					$__allds= $this->getAllChildDS($this->DataSource);
					
					//Gathering All DataSources That Use In This Page
					foreach ($__allds as $ds)
					if(!key_exists($ds->GetID(), $this->DataSource_Ids))
					{
						
						$this->DataSource_Ids[$ds->GetID()]=$ds;
						//Is Detail DataSource
						if($ds->GetID()==$this->DataSource->GetID()) continue; //Master DataSource is not Detail 
						if($ds->getHasItsGRIDFORM()){ // Detail That Has ItsGridFORM
							$___allds=$this->getAllChildDS($ds);
							foreach($___allds as $_ds)
								if(!key_exists($_ds->GetID(), $this->DataSource_Ids))
								{
									$this->DataSource_Ids[$_ds->GetID()]=$_ds;
								}
							$this->Details[]=new DataViewSection($ds);
						}else
						{
							// Detial Has No ItsGridFORM (EnumFillers)
							$this->DataSource_Ids[$ds->GetID()]=$ds;
						}
					}
					
					foreach ($this->DataSource_Ids as $k=>$ds)
					{
						
						$rtn.=$ds->GenerateClientCode($ClientFrameWork);
						//Save Detail DataSources To javascript DetailDss Variable
						if($ds->getParentDataSource()!=null) $rtn.='DetailDss[DetailDss.length]='.$k.';';
					}
						

					//Generate DataViewSection
					$rtn.=$this->Master->GenerateClientCode($ClientFrameWork);
					$rtn.="$IRJSPage.setMaster(".$this->Master->getClientDVS().');';
					foreach ($this->Details as $v) 
						{
							$rtn.=$v->GenerateClientCode($ClientFrameWork);
							$rtn.="$IRJSPage.addDetail(".$v->getClientDVS().');';
							//Save Detail Form And Grid To javascript DetailForms and DetailGrids Vars
							$rtn.='DetailGrids[DetailGrids.length]='.$v->getGrid()->GetID().';';
							$rtn.='DetailForms[DetailForms.length]='.$v->getForm()->GetID().';';
						}
					
					//Generate Tabs
					$tabsetid="detailstabset".$IRJSPage;
					$rtn.="jsIRERP.TabSet.create({";
					$rtn.="ID:\"$tabsetid\",";
					$rtn.="defaultLayoutAlign: \"right\",";
					$rtn.="align:\"right\",";
					$rtn.="tabBarAlign:\"right\",";
					$rtn.="tabs:[";
					$i=0;
					/**
					 * 
					 * Enumerator
					 * @var DataViewSection
					 */
					$Detail=NULL;
					foreach($this->Details as $Detail)
					{
						$DetailID=$Detail->GetID();
						/**
						 * 
						 * Defined IRDetailViewDefines upon ParnetClass.ParentProperty
						 * @var IRDetailViewDefines
						 */
						$IRDVD=new IRDetailViewDefines(array());
						/**
						 * Algorithem To Set Tab Title
						 * 1. Check ParentClassProperty To Find IRDetailViewDefiens Annots
						 * 2. if cannot find Annot Use ParentClass.ParentProperty Title
						 * 3. if cannot find Annot Use IRMClass Name (That Define In id prop as title) 
						 * 4. if cannot find Annot and IRMClass Title Use "UNKNOWN"
						 */
						
						// TRY To Catch Tab Title
						// Algorithem No. 1						
						/**
						 * 
						 * Parent Property Name
						 * @var string
						 */
						$PPN=$Detail->getDataSource()->getParentClassProperty();
						/**
						 * 
						 * Parent Class Name
						 * @var string
						 */
						$PCN=$Detail->getDataSource()->getParentDataSource()->getIRMClass();
						/**
						 * 
						 * Parent Class Profile
						 * @var string
						 */
						$PCP=$Detail->getDataSource()->getProfile();
						//Get All Class Annots For Profile 
						$clsdesc=\ApplicationHelpers::GetClassAnnots($PCN, $PCP);
						if(isset($clsdesc[$PPN][get_class($IRDVD)])) 
							$IRDVD=$clsdesc[$PPN][get_class($IRDVD)];
						else 
							$IRDVD=NULL;
						if(isset($IRDVD)) 

							$tit=$IRDVD->DetailTitle->GetTitle();
						else 
						{
							// Algorithem No. 2
							$IRTit = new IRTitle(array());
							if(isset($clsdesc[$PPN][get_class($IRTit)]))
								$IRTit=$clsdesc[$PPN][get_class($IRTit)];
							else
								$IRTit=NULL;

							if(isset($IRTit)) 
								$tit=$IRTit->GetTitle();
							else 
							{
								// Algorithem No. 3
								$IRTit=new IRTitle(array());
								if(isset($clsdesc['id'][get_class($IRTit)])) 
									$IRTit=$clsdesc['id'][get_class($IRTit)];
								else 
									$IRTit=NULL;
								if(isset($IRTit)) 
									$tit=$IRTit->GetTitle();
								else 
								{
									// Algorithem No. 4
									$tit='UNKNOWN'.$i;
								}
							}
							
							
							
						}
						
						$rtn.="{title:\"$tit\",pane:".$DetailID.",ID:\"Tab".$DetailID."\" },";
						$i++;
					}
					$rtn.="]});";
					
					//Generate Section
					$sectionID="section".$IRJSPage;
					$MasterTitle="MasterTitle";
					$DetailsTitle="DetailsTitle";
					$rtn.="jsIRERP.SectionStack.create({";
					$rtn.="ID:\"$sectionID\",";
					$rtn.="width:\"100%\",height:\"100%\",";
					$rtn.="visibilityMode:\"multiple\",";
					$rtn.="animateSections:false,";
					$rtn.="  sections:[";
					$rtn.="{title:\"$MasterTitle\", autoShow:true, items:[".$this->Master->GetID()."]},";
					$rtn.="{title:\"$DetailsTitle\",autoShow:true,items:[$tabsetid]}";	
					$rtn.="]});";
					$rtn.="/**{SYS_COMMENT}**";
					$rtn.="{ContainerID: \"$sectionID\"}";
					$rtn.="**{/SYS_COMMENT}*/";
					ServerCacheHelper::Cache(
						$this->GetCatchID($IRJSPage),
						$rtn);
						
					return $rtn;
								
				}
				else
				{
					//Have No Details
					$rtn='';
					$rtn.="var $IRJSPage = new IRERPJS_Page('".$IRJSPage."');";
					//Convert All DataSources
					$rtn.=$this->DataSource->GenerateClientCode($ClientFrameWork);
					$this->DataSource_Ids[$this->DataSource->GetID()]=$this->DataSource->GetID();
					$__allds= $this->getAllChildDS($this->DataSource);
					foreach ($__allds as $d)
						if(!key_exists($d->GetID(), $this->DataSource_Ids))
						{
							$rtn.=$d->GenerateClientCode($ClientFrameWork);
							$this->DataSource_Ids[$d->GetID()]=$d;
						}
						
					$rtn.=$this->Master->GenerateClientCode($ClientFrameWork);
					$rtn.="$IRJSPage.setMaster(".$this->Master->getClientDVS().");";
					$sectionID=$this->Master->getID();
					$rtn.="/**{SYS_COMMENT}**";
					$rtn.="{ContainerID: \"$sectionID\"}";
					$rtn.="**{/SYS_COMMENT}*/";
					ServerCacheHelper::Cache(
						$this->GetCatchID($IRJSPage),
						 $rtn);
					return $rtn;
				}
				break;
		}
	}
}
?>