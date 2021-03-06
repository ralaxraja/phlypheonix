
<?php
/**
 * $title The tile
 * $dir The absolute path to directory with images
 * $model The model name
 * $field The model field name
 * $columns The number of columns
 */

if(!isset($columns)){
	$columns = 3;	
}

echo "<div class='input text'><label for'Image'>$title</label>";

echo "<table cellpadding='0' cellspacing='0'>";
$img = 0;
$dir = rtrim($dir,'\\\/');
foreach(scandir($dir) as $file){
	if($file[0] != '.' && !is_dir($dir . DS . $file)) {
		
		$rel = str_replace(WWW_ROOT,'',$dir . DS  . $file);
		$rel = '/' . str_replace(DS, '/', $rel);
		
		$info = getimagesize($dir . DS . $file);
	
		//set the sizes to fit to a max dimension
		$max = max($info[0],$info[1]); //max of height, width
		$max = ($max) ? $max : 1;
		$factor = 100 / $max;
		$width = $factor * $info[0];
		$height = $factor * $info[1];
	
		if( ($img % $columns) == 0){ echo '<tr>';}
	
		if( preg_match('/((jpe?g)|(gif)|(png))$/i',$rel) ) 
		{
			
			echo "<td valign='middle'><input type='radio' name='data[$model][$field]' value='$rel' id='image-$img'";
			if($rel == $this->data[$model][$field]) { echo ' CHECKED '; }
			echo " >";
			echo "<td style='border-right:solid #FFF 2px;'><label for='image-$img'><img width='$width' height='$height' src='$rel' title='$rel' /></label><br/>\n";
			$img++;
		}
	}
}
if( !( $img%$columns == 0) ){
	for($i=0;$i<($columns-$img%$columns);$i++){
		echo "<td colspan=\"2\">&nbsp;</td>";
	} 
}
echo "</table></div>";
?>