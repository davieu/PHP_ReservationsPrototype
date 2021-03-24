<?php
include "fileLinks.php";
include "../header.php";
include "../nav.php";

$title = "Add Account";
echo "
<br />
<br />
<br />
		<div>
		<h1>
		   $title
		</h1>

		<form class=\"mb-4\" name=\"processTest\" 
			 action=\"processTest.php\"
			 method=\"POST\">
				First Name: 
				<input type=\"text\" 
					 name=\"first_name\"	
					 id=\"first_name\" required/><br />
				Last Name: 
				<input type=\"text\" 
					 name=\"last_name\"	
					 id=\"last_name\" required/><br /><br /><hr />
			<input type=\"submit\" class=\"clearBtn\"
				 name=\"submit\"	
				 value=\"Submit\" />		
			<input type=\"reset\" class=\"clearBtn\" 
				 name=\"reset\"	
				 value=\"Clear\" /><br />						 
		</form>

		   <a  href=\"../index.php\">Return to Home</a>

	</div>\n";
include "../footer.php";
?>
