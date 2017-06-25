<?php

//Функция получения массива каталога

function get_cat($res_productType_byProducer) {

		if($res_productType_byProducer->num_rows > 0){			
			echo $res_productType_byProducer->num_rows;//проверим количество записей по запрсу;	
			$array_rows = array();		
        	for($i = 0; $i < $res_productType_byProducer->num_rows; $i++) {
				$row = $res_productType_byProducer->fetch_row();
				$array_rows = array_merge($array_rows, $row);
				if($row[2]==0){		
 	
        			echo '<li class= "parrent_0"><a href="#">'.$row[1].'</a></li>';
 
				}
			}
		}
		echo count($array_rows);

}
?>