<?php
    $Title = 'Лични данни';
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
    
    displayLabel('Пълно име', 'fullname');
    displayField('fullname', $UserData['fullname']);
    
    displayLabel('Пол');
    genderInput();
    
    displayLabel('Дата на раждане');
    birthDateInput();
    
?>
<input type="submit" name="update-btn" id="update-btn" value="Обнови">
</form>
<?php
    
    if(!empty($_POST['update-btn'])){
        
        $fullname = validate($_POST['fullname']);
        
        if(isset($_POST['gender'])){
            $gender = validate($_POST['gender']);
        }else{
            $gender = "";
        }
        
        $day = validate($_POST['birth-day']);
        $month = validate($_POST['birth-month']);
        $year = validate($_POST['birth-year']);
        $birthDate = validateDate($day, $month, $year);
        
        if(length($fullname, 64, 3)){
            
            updateUserData('fullname', $fullname);
            
        }
        
        if(validGender($gender)){
            
            updateUserData('gender', $gender);
            
        }
        
        if(length($birthDate, 16, 8)){
            
            updateUserData('birthdate', $birthDate);
            
        }
        
        
        refresh('profile.php');
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