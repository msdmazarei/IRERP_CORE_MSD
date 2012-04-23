<?php
namespace IRERP\Utils;

use IRERP\Basics\Descriptors\DataSource;


class ServerCacheHelper extends HelperBaseClass
{
	/**
	 * 
	 * Cache a Serializable Variable
	 * @param string $CacheId
	 * @param object $Variable
	 * @param Boolean $OverWrite -- OverWrite Cache if Var Exists in Cache
	 * @return Boolean - true if can cache, false is can not cache
	 */
	public static function Cache($CacheId,$Variable,$OverWrite=FALSE)
	{
		if(\Yii::app()->params['ApplicationMode']=='Development') return true;
		$CacheFolderPath = \Yii::app()->params['CacheFolder'];
		$cachefilepath = $CacheFolderPath.$CacheId;
		
		if(!$OverWrite)
			if(file_exists($cachefilepath)) return true;
			

			//Overwrite true
		try{
			
			$sertext = serialize($Variable);
			file_put_contents($cachefilepath, $sertext);
			
		
			return true;
		}catch (\Exception $e)
		{
			\Yii::log($e->getMessage());
			return false;
		}
	}
	/**
	 * 
	 * return an object from cached 
	 * @param string $CacheId
	 * @return object
	 */
	public static  function GetFromCache($CacheId)
	{
		if(\Yii::app()->params['ApplicationMode']=='Development') return NULL;
		$CacheFolderPath = \Yii::app()->params['CacheFolder'];
		$cachefilepath = $CacheFolderPath.$CacheId;
		if (ServerCacheHelper::VarExistInCache($CacheId))
		{
			try{
				//$sertext=;
			$rtn=unserialize(file_get_contents($cachefilepath));
			return $rtn;
			}catch (\Exception $e)
			{
				\Yii::log($e->getMessage());
			}
		}
		return NULL;
	}
	public static function VarExistInCache($CacheId)
	{
		if(\Yii::app()->params['ApplicationMode']=='Development') return FALSE;
		$CacheFolderPath = \Yii::app()->params['CacheFolder'];
		$cachefilepath = $CacheFolderPath.$CacheId;
		if(file_exists($cachefilepath)) return true; else return FALSE;
		
	}
	
	
}
?>