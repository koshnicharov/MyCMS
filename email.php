<?php
    $Title = 'Смяна на електронната поща';
	include('html/header.php'); ?>

<?php
    
    if(!isLoggedIn()){
        refresh();
    }
    
?>

<div class="column3">
<h1><?php echo $Title; ?></h1>

<form method="POST" action="" onsubmit="">
<?php
    
    displayLabel('Нова електронна поща', 'email');
    displayField('email', $UserData['email']);
    
    displayLabel('Парола за потвърждение', 'password');
    displayField('password', '', 'password');
    
?>
<input type="submit" name="update-btn" id="update-btn" value="Обнови">
</form>
<?php
    
    if(!empty($_POST['update-btn'])){
        $newEmail = validate(toKey($_POST['email']));
        $password = validate($_POST['password']);
        
        if(length($newEmail, 256, 3) && length($password, 128, 3) &&
           validEmail($newEmail) && isUnique($newEmail, 'email')){
            
            $oldPassword = hashing($password, $UserData['email']);
            $newPassword = hashing($password, $newEmail);
            if($oldPassword == $UserData['password']){
                
                updateUserData('email', $newEmail);
                $_SESSION['email'] = $newEmail;
                
                updateUserData('password', $newPassword);
                $_SESSION['password'] = $newPassword;
                
                refresh('profile.php');
            }else{
                echo 'Отказан достъп.';
            }
        }else{
            echo 'Възникна проблем при обновяването на посочената информация.';
        }
    }
    
?>
</div><!-- End .column3 -->
<div class="column2">
<span>Настройки</span>
<ul class="sidebar">
    <li><a href="details.php">Редактиране на профила</a></li>
    <li><a href="username.php">Смяна на потребителското име</a></li>
    <li><a href="phone.php">Смяна на телефон</a></li>
    <li><a href="email.php">Смяна на електронната поща</a></li>
    <li><a href="password.php">Смяна на паролата</a></li>
    <li><a href="protection.php">Таен въпрос / таен отговор</a></li>
    
</ul>
</div><!-- End .column2 -->

<?php include('html/footer.php'); ?>