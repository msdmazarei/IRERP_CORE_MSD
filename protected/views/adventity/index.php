<?php
use IRERP\Utils\GenerationHelper;
use IRERP\Basics\ClientFrameWork;
use IRERP\Basics\Descriptors\Page;
try {
$clsname=$this->getEntityClassname();
$DS=GenerationHelper::GetDataSource($clsname, 'GENERAL');
$Page= new Page($DS);
} catch (\Exception $e) {
	print_r($e->getMessage());
	return;
}

?>

<script type="text/javascript">
<?php echo $Page->GenerateClientCode(ClientFrameWork::SmartClient);?>
</script>