<?php   
session_start();
 if(isset($_GET['logout'])){
 	
	unset($_SESSION['user']);	
	header('Location:index.php');
}


?>
<!DOCTYPE html>
<html>
   
    <head>
        <title>Exaple Gird</title>   
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width initial-scale=1.0"> 
		<link  href="css/mystyles.css" rel="stylesheet" type="text/css"/>      
    </head>
  
    <body>

	<!-- CONTENT -->
	<div class="container">
		<div class="row" id="head">
			<div class="no-float">
			
				<img id="logoImg" src="images/bluRingSmall.jpg"/>
		 		<span id="siteNameLogo" ><a href="index.html"title="на главную" ">ВИРТУАЛЬНЫЙ СОХЕН</a></span>
	            <span id="exit"><a href="?logout">exit</a></span>                                    
		 		<span id= "about"><a href="about.html">about</a></span>
		 		<span id="contact"><a href="about.html">contacts</a></span>	
				
			</div>
		</div>
		<div class="row">	
			
			<div class="col-md-12 no-float">
			
			
			<div id="slogan_flag_outer_s">
				<div id="slogan_flag_inner_s">
					<div class="sloganSecond" id="sloganSecond_first">ВЫБЕРИ ПРОИЗВОДИТЕЛЯ</div>		
					<div class="languages_s" ><img src="images/RussiaFlat.png"  id="russian_s"/><img src="images/IsraelFlat.png" id="hebrew_s" /></div>		
				</div>
			</div>
		
	    	<div class="sloganSecond" id="sloganSecond_second">и.. ЭКОНОМЬ С НАМИ !</div>
	    
			<div id="logoSelect">
				<div id="logoSelectInner">
					<a href="shop.php?producer=veles"><img src="images/pogo6.jpg" alt="" /></a>
				</div>
			</div>

			
			
	
			</div>			
		</div>
<?php
	 		
     $str_index_echo = "Вы зашли как представитель магазина \"".$_SESSION['user']."\"";
?>
	<p id = echo_index style="height: 80px;font-size: 1.5em;">			
<?php   
    echo $str_index_echo;					 				     
?>		
    </p>
		
		
		<div class="row" id="footer">
			<div class="no-float">
	
		<p id="footer_text">copyright 2017</p>
	
			</div>
		</div>
	</div>
	<!-- End CONTENT -->

	
       

    </body>
</html>