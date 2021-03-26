<?php
echo "
<div class=\"container\">
<h1>
		</h1>

		<form style=\"width:30%\" name=\"addDinner\" 
			 action=\"admin-addDinnerProccess.php\"
			 method=\"POST\">
				<span style=\"margin-bottom:50px\">Entrée Name:</span>
				<input type=\"text\" 
					 name=\"entree_name\"	
					 id=\"entree_name\" style=\"float:right;\" required/><br />
				<span>Event Date:</span>
				<input type=\"date\" 
					 name=\"event_date\"	
					 id=\"event_date\" style=\"float:right;\" required/><br />
				Start Time: 
				<input type=\"text\" 
					 name=\"start_time\"	
					 id=\"start_time\" style=\"float:right;\"required/><br />
				End Time: 
				<input type=\"text\" 
					 name=\"end_time\"	
					 id=\"end_time\" style=\"float:right;\" required/><br /><br /><hr />
				Available Seats: 
				<input type=\"number\" 
					 name=\"seats\"	
					 id=\"seats\" value=\"32\" required/><br /><hr />	 
        Price Per Meal/Seat: 
           <input type=\"number\" 
              name=\"price\"	
              id=\"price\" value=\"16\" required/><br /><hr />	
		</form>

		   <a  href=\"mainPage.php\">Return to Home</a>
</div>";
?>