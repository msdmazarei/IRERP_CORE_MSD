<?php
require 'protected/modules/reporting/components/database_mysql.php';
require 'protected/modules/reporting/components/Getters_Parsers.php';
class ReportController extends IRController
{
	
	public $layout='//layouts/empty';
	public function actionIndex()
	{
		
	$report_key = sti_get_parameter_value("stimulsoft_report_key");
	$client_key = sti_get_parameter_value("stimulsoft_client_key");
		
	$client_data = null;
	if (isset($HTTP_RAW_POST_DATA)) $client_data = $HTTP_RAW_POST_DATA;
	if ($client_data == null) $client_data = file_get_contents("php://input");
	
	switch ($client_key)
		{
			// Loading DesignerFx
			case "DesignerFx":
				if (!isset($report_key)) $report_key = "null";
				$this->render('index');
//				return str_replace("#MARKER_REPORT_PARAMS#", sti_get_parameters(), file_get_contents("designer.html"));
				break;
			// Loading configuration
			case "LoadConfiguration":
				$this->render('SendDirectToClient',array(
				'SendDirectToClient'
				=>
				 sti_load_config(\Yii::app()->basePath . "/modules/reporting/Config/" . "config.xml")
				 ));
				 
				break;
							// Loading the requested localization file
			case "LoadLanguage":
				$localization_directory =sti_get_localization_directory();
				$this->render('SendDirectToClient',array(
				'SendDirectToClient'
				=>
				 file_get_contents($localization_directory."/".$client_data)
				 ));
				break;
			
				// Test database connection
			case "TestConnection":
				$connection_type =sti_get_xml_value($client_data, "ConnectionType");
				$connection_string =sti_create_connection_string($client_data);

				switch ($connection_type)
				{
					case "StiSqlDatabase": 
						echo sti_mssql_test_connection($connection_string);
						break;
					case "StiMySqlDatabase":
						echo sti_mysql_test_connection($connection_string);
						break;
					case "StiOdbcDatabase": echo sti_odbc_test_connection($connection_string);break;
					case "StiPostgreSQLDatabase": echo sti_pg_test_connection($connection_string);break;
					case "StiOracleDatabase": echo sti_oracle_test_connection($connection_string);break;
					default: return "";
				}
				break;
				
			// Retrieve table columns query
			case "RetrieveColumns":
				$connection_type =sti_get_xml_value($client_data, "ConnectionType");
				$connection_string = sti_create_connection_string($client_data);
				$query = sti_get_xml_value($client_data, "Query");

				switch ($connection_type)
				{
					case "StiXmlDatabase":
						$data_path = sti_get_xml_value($client_data, "DataPath");
						$schema_path = sti_get_xml_value($client_data, "SchemaPath");
						return sti_xml_get_columns($data_path, $schema_path);
					
					case "StiSqlDatabase": return sti_mssql_get_columns($connection_string, $query);
					case "StiMySqlDatabase": echo sti_mysql_get_columns($connection_string, $query);break;
					case "StiOdbcDatabase": return sti_odbc_get_columns($connection_string, $query);
					case "StiPostgreSQLDatabase": return sti_pg_get_columns($connection_string, $query);
					case "StiOracleDatabase": return sti_oracle_get_columns($connection_string, $query);
					
					default: return "";
				}
				break;

			// Data query. Response to the client - data in the xml format
			case "LoadData":
				$connection_type = sti_get_xml_value($client_data, "ConnectionType");
				$connection_string = sti_create_connection_string($client_data);
				$data_source_name = sti_get_xml_value($client_data, "DataSourceName");
				$query =sti_get_xml_value($client_data, "Query");
				
				switch ($connection_type)
				{
					case "StiXmlDatabase":
						$data_path = sti_get_xml_value($client_data, "DataPath");
						$schema_path = sti_get_xml_value($client_data, "SchemaPath");
						return sti_xml_get_data($data_path, $schema_path);
					
					case "StiSqlDatabase": return sti_mssql_get_data($connection_string, $data_source_name, $query);
					case "StiMySqlDatabase": echo sti_mysql_get_data($connection_string, $data_source_name, $query);break;
					case "StiOdbcDatabase": return sti_odbc_get_data($connection_string, $data_source_name, $query);
					case "StiPostgreSQLDatabase": return sti_pg_get_data($connection_string, $data_source_name, $query);
					case "StiOracleDatabase": return sti_oracle_get_data($connection_string, $data_source_name, $query);
					
					default: return "";
				}
				break;
			// Saving a report
			case "SaveReport":
				$report = base64_decode(sti_get_xml_value($client_data, "Report"));
				$report_key = sti_get_xml_value($client_data, "ReportKey");
				$new_report_flag = sti_get_xml_value($client_data, "NewReportFlag");
				echo  sti_save_report($report, $report_key, $new_report_flag);
				break;
			// Loading a report when running the viewer or designer
 			case "LoadReport":
				echo sti_get_report($client_data);
				break;
				
			case "ViewerFx":
				if (!isset($report_key)) $report_key = "null";
				$this->render('viewer');
				//return str_replace("#MARKER_REPORT_PARAMS#", sti_get_parameters(), file_get_contents("viewer.html"));
				break;
				
				
				
			
				
			
			/*
			// Loading ViewerFx
			
			
			
			// Loading a report by the specified URL
			// Used for debug. Does not work in the released version
			case "LoadReportFile":
				return file_get_contents($client_data);
				break;
			
			
			
			
			
*/
		}
		
	}
	
	
	
	public 		function sti_get_parameters()
	{
		$result = "";
		foreach (array_keys($_GET) as $key) $result .= "&$key=".rawurlencode(sti_strip($_GET[$key]));
		foreach (array_keys($_POST) as $key) $result .= "&$key=".rawurlencode(sti_strip($_POST[$key]));
		
		return "?".substr($result, 1);
	}
	

	

	
}
?>