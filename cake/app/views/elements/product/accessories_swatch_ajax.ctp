<?php 
/**
 * $name
 * $image
 * $price
 * $DOMbtnId
 * $btnText
 * $productClass
 * $productId
 * $colorId
 * $sex
 * $schoolId
 * $colors
 */

//abs url
$img = WWW_ROOT . str_replace('\\','/',$image);

//resize the image
$height = 126;

$sizes = $this->Sizer->resizeConstrainY($img, 126, 100);
?>

<div class="imgwrapper" ><!-- Begin Fixed Width Wrapper for Images -->
 	
 	<div class="pname" class="nine"><?php echo $name; ?></div>
    <img id="product-<?php echo $productId; ?>_color-<?php echo $colorId; ?>_sex-<?php echo $sex; ?>" class="two <?php echo $productClass; ?>" src="<?php echo $image ?>" width="<?php echo $sizes[0]; ?>" height="<?php echo $sizes[1]; ?>" />
	
	<div class="pdetails"><!-- Begin wrapper to center product details -->
		
		<select name="swatch_color" id="swatch_color">
		<?php 
		foreach($swatches as $s){
			$selected = ($s['Color']['id'] == $colorId) ? 'selected' : '';
			echo "\t\t\t<option value='{$s['Color']['id']}' $selected>{$s['Color']['name']}</option>\n";	
		}
		?>
		</select>
		<br/>
		<input type="button" value="Select Color" class="btn three pbutton" />
		
	</div>
</div><!-- End pdetails -->