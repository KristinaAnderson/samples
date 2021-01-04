<?php
/**
 * Plugin Name: Grid View and Detail Form Custom Plugin
 * Plugin URI: https://no-uri.com
 * Description: Display form and grid in portal using shortcodes
 * Version: 0.1
 * Text Domain: formandgrid_ka_wordpress_plugin_ka
 * Author: Kristina D. Anderson
 * Author URI: https://www.no-uri.com
 */
 
 function aaapp_mwgrid_wordpress_plugin_ka($atts) {
	 
	$servername = "localhost";
	$username = "****************";
	$password = "*************";

	try {
		$pdo = new PDO("mysql:host=$servername;dbname=**************", $username, $password);
		// set the PDO error mode to exception
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
		die;
	}

	$stmt = $pdo->query("SELECT * FROM Client ORDER BY id DESC LIMIT 15");
	$stuff = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt2 = $pdo->query("SELECT * FROM MW_Eligibility_Workers");
	$stuff2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
	$pageno = 1;
	$offset = 15;
	
	
$Content = '<script>jQuery(document).ready(function() { jQuery.post("/wp-content/plugins/aaapp_medwaiver_wordpress_plugin_ka/formdata.php", { pageno: '.$pageno.', offset: '.$offset.' });  jQuery("#searchbox").unbind().keyup(function(e){ var value = jQuery(this).val(); if (value.length>3) {  
jQuery.post("/wp-content/plugins/aaapp_medwaiver_wordpress_plugin_ka/searchdata.php", { value: value } , function(data){
          if(data != "")
            jQuery("#searchresult").html(data);
          else    
            jQuery("#searchresult").html("No Result Found...");
        }
              ).fail(function(xhr, ajaxOptions, thrownError) {
          //any errors?
          alert(thrownError);
          //alert with HTTP error
        }); 
}  }); jQuery("#filter1").on("change",function() {
		jQuery.post("/wp-content/plugins/aaapp_medwaiver_wordpress_plugin_ka/searchdata.php", { filter1: jQuery("select[name=filter1] option").filter(":selected").val() } , function(data){
          if(data != "")
            jQuery("#searchresult").html(data);
          else    
            jQuery("#searchresult").html("No Result Found...");
        }
              ).fail(function(xhr, ajaxOptions, thrownError) {
          //any errors?
          alert(thrownError);
          //alert with HTTP error
        });
		alert(jQuery("select[name=filter1] option").filter(":selected").val());
});
jQuery("#filter2").on("change",function() {
		jQuery.post("/wp-content/plugins/aaapp_medwaiver_wordpress_plugin_ka/searchdata.php", { filter2: jQuery("select[name=filter2] option").filter(":selected").val() } , function(data){
          if(data != "")
            jQuery("#searchresult").html(data);
          else    
            jQuery("#searchresult").html("No Result Found...");
        }
              ).fail(function(xhr, ajaxOptions, thrownError) {
          //any errors?
          alert(thrownError);
          //alert with HTTP error
        });
		alert(jQuery("select[name=filter2+
		] option").filter(":selected").val());
});
});</script><style type="text/css" id="custom-ka-css"> .kabutton { background-color: #4CAF50; border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;}</style><div style="align-items: center;"><a href="http://*****.******.org/*****-form/"><button class="kabutton" id="add_new" name="add_new">+ Add New Client</button></a><br/><label for="filter1">Filter by Worker Name:</label><select name="filter1" id="filter1">';

foreach($stuff2 as $sf) {
	$Content .= '<option value="'.$sf["ID"].'">'.$sf["Eligibility_Worker_Name"].'</option>';
}

$Content .= '</select><label for="filter2">Include Closed Cases:</label><select name="filter2" id="filter2"><option>View All Including Closed</option><option selected="selected">View Only Open Cases (default)</option></select><label for="searchbox">Search by Name, SSN, or CIRTS ID</label><input type="text" name="searchbox" id="searchbox" /></div><div id="searchresult" name="searchresult"></div><div style="overflow: auto;"><br/><table><tr><th>FIELD 1</th><th>FIELD 2</th><th>FIELD 3</th><th>FIELD 4</th><th>FIELD 5</th><th>FIELD 6</th><th>FIELD 7</th><th>FIELD 8</th><th>FIELD 9</th><th>FIELD 10</th><th>FIELD 11</th><th>FIELD 12</th><th>FIELD 13</th><th>FIELD 14</th><th>FIELD 15</th><th>FIELD 16</th><th>FIELD 17</th><th>FIELD 18</th><th>FIELD 19</th><th>FIELD 20</th><th>FIELD 21</th><th>FIELD 22</th><th>FIELD 23</th><th>FIELD 24</th><th>FIELD 25</th><th>FIELD 26</th><th>FIELD 27</th><th>FIELD 28</th><th>FIELD 29</th><th>FIELD 30</th><th><th>FIELD 30</th><th>FIELD 31</th></tr>';
	
	foreach($stuff as $s) {
		$Content .= "<tr><td><a href='http://*****.******.org/*****-form/?id=".$s["ID"]."'>".$s["FIELD1"]."</a></td><td>".$s["FIELD2"]."</td><td>".$s["FIELD3"]."</td><td>".$s["FIELD4"]."</td><td>".$s["FIELD4"]."</td><td>".$s["FIELD5"]."</td><td>".$s["FIELD6"]."</td><td>".$s["FIELD7"]."</td><td>".$s["FIELD8"]."</td><td>".$s["FIELD9"]."</td><td>".$s["FIELD10"]."</td><td>$s["FIELD11"]</td><td>".$s["FIELD12"]."</td><td>".$s["FIELD13"]."</td><td>".$s["FIELD14"]."</td><td>".$s["FIELD15"]."</td><td>".$s["FIELD16"]."</td><td>".$s["FIELD17"]."</td><td>".$s["FIELD18"]."</td><td>".$s["FIELD19"]."</td><td>".$s["FIELD20"]."</td><td>".$s["FIELD21"]."</td><td>$s["FIELD22"]</td><td>".$s["FIELD23"]."</td><td>".$s["FIELD24"]."</td><td>".$s["FIELD25"]."</td><td>".$s["FIELD26"]."</td><td>".$s["FIELD27"]."</td><td>".$s["FIELD28"]."</td><td>".$s["FIELD29"]."</td><td>".$s["FIELD30"]."</td><td>".$s["FIELD31"]."</td></tr>";
	}
	
	$Content .= "</table></div><div><h3>  <<  <  >  >>  </h3></div>";
	
	return $Content;
	 
 }
 
 function aaapp_medwaiver_wordpress_plugin_ka($atts) {
	 
$servername = "localhost";
	$username = "***********";
	$password = "************";

	try {
		$pdo = new PDO("mysql:host=$servername;dbname=*************", $username, $password);
		// set the PDO error mode to exception
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
		die;
	}
	
	//populate form select boxes from DB
	$stmt1 = $pdo->query("SELECT * FROM **** ORDER BY id DESC");
	$stuff1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

	$stmt2 = $pdo->query("SELECT * FROM ****");
	$stuff2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

	$stmt4 = $pdo->query("SELECT * FROM ****");
	$stuff4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);

	$stmt3 = $pdo->query("SELECT * FROM ****");
	$stuff3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

	$stmt5 = $pdo->query("SELECT * FROM ****");
	$stuff5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
	
