	<img id="canwe" src="/img/noschool/flyfoenix_noschool_canwe.png" width="380" height="55" alt="canwe" />
  
	<div id="content" style="padding-bottom:10px">
		<span class="eight">Sorry, the requested school is not available yet!  
		We will let you know when a sales starts.  Until then are you interested in another school?
		</span>
	</div><!-- End content -->
  
	
		<div id="school">
        <select id="school-list" class="fieldwidth" name="data[school][id]" size="1">
        <?php 
        	foreach($schools as $entry) {
        		if(!preg_match('/swatch/i',$entry['School']['long'])){
        			echo "\t\t\t<option value='{$entry['School']['id']}' >{$entry['School']['long']}</option>\n";
        		}
        	}
		 ?>
        </select>
        <input id="btnselect" class="btn space-left" name="select" type="submit" value="&nbsp;Select&nbsp;" />
        </div>
		
        
      
    	 <!-- End Register --> 
  