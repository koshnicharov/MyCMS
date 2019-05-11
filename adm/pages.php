<?php
    $Title = 'Страници';
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
        
        $queryString = "SELECT * FROM pages WHERE id = '$deleteID' LIMIT 1";
        $query = mysqli_query($db, $queryString);
        $results = mysqli_num_rows($query);
        
        if($results == 1){
            
            $queryString = "DELETE FROM pages WHERE id = '$deleteID' LIMIT 1";
            mysqli_query($db, $queryString);
            
        }
        
        refresh('pages.php');
        
    }else{
        
        $deleteID = 0;
        
    }
    
?>

<div class="column2">
<?php
if($editID > 0){
    
?>
<span>Редактиране на страницата</span>
<form method="POST" action="" onsubmit="">
<?php
    
    $queryString = "SELECT * FROM pages WHERE id = '$editID' LIMIT 1";
    $query = mysqli_query($db, $queryString);
    $results = mysqli_num_rows($query);
    
    if($results == 1){
        
        $array = mysqli_fetch_array($query);
        
        $title = $array['title'];
        $content = $array['content'];
        
    }else{
        
        refresh('pages.php');
        
    }
    
    if(!empty($_POST['edit-page'])){
        
        $title = validate($_POST['edit-title']);
        $content = validate($_POST['edit-content']);
    }
    
    displayLabel('Заглавие', 'edit-title');
    displayField('edit-title', $title);
    
    displayLabel('Съдържание', 'edit-content');
    displayTextArea('edit-content', $content);
    
?>
<input type="submit" name="edit-page" id="edit-page" value="Редактирай">
<?php
    
    if(!empty($_POST['edit-page'])){
        
        if(!empty($title) && !empty($content)){
            
            $queryString = "UPDATE pages SET
            title = '$title',
            content = '$content',
            editdate = NOW()
            WHERE id = '$editID' LIMIT 1";
            
            mysqli_query($db, $queryString);
            
            refresh('pages.php');
            
        }else{
            echo 'Трябва да попълните всички полета.';
        }
        
    }
    
?>
</form>
<?php
}else{
?>
<span>Публикуване на станица</span>
<form method="POST" action="" onsubmit="">
<?php
    
    if(!empty($_POST['new-page'])){
        
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
<input type="submit" name="new-page" id="new-page" value="Публикувай">
<?php
    
    if(!empty($_POST['new-page'])){
        
        if(!empty($title) && !empty($content)){
            
            $queryString = "INSERT INTO pages
            (uid, title, content, publishdate) VALUES
            ('$adminID', '$title', '$content', NOW())";
            
            mysqli_query($db, $queryString);
            
            refresh('pages.php');
            
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
    
    $pagesPosts = fetchData('pages', $page);
    
    if(!empty($pagesPosts)){
        
        displayContent($pagesPosts, true);
        
        pagination('pages', 'pages.php');
        
    }else{
        echo 'Няма налични публикации';
    }
    
?>
</div><!-- End .column3 -->

<?php include($_SERVER['DOCUMENT_ROOT'] . '/html/footer.php'); ?>