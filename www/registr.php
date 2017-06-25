<?php   
session_start();
 if(isset($_GET['logout'])){
 	
	unset($_SESSION['user']);	
	header('Location:index.php');
	
}
//Error_Reporting(E_ALL & ~E_NOTICE);
ini_set('error_reporting',E_ALL & ~E_NOTICE);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>

	<head>
		<title>виртуальный сохен</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width initial-scale=1.0">
		<meta name="keywords" content="оптовые продажи , продукты, в израиле"/>
		<meta name="description" content="оптовые продажи продуктов в израиле. виртуальный сохен."/>
		<meta name="author" content="M.Bramnik"/>
		<meta name="copyright" content="All rights belong to Bramnik"/>
		<link  href="css/mystyles.css" rel="stylesheet" type="text/css"/>
		<link  href="css/private_office.css" rel="stylesheet" type="text/css"/>
		<link  href="css/shop_cart.css" rel="stylesheet" type="text/css"/>		
		<link  href="css/registr.css" rel="stylesheet" type="text/css"/>
	</head>	
<body>
	<div class="container">
		<div class="row" id="head">
			<div class="no-float">
				
					
			   <img id="logoImg" src="images/bluRingSmall.jpg"/>
		 		<span id="siteNameLogo_shop" ><a href="index.html"title="на главную" ">ВИРТУАЛЬНЫЙ СОХЕН</a></span>
		 		<div class="languages_shop" ><img src="images/RussiaFlat.png"  id="russian_shop"/><img src="images/IsraelFlat.png"  id="hebrew_shop"/></div>
		 		<span id= "about_shop"><a href="about.html">about</a></span>
		 		<span id="contact_shop"><a href="about.html">contacts</a></span>	

				
			</div>
		</div>
		<div class="row">	
			
			<div class="col-md-12 no-float">
			<div id="head_shop">
			<div id="menu_horizontal_new">
			<ul>
					<li><a href="" >Вернуться на главную</a></li>
					<li><a href="" >Вернуться к выбору производителя</a></li>
					<li><a href="" >Наши новости</a></li>
					<li><a href="" >Акции</a></li>
					<li><a href="" >Мой личный кабинет</a></li>
					<li id="shoping_cart"><a href="" >Моя корзина</a></li>
					<li id="number_of_items"><input placeholder="0"/></li>
					<li id="show_amount"><input placeholder="0 шек." /></li>
					<li id="checkout"><a href="" >Оформить заказ</a></li>
					<li id="checkout"><a href="" >Оформить заказ2</a></li>
				</ul>
					
			</div>	
			</div>	
        
        <div id="private_office_content">
        	<div id = "registr_header_wrap"><p id="registr_header">Добро пожаловать!</p></div>
        	<div id="private_info">
