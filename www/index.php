 <?php session_start();

 header("Content-Type: text/html; charset=utf8");
 

  if(isset($_GET['logout'])){
 	
	unset($_SESSION['user']);
	//session_destroy();
	
	
}
 ?>
<!DOCTYPE html>

<html>

	<head>
        <title>Hello</title>   
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
		 		<span id="contact"><a href="contact.html">contacts</a></span>	
		 		
				
				</div>
			</div>
			<div class="row">				
				<div class="col-md-12 no-float">			
					<div id="slogan_flag_outer">
						<div id="slogan_flag_inner">
							<div id="slogan">заголовок</div>
							<div class="languages" ><img src="images/RussiaFlat.png"  id="russian"/><img src="images/IsraelFlat.png" id="hebrew" /></div>		
						</div>
					</div>

					<div id="muzhik">
						<img src="images/muzhik.jpg" alt="" />
					</div>
	
					
					
						
<?php

 
if(!isset($_SESSION['user'])){
	
	if(isset($_POST['email'])){
		$error = false;
		$errortext = "";
		$email = trim(htmlspecialchars($_POST['email']));
		$password = trim(htmlspecialchars($_POST['password']));
		$len_pass = strlen($password);
		$pass_content = TRUE;
		$pass_content = ctype_alnum($password);
				
		if(empty($email)){
			$error=true;
			$errortext.="Empty email<br/>"	;
		}
	
		if(empty($password)){
			$error=true;
			$errortext.="Empty password<br/>"	;
		}
		
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
		
		if($pass_content == FALSE){
			$error=true;
			$errortext.="password  must contain only letters of the Latin alphabet and (or) numbers<br/>"	;
		}
		
		if($len_pass< 6){
			$error=true;
			$errortext.="Passwod can not be shorter than 6 characters<br/>";
			
		}
		
		if($error){	
			echo "Errors:<br/>".$errortext;
		}	
		else{
			/*foreach($_POST as $key=>$value){
			
				echo $key."-".$value."<br/>";
			}*/	
			if($email=="vova@gmail.com" && $password=="veles1"){
				echo "Producer access";
			}	
		    elseif($email=="bramnik@zahav.net.il" && $password=="mashamasha"){
				echo "Full access";	
			}
			else{
				echo "User access <br/>";
			}
			
			$mysqli = new mysqli("localhost", "root", "1234", "sohen");
			if($mysqli->connect_errno){
				echo "MySQL database conncetion failed - (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;//каждый раз?
			}
			else{
				mysqli_set_charset($mysqli,'utf8');
				$result = $mysqli->query("SELECT shopName FROM user WHERE email='".$email."' AND password='".$password."'");
				if($result->num_rows > 0){
					$row = $result->fetch_row();
								  		
					$_SESSION['user']=$row[0];
					
					if(isset($_SESSION['registr'])){					
					unset($_SESSION['registr']);//опускаем флаг который был поднят после успешной регистрации;						
					}
								
					if($_SESSION['flag']){
						unset($_SESSION['flag']);//опускаем флаг после неудачной попытки авторизации;
					}
					header("Location: second.php");

				}
				else{
	                //поднимаем  в $_SESSION специальный 'flag' чтобы отметить что была неудачная попытка авторизироваться и нужно специальное сообщение;
                    $_SESSION['flag']= TRUE;
                    
                    if(isset($_SESSION['registr'])){					
					unset($_SESSION['registr']);//опускаем флаг который был поднят после успешной регистрации;						
					}
					
                    header("Location:http://Sohen.ru/index.php");
                    exit();
                      
				}								
			}
		}
	}
	
	else{	
?>	
<p id="echo_registr_successfully"><?php if(isset($_SESSION['registr'])) {
	echo "Вы успешно зарегистрированы , теперь войдите ";
}
?>
</p>
					<div class="blockEntry">
						
						<div class="blockEntryTop ">					
						
							<form id="log_in" action="index.php" method="post" onsubmit='return ValidateAuth()' >
								<input type="email" class="entry" id="email"  name="email" required="required" placeholder="E_MAIL"/>
								<input type="password" class="entry"id="password"  name="password" required="required" placeholder="PASSWORD"/>
								<input type="submit"value="SUBMIT" class="entry" id="log_in_submit" />
							</form>	
								
							
							
							
						</div>
						<div class="blockEntryBottom">
							<input type="button" class="entryBottom"  value="Я ЗАШЕЛ ПЕРВЫЙ РАЗ" onclick="location.href='registr.php'"/>
							<input type="button" class="entryBottom"  value="Я ЗАБЫЛ СВОЙ ПАРОЛЬ"/>
						</div>
						</div>
				<p id= "str_index_echo_problem"><?php if(isset($_SESSION['flag']))	{
					
					echo "Вы ввели неверный имейл или пароль";
					}    
?> 
				</p>		
					
<?php
	}
}

?>	

				
			</div>				
							
			</div>
			<div class="row" id="footer">
				<div class="no-float">
	       			<p id="footer_text">
						copyright 2017
	        		</p>
				</div>
			</div>
		</div>
	<!-- End CONTENT -->
	
	
<script type="text/javascript">
 function ValidateAuth(){

	var email = document.getElementById('email').value;
	var password = document.getElementById('password').value;
   


	if(email==''){
	
 		alert("Поле E-mail пустое");	
	    return false;
	}

	if(password==''){
	
		alert("Введите пароль");
		return false;
	}
	if(password.length < 6){
		
		alert("Пароль слишком короткий ");
		return false;
	}
    	if(password.length > 20){
;		
		alert("Пароль слишком длинный ");
		return false;
	}


	var regPass = /[A-Z-a-z-0-9]/g;
	var passPatternMatch = regPass.test(password);
	
	if(passPatternMatch == false){

		alert(" Пароль может содержать только буквы латинского алфавита и (или) цифры ");
		return false;
	}


	
	//var regEmail = /^[a-z0-9\-\_\.]+@[a-z0-9\-]+\.[a-z\.]*$/isu;//почему-то вообще не работает с /su;
	var regEmail = /^[a-z0-9\-\_\.]+@[a-z0-9\-]+\.[a-z\.]*$/i;
	var emailPatternMatch = regEmail.test(email);
	if(emailPatternMatch == false){
		
		alert("Не корректный адрес E-mail ");
		return false;
	}

    return true;
	
 }

</script>
    </body>
</html>