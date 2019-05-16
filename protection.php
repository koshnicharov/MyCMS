<?php
    $Title = 'Таен въпрос / таен отговор';
	include('html/header.php'); ?>

<?php
    
    if(!isLoggedIn()){
        refresh();
    }
    
?>

<div class="column3">
<h1><?php echo $Title; ?></h1>

<?php
    
    $oldQuestion = $UserData['question'];
    $newQuestion = $oldQuestion;
    
    if(!empty($_POST['update-btn'])){
        
        $oldAnswer = validate($_POST['secret-answer']);
        $newQuestion = validate($_POST['new-question']);
        $newAnswer = validate($_POST['new-answer']);
        
    }else{
        $oldAnswer = '';
        $newAnswer = '';
    }
    
?>

<form method="POST" action="" onsubmit="">
<?php
    
    displayLabel('Таен въпрос');
    
    echo '<span id="display-question">';
    echo $oldQuestion;
    echo '</span>';
    echo "\n";
    
    displayLabel('Таен отговор', 'secret-answer');
    displayField('secret-answer', $oldAnswer);
    
    displayLabel('Нов таен въпрос', 'new-question');
    displayField('new-question', $newQuestion);
    
    displayLabel('Нов таен отговор', 'new-answer');
    displayField('new-answer', $newAnswer);
    
?>
<input type="submit" name="update-btn" id="update-btn" value="Обнови">
</form>
<?php
    
    if(!empty($_POST['update-btn'])){
        
        if(length($oldAnswer, 128, 3) &&
           length($newQuestion, 128, 3) && length($newAnswer, 128, 3)){
            
            $oldAnswer = hashing($oldAnswer);
            
            if($oldAnswer == $UserData['answer']){
                
                $newAnswer = hashing($newAnswer);
                
                updateUserData('question', $newQuestion);
                updateUserData('answer', $newAnswer);
                
                refresh('profile.php');
                
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