<?php
	$errortext = "";
	if(isset($_POST['email'])){
		$error=false;
		//$errortext="";
		$email=$_POST['email'];
		$password=$_POST['password'];
		$password_confirm = $_POST['password_confirm'];
		$tel=$_POST['tel'];
		$shopName=$_POST['shopName'];
		$len = strlen($password);
		$pass_content = TRUE;
		$pass_content = ctype_alnum($password);
		$city=$_POST['city'];
		$street=$_POST['street'];
		$numberHause=$_POST['numberHause'];
		
		//проверка имейла;
        $email_good = FALSE;
      //  if(preg_match("#.+@.+\..+#isu",$email)){       // это если попроще			    	
     	if(preg_match("#^[a-z0-9\-\_\.]+@[a-z0-9\-]+\.[a-z\.]*$#isu", $email)){ 	
			$email_good = TRUE;
			
		}
		if($email_good == FALSE){
			$error=true;
			$errorrext.="e-mail is not correct";
			
		}
	
		// проверяем что там только буквы и цифры;	
	    if($pass_content == FALSE){
			$error=true;
			$errortext.="password  must contain only letters of the Latin alphabet and (or) numbers<br/>"	;
		}
		
		if($len< 6){
			$error=true;
			$errortext.="Passwod can not be shorter than 6 characters<br/>";
			
		}
		if($password != $password_confirm){
			$error=true;
			$errortext.="second time you entered a password different from the first<br/>";
		}
	
//нормально если пользователь в поле телефон вводит плюсик. цифры и пробелы. Проверим что больше ничего не ввел	;
		$tel_content = FALSE;
		$tel_mod1= preg_replace('/\s/','',$tel); //убирает все пробелы;		
		//$tel_mod2 = preg_replace('/-/','',$tel_mod1);//убирает все дефисы;		
		//проверяем что в выражении есть плюсик на первом месте и убираем его;
		if(preg_match("#^(\+)#",$tel_mod1)){	
			$plus = true;
			$tel_mod1 = substr($tel_mod1,1);
			
		}		
//если все ведено правильно, то теперь должны остаться только цифры,проверим это;
       
        if((ctype_digit($tel_mod1))&& $plus == TRUE){
			$tel_content = TRUE;
		}
        if($tel_content == FALSE){    	
       	  $error=true;
       	  $errortext.="telephon number is not correct";
        }
        
       
//название города  и название улицы может содержать буквы латинского и русского алфавита а также дефисы ,пробелы и точки;
        
        
        
        $city_good = FALSE;

        if(preg_match("#^[a-zа-яё\s-.]{1}[a-zа-яё\s-.]*[a-zа-яё]{1}$#iu",$city)){
	   	
            $city_good = TRUE;
            
            
		}
		if($city_good == FALSE){
		  $error=true;
       	  $errortext.="city is not correct";
       	 
       	  
		}
		
        $street_good = FALSE;

        if(preg_match("#^[a-zа-яё\s-.]{1}[a-zа-яё\s-.]*[a-zа-яё]{1}$#iu",$street)){
	   	
            $street_good = TRUE;
            
		}
		if($street_good == FALSE){
		  $error=true;
       	  $errortext.="street is not correct";
       	  
		}

		
		  
//номер дома - это строка, так как у дома бывает корпус в виде букв или цифр;		  
		  $numberHause_good = FALSE;
		  
       if(preg_match("#^[\d][\d\s-\\][\w]#",$numberHause)){
       		$numberHause_good = TRUE;
       		
        }
        if(numberHause_good == FALSE){
			$error=true;
       	 	$errortext.="number of hause is not correct";
       	
		}

	
		if(empty($email)){
			$error=true;
			$errortext.="Empty email<br/>";
		}
	
		if(empty($password)){
			$error=true;
			$errortext.="Empty password<br/>";
		}
		if(empty($tel)){
			$error=true;
			$errortext.="Empty telephon number<br/>";
		}
		
		if(empty($shopName)){
			$error=true;
			$errortext.="Empty name of shop<br/>";
		}
		
		if(empty($city)){
			$error=true;
			$errortext.="Empty city name<br/>";
		}
		
		if(empty($street)){
			$error=true;
			$errortext.="Empty city name<br/>";
		}
		if(empty($numberHause)){
			$error=true;
			$errortext.="Empty number of Hause <br/>";
		}		
		
		if($error){	
				$errortext =  "Errors:<br/>".$errortext;
				$_SESSION['Registr_Unsuccessful'] = $errortext;
				header("Location: registr.php");
		}	
		else{
		/*foreach($_POST as $key=>$value){
		
			echo $key."-".$value."<br/>";
		}*/	
		//$query="INSERT INTO users VALUES('".$email."','".$password."')";
		//echo "<br>".$query."</br>";
					
			$mysqli = new mysqli("localhost", "root", "1234", "sohen");
			if($mysqli->connect_errno){
				echo "MySQL database conncetion failed - (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;//каждый раз?
			}
			else{
				mysqli_set_charset($mysqli,'utf8');
				//проверяем нет ли такого имейла в нашей бд;
				$resultTestUserExistence = $mysqli->query("SELECT email FROM user WHERE email='".$email."'");			
				if($resultTestUserExistence->num_rows > 0){
					
					$_SESSION['Registr_Unsuccessful']= "этот имейл уже используется";
					header("Location: registr.php");
				}
				else{								
					$result = $mysqli->query("INSERT INTO user (shopName, email, password, tel, city, userStatus_id, moneyBox, street, numberHause) VALUES ('".$shopName."','".$email."','".$password."','".$tel."','".$city."','1','0','".$street."','".$numberHause."');");
					//$result = $mysqli->query("INSERT INTO user (shopName, userStatus_id) VALUES ('Tetia Klava', 1)");
					
					if(!$result){
						echo "не удалось вставить данные(" . $mysqli->errno . ") " . $mysqli->error;
					}
					else{

						if(isset($_SESSION['Registr_Unsuccessful'])){
							
							unset($_SESSION['Registr_Unsuccessful']);
						}
						$_SESSION['registr']= TRUE;
						//echo"Вы успешно зарегистрированы. теперь войдите со своим паролем и email";
						header("Location: index.php");
						exit();
					}
				}
		    }	
		}		
	}else{	
	
?>				        	
       	     	
        	<p id="echo_registr_unsuccessfully" style="height: 80px;font-size: 1.5em;"><?php if(isset($_SESSION['Registr_Unsuccessful'])){
        		echo $_SESSION['Registr_Unsuccessful']; }?>     		
        	</p>
        		<form action="registr.php" name="auth_form" method = "post" onsubmit='return ValidateRegistr()'>
        			<div id = "form_block_left">
        				<p class = "form_header">Регистрационные данные</p>
        				<fieldset id = "form_border_left"> 
        				   			
	        				<div class="field">
								<label class="field_title">Название магазина-фирмы</label>
								<div class="form_input"><input type="text" name="shopName" id="shopNameReg" maxlength="50" value="" required="required"/></div>
							</div>

							<div class="field">
								<label class="field_title">Телефон</label>
								<div class="form_input">
									<input type="text" name="tel" id="telReg" tabindex="1" value="" required="required" />
								     <p>Формат ввода телефона <br/>+972 XXX XX XX XX</p>
								</div>
								
							</div>
							<div class="field">
								<label class="field_title">email</label>
								<div class="form_input"><input type="email" name="email" id="emailReg" maxlength="255" value="" required="required"/></div>
							</div>
							
							<div class="field">
								<label class="field_title">Пароль</label>
								<div class="form_input">
								<input type="password" id="form_input_pass" tabindex="0" name="password"  maxlength="20" value="" required="required"/>
								<p>Пароль должен быть не менее 6 символов длиной<br/>и содержать только буквы и ( или ) цифры</p>
								</div>
								
							</div>
							<div class="field">
								<label class="field_title">Подтверждение пароля</label>
								<div class="form_input"><input type="password" name="password_confirm" id ="password_confirmReg" maxlength="20" value="" required="required" /></div>
							</div>
	                    </fieldset>   
        			
        			</div>
        			
        			<div id = "form_block_right">     			
        				<P class = "form_header">Адрес доставки</P>
        				<fieldset id = "form_border_right">
	        				<div class="field">
								<label class="field_title">Город</label>
								<div class="form_input"><input type="text" name="city" id="cityReg" maxlength="50" value="" required="required"/></div>
							</div>

							<div class="field">
								<label class="field_title">Улица</label>
								<div class="form_input"><input type="text" name="street" id= "streetReg" value="" required="required" /></div>
								
							</div>
							<div class="field">
								<label class="field_title">Номер дома</label>
								<div class="form_input"><input type="text" name="numberHause" id="numberHauseReg" maxlength="255" value="" required="required"  /></div>
							</div>
						</fieldset>
						<div id="in_submit_right"><input class = "in_submit"  value="Отправить данные" type="submit" /></div>
                    </div>

        			</form>
        			
        			
 <?php
	}
	
