<?php
    $Title = 'Възстановяване на паролата';
?>

<?php include('html/header.php'); ?>

<?php
    
    if(!empty($_GET['url'])){
        
        $url = validate($_GET['url']);
        
        if(!empty($url)){
            
            $queryString = "SELECT * FROM recover WHERE url = '$url' LIMIT 1";
            $query = mysqli_query($db, $queryString);
            $results = mysqli_num_rows($query);
            
            if($results == 1){
                
                $array = mysqli_fetch_array($query);
                
                $uid = $array['uid'];
                
                $queryString = "SELECT * FROM users WHERE id = '$uid' LIMIT 1";
                $query = mysqli_query($db, $queryString);
                $results = mysqli_num_rows($query);
                
                if($results == 1){
                    
                    $array = mysqli_fetch_array($query);
                    
                    $userID = $array['id'];
                    $userEmail = $array['email'];
                    
                }else{
                    refresh();
                }
                
            }else{
                refresh();
            }
            
        }else{
            refresh();
        }
        
    }else{
        refresh();
    }
    
?>

<div class="column3">
<h1><?php echo $Title; ?></h1>

<form method="POST" action="" onsubmit="">
<?php
    
    displayLabel('Нова парола', 'new-password');
    displayField('new-password', '', 'password');
    
    displayLabel('Повтори новата парола', 'repeat-password');
    displayField('repeat-password', '', 'password');
    
?>
<input type="submit" name="update-btn" id="update-btn" value="Обнови">
</form>
<?php
    
    if(!empty($_POST['update-btn'])){
        $newPassword = validate($_POST['new-password']);
        $repeatPassword = validate($_POST['repeat-password']);
        
        if(length($newPassword, 128, 3) && length($repeatPassword, 128, 3) &&
           ($newPassword == $repeatPassword)){
            
            $newPassword = hashing($newPassword, $userEmail);
            
            $queryString = "UPDATE users SET password = '$newPassword' WHERE id = '$userID' LIMIT 1";
            
            if(mysqli_query($db, $queryString)){
                
                $queryString = "DELETE FROM recover WHERE uid = '$userID' LIMIT 1";
                mysqli_query($db, $queryString);
                
                refresh('login.php');
                
            }else{
                echo 'Неуспешна заявка.';
            }
            
        }else{
            echo 'Възникна проблем при обновяването на посочената информация.';
        }
        
    }
    
?>
</div><!-- End .column3 -->
<div class="column2">

</div><!-- End .column2 -->

<?php include('html/footer.php'); ?>