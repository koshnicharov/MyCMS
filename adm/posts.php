<?php
    $Title = 'Публикации';
?>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/html/header.php'); ?>

<?php
    
    if(loginAdmin()){
        
        $adminID = $UserData['id'];
        
    }else{
        
        refresh('../login.php');
        
    }
    
    if(!empty($_GET['page'])){
        
        $page = toID($_GET['page']);
        
    }else{
        
        $page = 1;
        
    }
    
    if(!empty($_GET['id'])){
        
        $editID = toID($_GET['id']);
        
    }else{
        
        $editID = 0;
        
    }
    
    if(!empty($_GET['del'])){
        
        $deleteID = toID($_GET['del']);
        
        $queryString = "SELECT * FROM blog WHERE id = '$deleteID' LIMIT 1";
        $query = mysqli_query($db, $queryString);
        $results = mysqli_num_rows($query);
        
        if($results == 1){
            
            $queryString = "DELETE FROM blog WHERE id = '$deleteID' LIMIT 1";
            mysqli_query($db, $queryString);
            
        }
        
        refresh('posts.php');
        
    }else{
        
        $deleteID = 0;
        
    }
    
?>

<div class="column2">
<?php
if($editID > 0){
    
?>
<span>Редактиране на публикацията</span>
<form method="POST" action="" onsubmit="">
<?php
    
    $queryString = "SELECT * FROM blog WHERE id = '$editID' LIMIT 1";
    $query = mysqli_query($db, $queryString);
    $results = mysqli_num_rows($query);
    
    if($results == 1){
        
        $array = mysqli_fetch_array($query);
        
        $title = $array['title'];
        $content = $array['content'];
        
    }else{
        
        refresh('posts.php');
        
    }
    
    if(!empty($_POST['edit-post'])){
        
        $title = validate($_POST['edit-title']);
        $content = validate($_POST['edit-content']);
    }
    
    displayLabel('Заглавие', 'edit-title');
    displayField('edit-title', $title);
    
    displayLabel('Съдържание', 'edit-content');
    displayTextArea('edit-content', $content);
    
?>
<input type="submit" name="edit-post" id="edit-post" value="Редактирай">
<?php
    
    if(!empty($_POST['edit-post'])){
        
        if(!empty($title) && !empty($content)){
            
            $queryString = "UPDATE blog SET
            title = '$title',
            content = '$content',
            editdate = NOW()
            WHERE id = '$editID' LIMIT 1";
            
            mysqli_query($db, $queryString);
            
            refresh('posts.php');
            
        }else{
            echo 'Трябва да попълните всички полета.';
        }
        
    }
    
?>
</form>
<?php
}else{
?>
<span>Публикуване в блога</span>
<form method="POST" action="" onsubmit="">
<?php
    
    if(!empty($_POST['new-post'])){
        
        $title = validate($_POST['new-title']);
        $content = validate($_POST['new-content']);
        
    }else{
        
        $title = '';
        $content = '';
        
    }
    
    displayLabel('Заглавие', 'new-title');
    displayField('new-title', $title);
    
    displayLabel('Съдържание', 'new-content');
    displayTextArea('new-content', $content);
    
?>
<input type="submit" name="new-post" id="new-post" value="Публикувай">
<?php
    
    if(!empty($_POST['new-post'])){
        
        if(!empty($title) && !empty($content)){
            
            $queryString = "INSERT INTO blog
            (uid, title, content, publishdate) VALUES
            ('$adminID', '$title', '$content', NOW())";
            
            mysqli_query($db, $queryString);
            
            refresh('posts.php');
            
        }else{
            echo 'Трябва да попълните всички полета.';
        }
        
    }
    
?>
</form>
<?php
}
?>
</div><!-- End .column2 -->

<div class="column3">
<h1><?php echo $Title; ?></h1>
<hr>
<br>
<?php
    
    $blogPosts = fetchData('blog', $page);
    
    if(!empty($blogPosts)){
        
        displayContent($blogPosts, true);
        
        pagination('blog', 'posts.php');
        
    }else{
        echo 'Няма налични публикации';
    }
    
?>
</div><!-- End .column3 -->

<?php include($_SERVER['DOCUMENT_ROOT'] . '/html/footer.php'); ?>