?>								
	       			
        			
        			</div>
        			
        		</div>  
       		
   
   
   
   
   
       			</div>			
		</div>
		<div class="row" id="footer">
			<div class="no-float">
				Footeroooooooooooooooooooooooooooooooooooooooooooooooo
			</div>
		</div>
	</div>   
  
  
 <script type="text/javascript">
 function ValidateRegistr(){
 	var shopName = document.getElementById('shopNameReg').value;
	var email = document.getElementById('emailReg').value;
	var tel = document.getElementById('telReg').value;
	var city = document.getElementById('cityReg').value;
	var street = document.getElementById('streetReg').value;
	var numberHause = document.getElementById('numberHauseReg').value;
	var password = document.getElementById('form_input_pass').value;  
	var passwordConfirm = document.getElementById('password_confirmReg').value;
	
 //	alert(passwordReg);	
    if(shopName == ''){
	
 		alert("Введите название фирмы - магазина");	
	    return false;
	}
	
	if(email == ''){
	
 		alert("Поле E-mail пустое");	
	    return false;
	}

	if(password == ''){
	
		alert("Введите пароль");
		return false;
	}
	
	if(passwordConfirm == ''){
	
		alert("Подтвердите пароль");
		return false;
	}

	if(tel == ''){
	
 		alert("Введите телефон");	
	    return false;
	}
	
	if(city ==''){
	
 		alert("Введите город доставки");	
	    return false;
	}
	
	if(street ==''){
	
 		alert("Введите город доставки");	
	    return false;
	}
	
	if(numberHause ==''){
	
 		alert("Введите номер дома");	
	    return false;
	}
	
	if(password.length < 6){
		
		alert("Пароль слишком короткий ");
		return false;
	}
    if(password.length > 20){
    			
		alert("Пароль слишком длинный ");
		return false;
	}
	
	if(password != passwordConfirm){
		
		alert("Данные ,которые вы ввели в поле \"Подтверждение пароля \",отличаются от пароля");
		return false;
	}

    //проверяем что пароль содержит только буквы и цифры;
	var regPass = /[A-Z-a-z-0-9]/g;
	var passPatternMatch = regPass.test(password);	
	if(passPatternMatch == false){

		alert(" Пароль может содержать только буквы латинского алфавита и (или) цифры ");
		return false;
	}
	//проверяем имейл на соответствие шаблону;
	//var regEmail = /^[a-z0-9\-\_\.]+@[a-z0-9\-]+\.[a-z\.]*$/isu;//почему-то вообще не работает с /su;	
	var regEmail = /^[a-z0-9\-\_\.]+@[a-z0-9\-]+\.[a-z\.]*$/i;
	var emailPatternMatch = regEmail.test(email);
	if(emailPatternMatch == false){
		
		alert("Не корректный адрес E-mail ");
		return false;
	}
		
	//номер телефона сначала уберем пробелы;
	var telMod = tel.replace(/\s/g,'');
	var plus = false;	
	//теперь проверим есть ли плюсик на первом месте и вырежем его;
	if(telMod.charAt(0)== '+'){
		
		var plus = true;
	    telMod = telMod.slice(1);
	}	
	// теперь должны остаться только цифры;
	var regTel = /^\d+$/;
	var telPatternMatch = regTel.test(telMod);
	if((telPatternMatch== false)||(plus == false)){
		
		alert("не корректный телефонный номер");
		return false;
	}
//название города  и название улицы может содержать буквы латинского и русского алфавита а также дефисы ,пробелы и точки;
	var regCity = /^[a-zа-яё\s-.]{1}[a-zа-яё\s-.]*[a-zа-яё]{1}$/i;
	var cityPatternMatch = regCity.test(city);
	if(cityPatternMatch == false){
		
		alert("не корректное название города");
		return false;
	}

	//var regStreet = /^[a-zа-яё\s-.]{1}[a-zа-яё\s-.]*[a-zа-яё]{1}$/i;
	var streetPatternMatch = regCity.test(street);
	if(streetPatternMatch == false){
		
		alert("не корректное название улицы");
		return false;
	}
	var regNumberHause = /^[\d]+[a-z0-9\s-\\]*[a-z0-9]*$/i;
	var numberHausePatternMatch = regNumberHause.test(numberHause);
	if(numberHausePatternMatch == false){
		
		alert("не корректный ввод номера дома");
		
		return false;
	}

    return true;
	
 }

</script> 
  

       
</body>
</html>