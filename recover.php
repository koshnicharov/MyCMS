<?php
    $Title = 'Възстановяване на достъпа';
?>

<?php include('html/header.php'); ?>

<?php
    
    if(isLoggedIn()){
        refresh();
    }
    
?>

<div class="column3">
<h1>Таен въпрос / таен отговор</h1>

<?php
    
    if(!empty($_POST['recover-password'])){
        
        $email = validate(toKey($_POST['email']));
        
        $question = validate($_POST['secret-question']);
        $answer = validate($_POST['secret-answer']);
        
        $password1 = validate($_POST['new-password']);
        $password2 = validate($_POST['repeat-password']);
        
    }else{
        $email = '';
        $question = '';
        $answer = '';
    }
    
?>

<form method="POST" action="" onsubmit="">
<?php
    
    displayLabel('Електронна поща', 'email');
    displayField('email', $email);
    
    displayLabel('Таен въпрос', 'secret-question');
    displayField('secret-question', $question);
    
    displayLabel('Таен отговор', 'secret-answer');
    displayField('secret-answer', $answer);
    
    displayLabel('Нова парола', 'new-password');
    displayField('new-password', '', 'password');
    
    displayLabel('Повтори новата парола', 'repeat-password');
    displayField('repeat-password', '', 'password');
    
?>
<input type="submit" name="recover-password" id="recover-password" value="Възстанови достъпа">
</form>
<?php
    
    if(!empty($_POST['recover-password'])){
        
        if(length($email, 256, 3) &&
           length($question, 128, 3) && length($answer, 128, 3) &&
           length($password1, 128, 3) && ($password1 == $password2)){
            
            $answer = hashing($answer);
            $password = hashing($password1, $email);
            
            global $db;
            $queryString = "SELECT * FROM users WHERE email = '$email' AND question = '$question' AND answer = '$answer' LIMIT 1";
            $query = mysqli_query($db, $queryString);
            $results = mysqli_num_rows($query);
            
            if($results == 1){
                
                $queryString = "UPDATE users SET password = '$password' WHERE email = '$email' LIMIT 1";
                
                if(mysqli_query($db, $queryString)){
                    
                    refresh('login.php');
                    
                }else{
                    echo 'Неуспешна заявка.';
                }
                
            }else{
                echo 'Отказан достъп';
            }
            
        }else{
            echo 'Некоректно въведени данни.';
        }
        
    }
    
?>
</div><!-- End .column3 -->
<div class="column2">
<h1>Линк за възстановяване</h1>

<?php
    if(!empty($_POST['recover-email'])){
        
        $mail = validate(toKey($_POST['mail']));
        
    }else{
        $mail = '';
    }
?>

<form method="POST" action="" onsubmit="">
<?php
    
    displayLabel('Електронна поща', 'mail');
    displayField('mail', $mail);
    
?>
<input type="submit" name="recover-email" id="recover-email" value="Изпрати имейл">
</form>
<?php
    
    if(!empty($_POST['recover-email'])){
        
        if(length($mail, 256, 3) &&
           validEmail($mail) && !isUnique($mail, 'email')){
            
            $uid = getUID($mail);
            
            $url = randomString();
            $url = $mail . $url;
            $url = hashing($url, $mail);
            
            //$url = 'testing';
            
            $date = getServerDateTime();
            
            $queryString = "SELECT * FROM recover WHERE uid = '$uid' LIMIT 1";
            $query = mysqli_query($db, $queryString);
            $results = mysqli_num_rows($query);
            
            if($results == 0){
                
                $queryString = "INSERT INTO recover (uid, url, date) VALUES ('$uid', '$url', '$date')";
                mysqli_query($db, $queryString);
                
                $link = 'access.php?url=' . $url;
                
                sendAnEmail($mail, $link);
                
                echo 'Успешно генериран линк.';
                
            }else{
                echo 'Спаменето е забранено.';
            }
            
            
        }else{
            echo 'Тази електронна поща не е регистрирана.';
        }
        
    }
    
?>
</div><!-- End .column2 -->

<?php include('html/footer.php'); ?>