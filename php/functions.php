<?php
    
    /*
        
        Тази библиотека от PHP функции е изградена
        от Mario Genchev Koshnicharov (mr.koshnicharov@gmail.com)
        
        
        Тя съдържа често използвани алгоритми, групирани с различни имена.
        
        Кодът лесно може да се поддържа тъй като алгоритмите
        могат да бъдат редактирани единствено от този файл.
        
        Не е неоходимо да се редактират всички станицици.
        
        WordPress има подобна библиотека, но значително по-усложнена.
        
        С този проект целя да се науча да изграждам интернет приложения
        без необходимостта от използване на инструменти. Този начин е твърде
        сложен дори и за сам човек, но въпреки това за кратко време успях
        да създада напълно приложима CSM система.
        
        Подобно на WordPress, този продукт може да бъде използван за
        новинарска система или за личен блог. Но, разбира се, този проект
        не е добър колкото WordPress. Обаче, въпреки това, е стабилна
        основа за надграждане на по-големи IT проекти. ТОзи Framework
        винаги може да бъде доусъвършенстван.
        
        В тази библиотека се поставя акцент върху защитите срещу кибер атаки.
        В нея са включени защити срещу SQL Injection, XSS атакти и други подобни.
        При въвеждането на потребителско име, електронна поща или телефонен
        се ограничава броя и вида на съставящите ги символи.
        
    */
    
    
    
    /*
        Basic Operations
    */
    
    function toBoolean($input){
        
		if($input === true || $input === 1 || $input === 'true' || $input === '1'){
			
            return true;
        
		}else{
			
            return false;
        
		}
	}
	
	function toID($input){
        
		$input = abs(intval($input));
        
		return $input;
    
	}
    
    function validate($input){
		
        global $db;
		$input = trim($input);
		$input = htmlentities($input);
        
		return mysqli_real_escape_string($db, $input);
	}
	
	function noSpaces($input){
		
        $input = str_replace(' ', '', $input);
		$input = preg_replace('/\s+/', '', $input);
        
		return $input;
	}
	
	function toKey($input){
		
        $input = strtolower($input);
		$input = noSpaces($input);
		$input = validate($input);
        
		return $input;
	}
	
	function preventRepeating($input, $characters = array('_')){
		
        $compare = $input;
		
		if(!is_array($characters)){
            
			$characters = array($characters);
            
		}
		
		foreach($characters as $char){
            
			$search = $char . $char;
            
			$input = str_replace($search, $char, $input, $count);
			
			while($input != $compare){
                
				$compare = str_replace($search, $char, $compare, $count);
                
				$input = str_replace($search, $char, $input, $count);
                
			}
		}
        
		
		return $input;
    
	}
    
    /*
        Basic Checks
    */
    
    function length($input, $max, $min = 0){
        
        $max = toID($max);
        $min = toID($min);
        
		if((strlen($input) >= $min) && (strlen($input) <= $max)){
            
			return true;
        
		}else{
            
			return false;
        
		}
	}
	
	function validUsername($input){
		
        if(preg_match("/^[a-z0-9_]+$/", $input)){
            
            if($input == preventRepeating(toKey($input))){
                
				return true;
                
			}else{
                
				return false;
                
			}
        
		}else{
            
			return false;
        
		}
        
	}
	
	function validEmail($input){
		
        if(filter_var($input, FILTER_VALIDATE_EMAIL)){
            
			if($input == toKey($input)){
                
				return true;
                
			}else{
                
				return false;
                
			}
            
		}else{
            
			return false;
        
		}
        
	}
	
	function validPhone($input){
        
		if(preg_match("/^[0-9]+$/", $input)){
            
			return true;
        
		}else{
            
			return false;
        
		}
        
	}
    
    function validLink($input){
        
        if(filter_var($input, FILTER_VALIDATE_URL)){
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
	
	function hasForbiddenCharacters($input){
        
		if(preg_match("/[@]/", $input)){
            
			return true;
        
		}else{
            
			return false;
        
		}
        
	}
    
    /*
        Forms
    */
    
    function displayLabel($title, $for = ''){
        
        echo '<label for="' . $for .'">' . $title .'</label>';
        echo "\n";
        
    }
    
    function displayText($text){
        
        echo '<div class="small-text">';
        echo $text;
        echo '</div>';
        echo "\n";
        
    }
    
    function displayField($name, $value = '', $type = 'text', $autocomplete = 'off'){
        
        echo '<input type="' . $type .
        '" name="' . $name .
        '" id="' . $name .
        '" value="' . $value .
        '" autocomplete="' . $autocomplete . '">';
        echo "\n";
        
    }
    
    function displayTextArea($name, $value = '', $autocomplete = 'off'){
        
        echo '<textarea name="' . $name .
        '" id="' . $name .
        '" autocomplete="' . $autocomplete . '">';
        echo $value;
        echo '</textarea>';
        echo "\n";
        
    }
    
    function birthDateInput(){
        
        $currentYear = date('Y');;
        $months = array('Януари', 'Февруари', 'Март', 'Април', 'Май', 'Юни', 'Юли', 'Август', 'Септемри', 'Октомври', 'Ноември', 'Декември');
        $monthNumber = 1;
        
        echo '<div class="birth-input">';
        echo "\n";
        
        echo '<select name="birth-day">';
        echo "\n";
        
        echo '<option value="">';
        echo 'Ден';
        echo '</option>';
        echo "\n";
        
        for($dayNumber = 1; $dayNumber <= 31; $dayNumber++){
            
            if($dayNumber < 10){
                $dayNumber = "0" . $dayNumber;
            }
            
            echo '<option value="' . $dayNumber . '">';
            echo $dayNumber;
            echo '</option>';
            echo "\n";
            
            $dayNumber = toID($dayNumber);
        }
        
        echo '</select>';
        echo "\n";
        
        echo '<select name="birth-month">';
        echo "\n";
        
        echo '<option value="">';
        echo 'Месец';
        echo '</option>';
        echo "\n";
        
        foreach($months as $month){
            
            if($monthNumber < 10){
                $monthNumber = "0" . $monthNumber;
            }
            
            echo '<option value="' . $monthNumber . '">';
            echo $month;
            echo '</option>';
            echo "\n";
            
            $monthNumber = toID($monthNumber);
            $monthNumber++;
            
        }
        
        echo '</select>';
        echo "\n";
        
        echo '<select name="birth-year">';
        echo "\n";
        
        echo '<option value="">';
        echo 'Година';
        echo '</option>';
        echo "\n";
        
        for($year = $currentYear; $year >= $currentYear - 100; $year--){
            
            echo '<option value="' . $year . '">';
            echo $year;
            echo '</option>';
            echo "\n";
        }
        
        echo '</select>';
        echo "\n";
        
        echo "</div>";
        echo "\n";
    }
    
    function genderInput(){
        
        echo '<div class="gender-input">';
        echo "\n";
        
        echo '<input type="radio" name="gender" value="m" id="m">';
        echo '<label for="m">';
        echo 'Мъж';
        echo '</label>';
        echo "\n";
        
        echo '<input type="radio" name="gender" value="f" id="f">';
        echo '<label for="f">';
        echo 'Жена';
        echo '</label>';
        echo "\n";
        
        echo "</div>";
        echo "\n";
    }
    
    function termsCheckbox(){
        
        echo '<div class="terms-input">';
        echo "\n";
        
        echo '<input type="checkbox" name="terms" id="terms" value="true">';
        echo '<label for="terms">';
        echo 'Съгласявам се с <a href="#">условията</a> за ползване на сайта.';
        echo '</label>';
        echo "\n";
        
        echo '</div>';
        echo "\n";
    }
    
    function validGender($input){
        
        if($input == 'm' || $input == 'f'){
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    function defineGender($input = 'm'){
        
        if($input == 'f'){
            
            return 'Жена';
        
        }else{
            
            return 'Мъж';
        
        }
        
    }
    
    function validateDate($day, $month, $year){
        
        $date = $year . '/' . $month . '/' . $day;
        
        if(!length($date, 12, 8)){
            
            return false;
        
        }
        
        
        $day = toID($day);
        $month = toID($month);
        $year = toID($year);
        
        if($day < 10){
            $day = "0" . $day;
        }
        
        if($month < 10){
            $month = "0" . $month;
        }
        
        $date = $year . '/' . $month . '/' . $day;
        
        return $date;
    }
    
    function basicLink(){
        
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
            
            $protocolName = 'https://';
            
        }else{
            
            $protocolName = 'http://';
            
        }
        
        $domainName = $_SERVER['HTTP_HOST'];
        
        $link = $protocolName . $domainName;
        
        $link = validate($link);
        
        
        return $link;
    }
    
    function getURL(){
        
        $link = basicLink();
        
        $URI = $_SERVER['REQUEST_URI'];
        
        $link = $link . $URI;
        
        $link = validate($link);
        
        
        return $link;
    }
    
    function serverDirectory(){
        
        $serverDirectory = $_SERVER['DOCUMENT_ROOT'];
        
        return $serverDirectory;
        
    }
    
    function getFolderName($URL){
        
        // Папката от най-високо ниво
        
        $URL = validate($URL);
        
        $array = explode("/", $URL);
        
        $elements = count($array) - 2; 
        
        return $array[$elements];
        
    }
    
    function getUserIP(){
        
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            
            $IP = $_SERVER['HTTP_CLIENT_IP'];
            
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            
            $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
            
        }else{
            
            $IP = $_SERVER['REMOTE_ADDR'];
            
        }
        
        return $IP;
        
    }
    
    function refresh($page = 'index.php'){
        
        header('Location: ' . $page);
        die();
        
    }
    
    /*
        Database Operations
    */
    
    function newLinesToHTML($input){
        
        $input = nl2br($input);
        
        return $input;
    }
    
    function getServerDate(){
        
        $date = date('Y/m/d');
        
        return $date;
    }
    
    function getServerTime(){
        
        $time = date('H:i:s');
        
        return $time;
    }
    
    function getServerDateTime(){
        
        $dateAndTime = getServerDate() . '-' . getServerTime();
        
        return $dateAndTime;
    }
    
    function hashing($password, $email = "user_email-1997@example.com"){
        
		$password = "Za" . $email . $password . "97!";
        
		$password = strrev($password);
        
		$password = $email . $password;
        
        $password = str_rot13($password);
        
        $password = strrev($password);
		$password = 'f4' . $password . 'b2';
		$password = strrev($password);
        
		$password = $email . $password;
        
		$password = hash('sha512' , $password);
        
		$password = strrev($password);
		$password = '1a' . $password;
		$password = strrev($password);
        
		return $password;
        
	}
    
    function randomString($useServerTime = true){
        
        $random = 'Numbers';
        
        if($useServerTime == true){
            $random = 'DateTime:' . getServerDateTime() . ';Numbers';
        }
        
        $random = $random . '_';
        $random = $random . rand(1,9);
        $random = $random . rand(100,999);
        $random = $random . rand(100,999);
        $random = $random . rand(100,999);
        $random = $random . rand(100,999);
        
        return $random;
    }
    
    function isUnique($name, $dbColumn = 'email', $dbTable = 'users'){
        global $db;
        $name = validate($name);
        $dbColumn = toKey($dbColumn);
        $dbTable = toKey($dbTable);
        
        $queryString = "SELECT * FROM " . $dbTable .
        " WHERE " . $dbColumn . " = '$name' LIMIT 1";
        
        $query = mysqli_query($db, $queryString);
        
        $results = mysqli_num_rows($query);
        
        if($results == 0){
            
            return true;
            
        }else{
            
            return false;
            
        }
    }
    
    function login($email, $password){
        global $db;
        $email = validate($email);
        $password = validate($password);
        
        $queryString = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
        
        $query = mysqli_query($db, $queryString);
        
        $results = mysqli_num_rows($query);
        
        if($results == 1){
            
            return true;
            
        }else{
            
            return false;
            
        }
    }
    
    function logout(){
        
        session_destroy();
        
    }
    
    function isLoggedIn(){
        
        if(!empty($_SESSION['email']) && !empty($_SESSION['password'])){
            
            $email = validate($_SESSION['email']);
            $password = validate($_SESSION['password']);
            
            global $db;
            $queryString = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
            
            $query = mysqli_query($db, $queryString);
            
            $results = mysqli_num_rows($query);
            
            if($results == 1){
                
                return true;
            
            }else{
                
                return false;
                
            }
            
        }else{
            
            return false;
            
        }
    }
    
    function getUID($email){
        global $db;
        $email = validate($email);
        
        $queryString = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        
        $query = mysqli_query($db, $queryString);
        
        $results = mysqli_num_rows($query);
        
        if($results == 1){
            
            $array = mysqli_fetch_array($query);
            
            return $array['id'];
            
        }else{
            
            return false;
            
        }
            
    }
    
    function getUserData(){
        
        if(isLoggedIn()){
            $email = validate($_SESSION['email']);
            $password = validate($_SESSION['password']);
            
            global $db;
            $queryString = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
            $query = mysqli_query($db, $queryString);
            $results = mysqli_num_rows($query);
            
            if($results == 1){
                
                $array = mysqli_fetch_array($query);
                
                return $array;
            
            }else{
                
                return false;
                
            }
            
        }else{
            
            return false;
            
        }
    }
    
    function updateUserData($dbColumn, $newValue){
        global $db;
        $newValue = validate($newValue);
        $dbColumn = toKey($dbColumn);
        
        if(isLoggedIn()){
            
            $UserData = getUserData();
            $UserID = $UserData['id'];
            
            $queryString = "UPDATE users SET " .
            $dbColumn . " = '$newValue' WHERE id = '$UserID' LIMIT 1";
            
            if(mysqli_query($db, $queryString)){
                
                return true;
            
            }
        }
        
        return false;
    }
    
    function loginAdmin(){
        
        if(isLoggedIn()){
            
            $UserData = getUserData();
            $UserID = $UserData['id'];
            
            global $db;
            $queryString = "SELECT * FROM administration WHERE uid = '$UserID' LIMIT 1";
            $query = mysqli_query($db, $queryString);
            $results = mysqli_num_rows($query);
            
            if($results == 1){
                
                return true;
            
            }
        }
        
        return false;
    }
    
    function sendAnEmail($to, $message, $subject = 'Възстановяване на паролата', $headers = ''){
        
        /*
            Mail Server Required
        */
        
        $headers = 'From: webmaster@example.com';
        $headers = $headers . "\r\n";
        $headers = $headers . 'Reply-To: webmaster@example.com';
        $headers = $headers . "\r\n";
        $headers = $headers . 'X-Mailer: PHP/';
        $headers = $headers . phpversion();
        
        $to = validate($to);
        $subject = validate($subject);
        $message = validate($message);
        
        mail($to, $subject, $message, $headers);
        
    }
    
    function fetchData($dbTable, $page = false, $search = '', $limit = 5){
        
        $search = validate($search);
        $dbTable = toKey($dbTable);
        $page = toID($page);
        $limit = toID($limit);
        
        if($page == 0){
            
            $sql = "SELECT * FROM " .
            $dbTable .
            " WHERE title LIKE '%" .
            $search .
            "%' OR content LIKE '%" .
            $search . "%'" .
            " ORDER BY id DESC LIMIT " . $limit;
            
        }else{
            
            $page = $page - 1;
            $start = $page * $limit;
            
            $sql = "SELECT * FROM " .
            $dbTable .
            " WHERE title LIKE '%" .
            $search .
            "%' OR content LIKE '%" .
            $search .
            "%'" . " ORDER BY id DESC LIMIT " .
            $start . ", " . $limit;
            
        }
        
        global $db;
        $query = mysqli_query($db, $sql);
        $results = mysqli_num_rows($query);
        
        if($results > 0){
            
            $array = array();
            
            while($row = mysqli_fetch_array($query)){
                
                array_push($array, $row);
                
            }
            
            return $array;
        
        }
        
        return false;
    }
    
    function displayContent($array, $edit = false){
        
        if(is_array($array)){
            
            echo '<div class="db-content">';
            echo "\n";
            
            foreach($array as $row){
                
                echo '<div class="post-row">';
                echo "\n";
                
                echo '<span>';
                echo $row['title'];
                echo '</span>';
                echo '<br>';
                echo "\n";
                
                echo '<p>';
                echo newLinesToHTML($row['content']);
                echo '</p>';
                echo '<br>';
                echo "\n";
                
                if($edit == true){
                    
                    echo '<ul class="navigation" id="options">';
                    echo "\n";
                    
                    echo '<li>';
                    echo '<a href="?id=' . $row['id'] . '">';
                    echo 'Редактиране';
                    echo '</a>';
                    echo '</li>';
                    echo "\n";
                    
                    echo '<li>';
                    echo '<a href="?del=' . $row['id'] . '">';
                    echo 'Изтриване';
                    echo '</a>';
                    echo '</li>';
                    echo "\n";
                    
                    echo '</ul">';
                    
                }
                
                echo '</div>';
                echo "\n";
                
            }
            
            echo '</div>';
            echo "\n";
            
        }
        
    }
    
    function pagination($dbTable = 'blog', $link = "index.php", $search = '', $limit = 5){
        
        $limit = toID($limit);
        $search = validate($search);
        $dbTable = toKey($dbTable);
        $link = toKey($link);
        
        global $db;
        $sql = "SELECT * FROM " .
        $dbTable .
        " WHERE title LIKE '%" .
        $search .
        "%' OR content LIKE '%" .
        $search .
        "%'";
        $query = mysqli_query($db, $sql);
        $results = mysqli_num_rows($query);
        
        $pages = ceil($results / $limit);
        $remaining = $pages % $limit;
        
        if($pages > 1){
            
            if(!empty($search)){
                $search = '&search-input=' . $search;
            }
            
            echo '<div class="pagination">';
            echo "\n";
            
            echo '<ul class="pagination-list">';
            echo "\n";
            
            for ($p = 1; $p <= $pages; $p++) {
                
                echo '<li>';
                echo "\n";
                
                echo '<a href="' .
                $link . '?page=' . $p . $search . '" id="page' .
                $p .
                '">' .
                $p .
                '</a>';
                echo "\n";
                
                echo '</li>';
                echo "\n";
            
            }
            
            echo '</ul>';
            echo "\n";
            
            echo '</div>';
            echo "\n";
        
        }
        
    }
    
    
    
    
    
    
    
    