<?php
echo "
<div class=\"container\">
<br />
<br />
<br />
<br />
<br />
<br />
    <h1>
      Admin Add Dinner
		</h1>
    <br />
    <br />

		<form style=\"\" name=\"addDinner\" 
			 action=\"admin-addDinnerProccess.php\"
			 method=\"POST\">
        <div style=\"margin-bottom:1rem;\">
          <span style=\"margin-bottom:50px\">Entrée Name:</span>
          <input type=\"text\" 
            name=\"entree_name\"	
            id=\"entree_name\" class=\"inputText\" required/>
        </div>
        <div style=\"margin-bottom:8rem;\">
          <span>Event Date:</span>
          ";
// date input component that will be resused in other pages. the select with popualated Thursday dates          
include "Components/dateSelect.php";
echo "
        </div>
        <div style=\"margin-bottom:1rem;\">
          <span>Start Time:</span>
          <input type=\"time\" 
            name=\"start_time\"	
            id=\"start_time\" class=\"inputText\" value=\"11:30\" required/><br />
        </div>
				End Time: 
				<input type=\"time\" 
					 name=\"end_time\"	
					 id=\"end_time\" class=\"inputText\" value=\"13:30\" required/><br /><hr />
				Available Seats: 
				<input type=\"number\" 
					 name=\"seats\"	
					 id=\"seats\" class=\"inputText\" value=\"32\" required/><br /><br />
        Price Per Seat:
           <input type=\"number\" 
              name=\"price\"	
              id=\"price\" class=\"inputText\" value=\"16\" required/><br /><br /><br />

        <div style=\"text-align:center; display:flex; justify-content:space-evenly\">
        <input type=\"submit\" class=\"buttonLinks3\"
        name=\"submit\"	
        value=\"Submit\" />	
        <input type=\"reset\" class=\"buttonLinks3\"
        name=\"reset\"	
        value=\"Clear\"/>
        <a href=\"admin-dashboard.php\" class=\"buttonLinks3\" >Dashboard</a>
        </div>
        

		</form>


       <br /><br /><br />
</div>";
?>