$currid = $_GET["id"];
$Content = "<script>jQuery(document).ready(function() {
		jQuery.post('/wp-content/plugins/aaapp_medwaiver_wordpress_plugin_ka/formdata.php', { id: $currid })
		.done(function( data ) {
	//var div = document.getElementById('datadiv');
	//div.innerHTML += data;
	var stufff = JSON.parse(data);
	//jQuery('#hidden_id').val(stufff.ID);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	jQuery('#****').val(stufff.****);
	
  });
});</script>";
$Content .= '<div id="datadiv" name="datadiv"></div><style type="text/css" id="wp-kristina-css">.kristina { border: 1px solid black; border-radius: 15px; padding-top: 30px; padding-right: 30px; padding-bottom: 30px; padding-left: 30px;} </style><form method="post" action="/connect_new.php" id="form1" ><input type="hidden" name="hidden_id" id="hidden_id" value="'.$currid.'"><div class="kristina"> <table><tr><td><label for="****">****: </label><input type="date" name="****" id="****" data-format="YYYY-MM-DD"/></td> <td><label for="****">****: </label><input type="date" name="****" id="****" data-format="YYYY-MM-DD"/> </td><td><label for="****">****: </label><input type="number" id="****" name="****" /></td></tr>
<tr> <td><label for="****">****: </label><input type="number" name="****" id="****"  required/></td><td><label for="****">****: </label><input type="text" name="****" id="****" required /></td><td><label for="****">****: </label><input type="text" name="****" id="****" required /></td></tr>
<tr><td><label for="****">****: </label><input type="number" name="****" id="****" /></td><td><label for="****">****: </label><select name="****" id="****"><option value="" disabled selected hidden>-</option><option value="pasco">Pasco</option><option value="Pinellas">Pinellas</option></select></td><td><label for="****">****: </label><select name="****" id="****"><option value="" disabled selected hidden>-</option>';
foreach($stuff2 as $st) { $Content .= '<option value="'.$st["ID"].'">'.$st["****"].'</option>'; }
$Content .= '</select></td></tr>
<tr><td><label for="****">****: </label><select name="****" id="****"><option value="" disabled selected> </option>'; 
foreach($stuff3 as $se) { $Content .= '<option value="'.$se["id"].'">'.$se["****"].'</option>'; } 
$Content .= '</select></td><td><label for="****">****:</label><textarea name="****" id="****" rows="1" cols="50"></textarea></td></tr><tr><td><label for="****">****: </label><input type="text" name="****" id="****"/></td><td><label for="****">****: </label><input type="text" name="****" id="****"/></td><td><label for="****">****: </label><input type="text" name="****" id="****"/></td></tr><tr><td><label for="****">****: </label><input type="text" name="****" id="****" /></td><td><label for="****">****: </label><select name="****" id="****"><option value="" disabled selected> </option><option value="****">****</option><option value=""></option><option value=""></option><option value=""></option></select></td></tr></table></div><br><div class="kristina"><table><tr><td><label for="****">****: </label><select name="****" id="****"><option value="" disabled selected hidden>-</option><option value="Yes">Yes</option><option value="No">No</option></select></td><td><label for="****">****:</label><textarea name="****" id="****" rows="1" cols="50"></textarea></td></tr><tr><td><label for="****">****: </label><input type="date" name="****" id="****"/></td></tr><tr><td><label for="****">****: </label><input type="date" name="****" id="****"/></td></tr><tr><td><label for="****">****: </label><input type="date" name="****" id="****"/></td></tr><tr><td><label for="****">****: </label><input type="date" name="****" id="****" /></td><td><label for="****">****: </label><select name="****" id="****"><option value="" disabled selected hidden>-</option><option value="Yes">Yes</option><option value="No">No</option></select></td></tr><tr><td><label for="">****: </label><input type="date" name="****" id="****"/></td><td><label for="****">****: </label><select name="****" id="****"><option value="" disabled hidden>-</option><option value="Yes">Yes</option><option value="No">No</option></select></td></tr><tr><td><label for="****">****: </label><input type="date" name="****" id="****"/></td><td><label for="****">****: </label><textarea name="****" id="****" rows="1" cols="50"></textarea></td></tr><tr><td><label for="****">****: </label><input type="date" name="****" id="****"/></td><td><label for="">****:</label><input type="text" name="****" id="****"></td></tr><tr><td><label for="****">****: </label><input type="date" name="****" id="****" data-format="YYYY-MM-DD"/></td></tr><tr><td><label for="****">****: </label><input type="date" name="****" id="****" data-format="YYYY-MM-DD"/></td></tr><tr><td><label for="****">****: </label><input type="date" name="****" id="****" data-format="YYYY-MM-DD"/></td><td><label for="****">****: </label><input type="date" name="****" id="****" data-format="YYYY-MM-DD"/></t</tr><tr><td><label for="****">****: </label><select name="****" id="****"><option value="" disabled selected hidden>-</option>';
foreach($stuff5 as $sr) { $Content .= '<option value="'.$sr["id"].'">'.$sr["****"].'</option>'; }
$Content .= '</select></td><td><label for="****">****: </label><input type="date" name="****" id="****" data-format="YYYY-MM-DD"/></td></tr><tr><td><label for="****">****: </label><select name="****" id="****"><option value="" disabled selected hidden>-</option>';
foreach($stuff4 as $so) { $Content .= '<option value="'.$so["id"].'">'.$so["Description"].'</option>'; }
$Content .= '</select></td><td><label for="****">****: </label><select name="****" id="****">'; 
foreach($stuff1 as $ss) { $Content .= '<option value="'.$ss["id"].'">'.$ss["Description"].'</option>'; }
$Content .= '</select></td></tr><tr><td><label for="****">****:</label><input type="date" id="****" name="****"/></td><td><label for="Notes">Notes: </label><textarea name="Notes" id="Notes" rows="1" cols="50"></textarea></td><td><button type="button" name="****" id="****">****</button></td></tr></table></div><br/><input class="button" type="submit" value="Submit" form="form1" style="float:right"></form>';

 return $Content;
}

add_shortcode('aaapp_medwaiver_wordpress_plugin_ka', 'aaapp_medwaiver_wordpress_plugin_ka');
add_shortcode('aaapp_mwgrid_wordpress_plugin_ka', 'aaapp_mwgrid_wordpress_plugin_ka');
?>
