<?php
	//remember all the directories must be relative to the source files from where  this would be called.
	function header_top()
	{
		$result="
		
			<img src=\"includes/header/icon.jpg\" id=\"siteIcon\">
			<div id=\"headerTitle\">
				<h1>theDataBugs</h1>
			</div>

			<div id=\"searchBox\">
				<form method=\"GET\" action=\"search.php\" target=\"iframePage\">
					<table style=\"padding: 0px;\">
						<tr>
							<td style=\"border-style=none; height:40px;\";>
									
									<input type=\"text\" name=\"searchKey\" value:\"Search\" style=\"border:none; background-color: white; height:40px; width:160px; padding: 0px 4px 0px 4px\";>
				 				
				 			</td>
				 			<td style=\"border-style=none\";>
				 				<input type=\"submit\" value=\"GO\" style=\"border-style: none ; color: white ; background-color : black ; width : 40px; height : 40px;\">
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div id=\"headerDesc\">
				<p> To help you... </p>
			</div>
		</div>";
		return $result; 
	}

	function header_nav()
	{	global $connect;
		$result= "
		<ul>";
  			$query="SELECT id,name FROM category WHERE visible=1 ORDER BY position";
  			$navbars=$connect->query($query);
  			while($tab=$navbars->fetch_array())
  			{	
  				$url="http://localhost/sandbox/myProject/iframe_page.php?id=";
  				$url.=urlencode($tab['id']);
  				$result .= "<li><a href=\"{$url}\" target=\"iframePage\">{$tab['name']}</a>";

  				/*QUERY FOR SUB MENU*/
  				if($tab['id']>1&&$tab['id']<39)/*for tabs other than home about us news and contacts*/
	  			{	
	  				$subquery= "SELECT name,cate_id,filename FROM branches WHERE visible=1 AND cate_id={$tab['id']} ORDER BY name";
	  				$substmt=$connect->prepare($subquery);
		  			$substmt->execute();
  					$substmt->bind_result($subname,$subid,$subfile);
  					//$result.="<div class=\"sublist\">";
	  				$result .= "<ul>";
  					while($substmt->fetch())
  					{
  							$url="http://localhost/sandbox/myProject/iframe_page.php?id=";
	  						$url.=urlencode($subid);
	  						$result.="<li><a href=\"{$url}\" target=\"iframePage\">{$subname}</a></li>";

  					}//inner while
  					$result .= "</ul>";
  				}//if		
  				$result.="</li>";

  			}//creating main nav bar
  			$result.="
  		</ul>
	";
		return $result;
	}
	function footer()
	{
		
	}
?>
