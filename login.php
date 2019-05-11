<?php
    $Title = 'Членство';
?>

<?php include('html/header.php'); ?>

<?php
    
    if(isLoggedIn()){
        refresh();
    }
    
?>

<div class="column2">
<h1>Вход</h1>
<form method="POST" action="" onsubmit="">
<?php
    
    displayLabel('Електронна поща', 'email');
    displayField('email');
    
    displayLabel('Парола', 'password');
    displayField('password', '', 'password');
    
?>
<input type="submit" name="login-btn" id="login-btn" value="Вход">
<a href="recover.php" class="btn" id="recover-btn">Забравена парола</a>
</form>
<?php
    
    if(!empty($_POST['login-btn'])){
        $email = validate(toKey($_POST['email']));
        $password = validate($_POST['password']);
        
        if(length($email, 256, 3) && length($password, 128, 3)){
            $password = hashing($password, $email);
            
            if(login($email, $password)){
                
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                
                refresh();
                
            }else{
                echo 'Отказан достъп. Грешно потребителско име и/или парола.';
            }
            
        }else{
            echo 'Некоректно въведени данни.';
        }
    }
?>
</div><!-- End .column2 -->
<div class="column3">
<h2>Регистрация</h2>
<form method="POST" action="" onsubmit="">
<?php
    
    if(!empty($_POST['register-btn'])){
        $email = validate(toKey($_POST['new-email']));
        $password1 = validate($_POST['new-password']);
        $password2 = validate($_POST['repeat-password']);
        $phone = validate(toKey($_POST['phone']));
        $username = validate(toKey($_POST['new-username']));
        $question = validate($_POST['secret-question']);
        $answer = validate($_POST['secret-answer']);
        $fullname = validate($_POST['fullname']);
        
        if(isset($_POST['gender'])){ $gender = validate($_POST['gender']); }else{ $gender = ""; }
        
        $day = validate($_POST['birth-day']);
        $month = validate($_POST['birth-month']);
        $year = validate($_POST['birth-year']);
        $birthDate = validateDate($day, $month, $year);
        
        if(isset($_POST['terms'])){ $terms = validate($_POST['terms']); }else{ $terms = ""; }
        
    }else{
        $email = '';
        $phone = '';
        $username = '';
        $question = '';
        $answer = '';
        $fullname = '';
    }
    
    
    displayLabel('Електронна поща', 'new-email');
    displayField('new-email', $email);
    
    displayLabel('Парола', 'new-password');
    displayField('new-password', '', 'password');
    
    displayLabel('Повтори въведената парола', 'repeat-password');
    displayField('repeat-password', '', 'password');
    
    displayLabel('Телефонен номер', 'phone');
    displayField('phone', $phone);
    
    displayLabel('Потребителско име', 'new-username');
    displayField('new-username', $username);
    displayText('Допускат се цифри и букви на латиница. Може да се използва и долна черта.');
    
    displayLabel('Таен въпрос', 'secret-question');
    displayField('secret-question', $question);
    
    displayLabel('Таен отговор', 'secret-answer');
    displayField('secret-answer', $answer);
    
    displayLabel('Пълно име', 'fullname');
    displayField('fullname', $fullname);
    
    displayLabel('Пол');
    genderInput();
    
    displayLabel('Дата на раждане');
    birthDateInput();
    
    termsCheckbox();
    
?>
<input type="submit" name="register-btn" id="register-btn" value="Регистрация">
</form>
<?php
    
    if(!empty($_POST['register-btn'])){
        $errors = array();
        
        if(!length($email, 256, 3)){ array_push($errors, "Въведената електронна поща е съставена от недопустим брой символи."); }
        if(!validEmail($email)){ array_push($errors, "Въведената електронна поща е невалидна."); }
        if(!isUnique($email, 'email')){ array_push($errors, "Въведената електронна поща е заета."); }
        
        if(!length($password1, 128, 3)){ array_push($errors, "Въведената парола се състои от недопустим брой символи."); }
        if(!($password1 == $password2)){ array_push($errors, "Паролите не съвпадат. Трябва да повторите паролата, за да я потвърдите."); }
        
        if(!length($username, 32, 3)){ array_push($errors, "Въведеното потребителско име е съставено от недопустим брой символи."); }
        if(!validUsername($username)){ array_push($errors, "Въведеното потребителско име е невалидно."); }
        if(!isUnique($username, 'username')){ array_push($errors, "Въведеното потребителско име е заето."); }
        
        if(!length($phone, 16, 8)){ array_push($errors, "Въведеният телефонен номер е съставен от недопустим брой символи."); }
        if(!validPhone($phone)){ array_push($errors, "Въведеният телефонен номер е невалиден."); }
        if(!isUnique($phone, 'phone')){ array_push($errors, "Въведеният телефонен номер е зает."); }
        
        if(!length($question, 128, 3)){ array_push($errors, "Въведеният въпрос е съставен от недопустим брой символи."); }
        if(!length($answer, 128, 3)){ array_push($errors, "Въведеният отговор е съставен от недопустим брой символи."); }
        
        if(!length($fullname, 64, 3)){ array_push($errors, "Вашето име е съставено от недопустим брой символи."); }
        if(!validGender($gender)){ array_push($errors, "Не сте въвели Вашия пол."); }
        if(!length($birthDate, 16, 8)){ array_push($errors, "Въведената дата на раждане е невалидна."); }
        
        if(empty($terms)){ array_push($errors, "Трябва да се съгласите с условията за ползване на сайта."); }
        
        
        if(empty($errors)){
            
            $username = preventRepeating($username);
            $password = hashing($password1, $email);
            $answer = hashing($answer);
            $registerDate = getServerDateTime();
            
            $queryString = "INSERT INTO users
            (email, password, phone, username, question, answer, fullname, gender, birthdate, registerdate) VALUES
            ('$email', '$password', '$phone', '$username', '$question', '$answer', '$fullname', '$gender', '$birthDate', '$registerDate')";
            
            if(mysqli_query($db, $queryString)){
                
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                
                refresh();
                
            }else{
                echo 'Възникна проблем при регистрирането на данните.';
            }
            
        }else{
            foreach($errors as $error){
                echo $error;
                echo '<br>';
                echo "\n";
            }
        }
            
        
    }
    
?>
</div><!-- End .column3 -->

<?php include('html/footer.php'); ?>