<?php
    $Title = 'Смяна на паролата';
?>

<?php include('html/header.php'); ?>

<?php
    
    if(!isLoggedIn()){
        refresh();
    }
    
?>

<div class="column3">
<h1><?php echo $Title; ?></h1>

<form method="POST" action="" onsubmit="">
<?php
    
    displayLabel('Стара парола', 'old-password');
    displayField('old-password', '', 'password');
    
    displayLabel('Нова парола', 'new-password');
    displayField('new-password', '', 'password');
    
    displayLabel('Повтори новата парола', 'repeat-password');
    displayField('repeat-password', '', 'password');
    
?>
<input type="submit" name="update-btn" id="update-btn" value="Обнови">
</form>
<?php
    
    if(!empty($_POST['update-btn'])){
        $oldPassword = validate($_POST['old-password']);
        $newPassword = validate($_POST['new-password']);
        $repeatPassword = validate($_POST['repeat-password']);
        
        if(length($oldPassword, 128, 3) && length($newPassword, 128, 3) &&
           length($repeatPassword, 128, 3) && ($newPassword == $repeatPassword)){
                
                $oldPassword = hashing($oldPassword, $UserData['email']);
                
                if($oldPassword == $UserData['password']){
                    
                    $newPassword = hashing($newPassword, $UserData['email']);
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