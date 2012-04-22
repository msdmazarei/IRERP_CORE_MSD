<?php
namespace IRERP\Basics\Annotations;

/** @Annotation */
final class scField extends \IRAnnotation
{
/**
 * @var Boolean
 */
	public $canEdit=null;
	public $canExport;
	public $canFilter;
	public $canSave;
	public $canSortClientOnly;
	public $childrenProperty;
	public $childTagName;
	public $detail;
	public $editorType;
	public $foreignKey;
	public $hidden;
	public $name;
	public $primaryKey;
	public $type;
	public $title;
	public $DoctrineField;
	public $length;
}
?>