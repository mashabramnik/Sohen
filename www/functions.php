<?php

//Функция получения массива каталога

function createArrByProductTypeDB($res_productType_byProducer) {

		if($res_productType_byProducer->num_rows > 0){			
			//echo $res_productType_byProducer->num_rows;//проверим количество записей по запрсу;
			//создаем пустой трехмерный массив;	
			$array_prod_types_3d = array();		
			//В цикле формируем этот трехмерный массив;
        	for($i = 0; $i < $res_productType_byProducer->num_rows; $i++) {
        		// fetch_row (); нам давал массив с доступом по индексу. А fetch_assoc(); даст нам массив с доступом к элементам по полю.
        		//(из тех полей ,кто был вытащен по запросу );
				$row = $res_productType_byProducer->fetch_assoc();
				//проверяем заполнена ли самая внешняя ячейка, которая совпадает со значением поля idParent; Если пустая, т.е.empty	        
				if(empty($array_prod_types_3d[$row['idParent']])) {
					//то создаем на месте этой ячейки пустой массив (второй уровень);
					$array_prod_types_3d[$row['idParent']] = array();
				}
				//заполняем первую ячейку массива второго уровня ассоциативным массивом данных;
				$array_prod_types_3d[$row['idParent']][] = $row;
			}
		}
		//echo count($array_prod_types_3d);
		//print_r($array_prod_types_3d);
		
		$GLOBALS['level'] = -1;
		createMenuByProductTypeArr($array_prod_types_3d);

}
?>

<?php
//вывод каталога с помощью рекурсии
function createMenuByProductTypeArr($arr, $parent_id = 0) {
	
	$GLOBALS['level'] = $GLOBALS['level'] + 1;
//	echo $GLOBALS['level'];

	//перебираем в цикле массив и выводим на экран.
	for($i = 0; $i < count($arr[$parent_id]);$i++) {

		$hasChildren = !empty($arr[$parent_id][$i]['id']);
		if($hasChildren){
			echo '<li class= "parrent_'.$GLOBALS['level'].'"><a href="#">'.$arr[$parent_id][$i]['name'].'</a><ul>';
						
			//рекурсия - проверяем нет ли дочерних категорий
			createMenuByProductTypeArr($arr, $arr[$parent_id][$i]['id']);
			echo '</ul></li>';		
		}
		else{
			$classNameStr = "parrent_".$GLOBALS['level'];
?>
			<!--   echo '<li class= "parrent_'.$GLOBALS['level'].'"><a href="#">'.$arr[$parent_id][$i]['name'].'</a></li>';	-->
			
			<li class="<?php $classNameStr; ?>"><a class="a_producttype" href="shop.php?producttype=<?php$arr[$parent_id][$i]['name'];?>"><?php echo $arr[$parent_id][$i]['name'];?> </a></li>
<?php				
		}
	}
	$GLOBALS['level'] = $GLOBALS['level'] - 1;
	$pr = $_GET['producttype'];
	echo $pr;
}
?>