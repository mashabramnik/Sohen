<?php

session_start();

 if(isset($_GET['logout'])){
 	unset($_SESSION['producer']);
	unset($_SESSION['user']);
	header('Location:index.php');
}

include 'functions.php';

$producer = $_GET['producer'];
$_SESSION['producer'] = $producer;
$mysqli = new mysqli("localhost", "root", "1234", "sohen");
if($mysqli->connect_errno){
		echo "MySQL database conncetion failed - (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;//каждый раз?
}
else{	
	mysqli_set_charset($mysqli,'utf8');				
	$res = $mysqli->query("SELECT id FROM producer WHERE name='".$producer."'");
if(!$res){
	echo "проблемы с базой данных(" . $mysqli->errno . ") " . $mysqli->error;
}
else{
	if($res->num_rows > 0){
		$row = $res->fetch_row();
		global $producer_id;
		$producer_id = $row[0];
		mysqli_set_charset($mysqli,'utf8');
		$res_by_producer = $mysqli->query("SELECT id , name , price , packGram FROM product WHERE producer_id='".$producer_id."'");
		if(!$res_by_producer){
			echo "проблемы с базой данных(" . $mysqli->errno . ") " . $mysqli->error;
    	}
   		 else{
    	
?>  	

<!DOCTYPE html>
<html>
   
    <head>
        <title>Exaple Gird</title>    
		
		<link  href="css/items_table.css" rel="stylesheet" type="text/css"/>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width initial-scale=1.0"> 
		<link  href="css/mystyles.css" rel="stylesheet" type="text/css"/> 
		<link href="images/monetkaIcon.png" rel="shortcut icon" type="image/x-icon"/>
        <link href="css/dcaccordion.css" rel="stylesheet" type="text/css" />
        <link href="css/graphite.css" rel="stylesheet" type="text/css" />
        <link  href="css/slider.css" rel="stylesheet" type="text/css"/>	
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type='text/javascript' src='js/jquery.cookie.js'></script>
<script type='text/javascript' src='js/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='js/jquery.dcjqaccordion.2.7.min.js'></script>
<script type="text/javascript">
		$(document).ready(function($){

					$('#accordion-1').dcAccordion({
						eventType: 'click',
						autoClose: true,
						saveState: true,
						disableLink: true,
						speed: 'slow',
						showCount: true,
						autoExpand: true,
						cookie	: 'dcjq-accordion-1',
						classExpand	 : 'dcjq-current-parent'
					});
		
});
</script>
    </head>
  
    <body>

	
	
	<!-- CONTENT -->
	<div class="container">
		<div class="row" id="head">
			<div class="no-float">
									
			    <img id="logoImg" src="images/bluRingSmall.jpg"/>
		 		<span id="siteNameLogo_shop" ><a href="index.html"title="на главную" ">ВИРТУАЛЬНЫЙ СОХЕН</a></span>
		 		<div class="languages_shop" ><img src="images/RussiaFlat.png"  id="russian_shop"/><img src="images/IsraelFlat.png"  id="hebrew_shop"/></div>
		 		<span id="exit_shop"><a href="?logout">exit</a></span>		 		
		 		<span id= "about_shop"><a href="about.html">about</a></span>
		 		<span id="contact_shop"><a href="about.html">contacts</a></span>
		 		 	
				
			</div>
		</div>
		<div class="row">	
			
			<div class="col-md-12 no-float">
				<div id="head_shop">
					<div id="menu_horizontal_new">
						<ul>							
							<li><a href="" >Вернуться к выбору производителя</a></li>							
							<li><a href="" >Акции и Новинки</a></li>							
							<li><a href="" >Мой личный кабинет</a></li>
							<li id="shoping_cart"><a href="" >Моя корзина</a></li>
							<li id="number_of_items"><input placeholder="0"/></li>
							<li id="show_amount"><input placeholder="0 шек." /></li>
							<li id="checkout"><a href="" >Оформить заказ</a></li>
						</ul>
					
					</div>	
				</div>	
						 
				<div class="wrap">
					<div class="graphite demo-container">
						<ul class="accordion"  id="accordion-1">
    						<li id= "catalog_tovarov">КАТАЛОГ ТОВАРОВ</li>
    						<li id= "producer_name">"<?php echo $_GET['producer'];?>"</li>
  <?php
    $parent0 = 0;
    mysqli_set_charset($mysqli,'utf8');				
	$res_productType_byProducer = $mysqli->query("SELECT id, name, idParent FROM producttype WHERE producer_id='".$producer_id."'");
	if(!$res_productType_byProducer){
		echo "проблемы с базой данных(" . $mysqli->errno . ") " . $mysqli->error;
	}
	else{		
		if($res_productType_byProducer->num_rows > 0){			
			echo $res_productType_byProducer->num_rows;//проверим количество записей по запрсу;	
			$array_rows = array();		
        	for($i = 0; $i < $res_productType_byProducer->num_rows; $i++) {
				$row = $res_productType_byProducer->fetch_row();
				$array_rows = array_merge($array_rows, $row);
				if($row[2]==0){		
  ?>  	
        			<li class= "parrent_0"><a href="#"><?php echo $row[1]; ?></a></li>	
  <?php 
				}
			}
			echo count($array_rows);
			get_cat();
		}
	}
  ?>          				
    				<!--		
    						<li class= "parrent_0"><a href="#">МЯСНОЕ</a><ul>
            					<li class ="parrent_1"><a href="#">Холодцы</a><ul>
                    				<li class = "parrent_2"><a href="#">Холодец1</a></li>
									<li class = "parrent_2"><a href="#">Холодец2</a></li>						
									<li class = "parrent_2"><a href="#">Холодец3</a></li>
									<li class = "parrent_2"><a href="#">Холодец4</a></li>
									<li class = "parrent_2"><a href="#">Холодец5</a></li>
					  			</ul>
								</li>
                    			<li class = "parrent_1"><a href="#">Рулеты</a><ul>
									<li class = "parrent_2"><a href="#">Рулет1</a></li>
									<li class = "parrent_2"><a href="#">Рулет2</a></li>
									<li class = "parrent_2"><a href="#">Рулет3</a></li>
									<li class = "parrent_2"><a href="#">Рулет4</a></li>
					  			</ul>
								</li>
								<li class = "parrent_1"><a href="#">Отбивные</a><ul>
									<li class = "parrent_2"><a href="#">Отбивные1</a></li>
									<li class = "parrent_3"><a href="#">Отбивные2</a></li>
									<li class = "parrent_3"><a href="#">Отбивные3</a></li>
									<li class = "parrent_3"><a href="#">Отбивные4</a></li>
					  			</ul>
								</li>                		            			
            					<li class = "parrent_1"><a href="#">Заливное</a><ul>
                    				<li class = "parrent_2"><a href="#">зааливное1</a></li>
                    				<li class = "parrent_2"><a href="#">заливное2</a></li>
                    				<li class = "parrent_2"><a href="#">заливное3</a></li>
                    				<li class = "parrent_2"><a href="#">заливное4</a></li>
                    				<li class = "parrent_2"><a href="#">заливное5</a></li>
                    				<li class = "parrent_2"><a href="#">заливное6</a></li>
                				</ul>
            					</li>
            					<li class = "parrent_1" ><a href="#">Колбасы</a><ul>
                    				<li class = "parrent_2"><a href="#">Колбаса1</a></li>
                    				<li class = "parrent_2"><a href="#">Колбаса2</a></li>
                    				<li class = "parrent_2"><a href="#">Колбаса3</a></li>
                    				<li class = "parrent_2"><a href="#">Колбаса4</a></li>
                				</ul>
            					</li>
            					<li class = "parrent_1"><a href="#">Сосиски</a><ul>
                    				<li class = "parrent_2"><a href="#">Сосиски1</a></li>
                   			 		<li class = "parrent_2" ><a href="#">Сосиски2</a></li>
               			 		</ul>
            					</li>
            					<li class = "parrent_1"><a href="#">Паштеты</a><ul>
		                			<li class = "parrent_2"><a href="#">Паштет1</a></li>
		                    		<li class = "parrent_2"><a href="#">Паштет2</a></li>
                    				<li class = "parrent_2"><a href="#">Паштет3</a></li>
                    				<li class = "parrent_2"><a href="#">Паштет4</a></li>
              					</ul>
            					</li>
        					</ul>
    						</li>
							<li class = "parrent_0"><a href="#">САЛАТЫ</a><ul>
    							<li class = "parrent_1"><a href="#">Мясные</a><ul>
        							<li class = "parrent_2"><a href="#">Оливье</a></li>
        							<li class = "parrent_2" ><a href="#">Куриный с рисом</a></li>
    							</ul>
								</li>
								<li class = "parrent_1"><a href="#">Рыбные</a><ul>
        							<li class = "parrent_2"><a href="#">Тунец с помидорами</a></li>
        							<li class = "parrent_2"><a href="#">Тунец с рисом</a></li>
        							<li class = "parrent_2"><a href="#">Лосось с баклажанами</a></li>
        							<li class = "parrent_2"><a href="#">Палтус с яблоками</a></li>
    							</ul>
								</li>
    							<li class = "parrent_1"><a href="#">Овощные</a><ul>
        							<li class = "parrent_2"><a href="#">Помидоры с огурацами</a></li>
        							<li class = "parrent_2"><a href="#">Баклажаны с помидорами</a></li>
        							<li class = "parrent_2"><a href="#">капустный с перцами</a></li>
    							</ul>
								</li>
    							<li class = "parrent_1"><a href="#">Фруктовые</a><ul>
    								<li class = "parrent_2"><a href="#">Персики с яблоками</a></li>
    								<li class = "parrent_2" ><a href="#">Груши с листьями салата</a></li>
    								<li class = "parrent_2"><a href="#">Апельсины с ананасами</a></li>
    								<li class = "parrent_2"><a href="#">Манго с мандаринами</a></li>
								</ul>
								</li>						
							</ul>
							
				-->				
							<li class = "cont"><a href="#">Contact us</a></li>
						
						</ul>
					</div>
        		</div>        	        	        	        	        	
        	<div id = "wrap_right_table_items" ">
        		<div id ="wrap_right">
        			<div id="slider"> 
      					<div id="mask">
        					<ul id="image_container">
          						<li><img src="images/sal1.jpg"></li>
          						<li><img src="images/sal2.jpg"></li>
         			    		<li><img src="images/sal3.jpg"></li>
          						<li><img src="images/sal4.jpg"></li>
          						<li><img src="images/sal5.jpg"></li>
          						<li><img src="images/sal6.jpg"></li>
          						<li><img src="images/sal7.jpg"></li>
          						<li><img src="images/sal1.jpg"></li> 
          						<li><img src="images/sal3.jpg"></li>        
        					</ul>
      					</div>
      					<img src="resources/glass.png"  id="glass">
						      <!-- l'encart bleu. Quoter s'il est genant --><!--
						      <div id="encart">
						        <img src="resources/bouton.png" id="bouton">
						      </div>-->
						      <!-- fin de l'encart -->
						      <!-- Les fleches de navigations -->
      					<ul id="dots">   
          					<li class="button1" onClick="changeImage(1)" ></li>
          					<li class="button2" onClick="changeImage(2)" ></li>
          					<li class="button3" onClick="changeImage(3)" ></li>
          					<li class="button4" onClick="changeImage(4)" ></li>         
      					</ul>
      					<img src="resources/fleche-gauche.png" id="fleche_gauche" class="fleche" onClick="prevImage()" >
      					<img src="resources/fleche-droite.png" id="fleche_droite" class="fleche" onClick="nextImage()" >
     		 		</div>
    		<script>
			      // Des Variables pour pouvoir modifier facilement ce qui doit l'A?tre
			      var secDuration = 5;
			      var image = 1;
			      var maxImages = 6;
			      var slider = document.getElementById('slider');
			      var timeout
			      
			      // La fonction qui change les images. Peut pointer vers une image spA©cifique, ou bien A?tre appelA©e vide, pour passer A§ celle d'apres
			      function changeImage(requiredImage) {
			      
			        // DA©but de l'algorithme  .
			        if (!requiredImage && requiredImage != 0){ //Si nous n'avons pas spA©cifiA© une image
			          if(image < maxImages){// Si l'image n'est pas la derniA?re, on avance d'une image
			            image++;
			          }
			          else{
			            image = 1;//Si Nous sommes sur la derniA?re, on reviens au dA©but 
			          }
			        }
			        else{ // Si nous avont spA©cifiA© une image
			          if(requiredImage > maxImages){//Si nous avont spA©cifiA© une image au dela de la derniA?re, on revient A  la premiA?re
			            image = 1;
			          }
			          else if(requiredImage < 1){ //Si nous avont spA©cifiA© une image 0 ou moins, on vas A  la derniA?re image
			            image = maxImages;
			          }
			          else{
			            image = requiredImage; // Sinon, on vas A  l'image spA©cifiA©e.
			          }
			        }
			        //On dis au slider A  travers sa classe quel image il doit afficher
			        slider.className = "image"+image;
			        
			        // On nettoie et relance le timeout
			        clearTimeout(timeout)
			        timeout = setTimeout("changeImage()",secDuration*1000);
			      }
			      
			      //Deux petites fonctions tres comprA©hensibles
			      function nextImage(){
			        changeImage(image+1);
			      }
			      function prevImage(){
			        changeImage(image-1);
			      }
			      
			      //On met le slide sur l'image par dA©faut, ici la 1ere
			      changeImage(1);
			</script>
        		
        		</div>
        		<div class = "paginator">Выводить по&nbsp; <a>5&nbsp;</a><a>10&nbsp;</a><a>Все</a></div>
            		<div id = "items_table">
<?php 
       	if($res_by_producer->num_rows > 0){
			//echo '<p>' .$res_by_producer->num_rows. '</p>';//проверим количество записей по запрсу;
			$i = 0;
        	for($i; $i < $res_by_producer->num_rows; $i++) {
				$row = $res_by_producer->fetch_row();
?>
			<div class = "items"><p class = "product_name_table"> <?php echo $row[1]; ?></p><p class = "product_weight_table"><?php echo $row[3];?><br/>грамм</p>
			<p  class="product_img_sm_table"><img src="images/hol6.jpg"></p><p class = "p_description_table"><a class="description_table">Описание</a></p>
			<p class = "product_price_table"> <?php echo $row[2];?>&nbsp;шек.</p><p class="p_button_table"><button class="button_table">В корзину</button></p></div>
<?php			
			}
		}
	}
  }	
}
}

?>  
		
            		</div>
           	</div> 				
			</div>			
		</div>
		<div class="row" id="footer">
			<div class="no-float">
				<p id="footer_text">copyright 2017</p>
			</div>
		</div>
	</div>
	<!-- End CONTENT -->

    </body>
</html>