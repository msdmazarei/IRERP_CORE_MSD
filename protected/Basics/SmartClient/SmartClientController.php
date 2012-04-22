<?php
namespace IRERP\Basics\SmartClient;

use \Yii, \IRController;

class SmartClientController extends \IRController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	
	public $baseUrl = '';
	
	protected $actionParams = array();
	
	public function getActionParam($paramName)
	{
		$req = Yii::app()->getRequest();
		if ($req->getIsPutRequest())
			return $req->getPut($paramName, NULL);
		else
		{
			if (count($this->actionParams) == 0)
				$this->actionParams = $this->getActionParams();
				
			if (isset($this->actionParams[$paramName]))
				return $this->actionParams[$paramName];
			else
				return NULL;
		}
	}
	public function getActionParams()
	{
		$req = Yii::app()->getRequest();
	
		if ($req->getIsPostRequest() || $req->getIsDeleteRequest())
		return $_REQUEST;
		if ($this->getIsGetRequest()) {
			$queryString = $req->getQueryString();
			
			// FIXME check for other possible errors
			if ($queryString !== '') {
				$reqParams = explode('&', $queryString);
	
				$actionParams = array();
				foreach($reqParams as $param)
				{
					list($paramName, $paramValue) = explode('=',$param);
					if(array_key_exists($paramName, $actionParams)) {
						$temp = $actionParams[$paramName];
						if (!is_array($temp))
						$actionParams[$paramName] = array(0 => $temp);
						$actionParams[$paramName][] = urldecode($paramValue);
					}
					else
					$actionParams[$paramName] = urldecode($paramValue);
				}
				return $actionParams;
			}
			else
				return $_GET;
		}

		return NULL;
	}
	
	protected function GetSmartClientJs()
	{
		$resources = array();
		$BasicPath = Yii::app()->baseUrl;
		$isomorphicDir=$BasicPath.'/isomorphic/';
	
		$resources[] = '<script type="text/javascript">var isomorphicDir="'.$isomorphicDir.'";</script>';
		$resources[] = '<script type="text/javascript" src='.$isomorphicDir.'system/modules/ISC_History.js?isc_version=SC_SNAPSHOT-2011-01-06.js></script>';
		$resources[] = '<script type="text/javascript" src='.$isomorphicDir.'system/development/ISC_FileLoader.js?isc_version=SC_SNAPSHOT-2011-01-06.js></script>';
		$resources[] = '<script type="text/javascript" src='.$isomorphicDir.'system/modules/ISC_Core.js?isc_version=SC_SNAPSHOT-2011-01-06.js></script>';
		$resources[] = '<script type="text/javascript" src='.$isomorphicDir.'system/modules/ISC_Foundation.js?isc_version=SC_SNAPSHOT-2011-01-06.js></script>';
		$resources[] = '<script type="text/javascript" src='.$isomorphicDir.'system/modules/ISC_Containers.js?isc_version=SC_SNAPSHOT-2011-01-06.js></script>';
		$resources[] = '<script type="text/javascript" src='.$isomorphicDir.'system/development/ISC_Grids.js?isc_version=SC_SNAPSHOT-2011-01-06.js></script>';
		$resources[] = '<script type="text/javascript" src='.$isomorphicDir.'system/modules/ISC_Forms.js?isc_version=SC_SNAPSHOT-2011-01-06.js></script>';
		$resources[] = '<script type="text/javascript" src='.$isomorphicDir.'system/modules/ISC_RichTextEditor.js?isc_version=SC_SNAPSHOT-2011-01-06.js></script>';
		$resources[] = '<script type="text/javascript" src='.$isomorphicDir.'system/modules/ISC_DataBinding.js?isc_version=SC_SNAPSHOT-2011-01-06.js></script>';
		$resources[] = '<script type="text/javascript" src='.$isomorphicDir.'skins/Graphite/load_skin.js></script>';
		$resources[] = '<script type="text/javascript" src='.$BasicPath.'/js/GeneralFuncs.js></script>';
		
		/*$resources[] ='<script>';
			$resources[] ='isc.currentSkin = isc.params.skin;';
		$resources[] ='if (isc.currentSkin == null) isc.currentSkin = "Enterprise";';
		$resources[] ='isc.FileLoader.loadSkin(isc.currentSkin, "showExplorer()");';
		$resources[] ='</script>';
		*/
	
		return $resources;
	}
	
	public function beforeRender($view)
	{
		$this->baseUrl = Yii::app()->baseUrl;
		$res = $this->GetSmartClientJs();
		$this->globalResources = array_merge($this->globalResources, $res);
		$this->direction = Yii::app()->params['direction'];
	
		return parent::beforeRender($view);
	}
	
}
?>
