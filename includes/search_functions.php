<?php

	function searchbox()
		{	global $bool;
			$out=   "
					<form method=\"GET\" action=\"search.php\" target=\"_self\">
					<input class=\"inputkey\" type=\"text\" name=\"searchKey\" ";
			if(isset($bool))
			{
				if ($bool==true)
				{
					$out.=" value='{$_GET['searchKey']}' ";
				}
				
			}
			$out.= " maxlength=\"500\">&nbsp;&nbsp;";
			$out.=  "<input type=\"submit\" value=\"GO\" class=\"gosearch\">";
			$out.=  "</form>";
			return $out;

		}
	
	function query_fetch_tabulate()
	{
		global $KEY;
		global $connect;
		$search_result="";
		/*MAKE THE KEY SEARCHABLE */
			//Replace all special characters with SPACE
			$replace_set=array("!","`","@","#","$","%","^","&","*","(",")","_","-","+","=","/",".",",","{","}","|",";",":","'",'"',"<",">","?");
			$KEY=str_ireplace($replace_set, " ", $KEY);
			//removing double space
			$KEY=str_ireplace("  ", " ", $KEY);
			/*MAKE THE KEY WORD SAFE TO USE- we dont want any chance of sql injection*/
			$KEY=mysqli_real_escape_string($connect,$KEY);
			//making a string compatible for REGEXP usage to simplify the query
			$KEYS_prime=explode(" ",$KEY);//returns array
			$KEYS=implode("|",$KEYS_prime);//returns joined string
			//Again remove spaces from the REGEXP ready key, cz the abv may contain space if there are redundant spaces.
			$KEYS=str_ireplace(" ", "", $KEYS); //uncomment the instruction.
		/*MAKING QUERY USING MYSQLI PREPARED STATEMENTS*/
		
		$query="SELECT id,storename,items,spec,address,contact,score,lat,lng FROM storesND WHERE (`items` REGEXP '$KEYS') OR (`spec` REGEXP '$KEYS')"; // change select * => only required attributes ->SECURITY CONCERN
		/* ALTER METHOD THAT FAILED
		$key_num--;
		$ctr=1;
		while($key_num--)
		{	$query.=" UNION ";
			$query.="SELECT id,storename,items,spec,address,contact,score FROM storesND WHERE (`items` LIKE '%{$KEY[$ctr]}%') OR (`spec` LIKE '%{$KEY[$ctr]}%')";
			$ctr++;
		}*/
		$stmt=$connect->prepare($query);
		//$stmt->bind_param("ss",$KEY);
		$stmt->execute();
		/*COUNT THE ROWS*/
		$stmt->store_result();
		$num_rows = $stmt->num_rows;
		$shout="{$num_rows} result(s) found";
		$search_result.="<br><h3 id=\"shout\">".$shout."</h3><br>";
		
		/*BIND THE RESULTS TO THE VARIABLES*/
			$stmt->bind_result($id,$storename,$items,$spec,$address,$contact,$score,$lat,$lng);
		/*FETCH THE RESULTS TABULATE THEM if you get results*/
		$location_url="loconmap.php?";
		if($num_rows>0)
		{
			$search_result.="<table class=\"searchresults\">";
			//PRINT THE HEADERS
			$search_result.=
				"<tr>
					<th>STORE NAME</th>
					<th>ITEMS</th>
					<th>SPECIFICATIONS</th>
					<th>STORE ADDR.</th>
					<th>CONTACT</th>
					<th>Score</th>
					<th>Locate on MAP</th>
				</tr>";
			//LOOP TO PRINT TABLE DATA ROWS
			while($stmt->fetch())
			{	
				//$l_url=$location_url."lat=".urlencode($lat)."&lng=".urlencode($lng)."&name=".urlencode($storename)."&add=".urlencode($address);
				$l_url=$location_url."lat=".$lat."&lng=".$lng."&name=".$storename."&add=".$address;
				$search_result.=
				"<tr>
					<td>$storename</td>
					<td>$items</td>
					<td>$spec</td>
					<td>$address</td>
					<td>$contact</td>
					<td>$score</td>
					<td><a href=\"{$l_url}\" target=\"_blank\"><img src=\"includes\mapicon.png\" title=\"Click to see location on map\" ></a></td>
				</tr>";	

			}
			$search_result.="</table>";
		}//if $nos>0

		return $search_result;
	}
?>