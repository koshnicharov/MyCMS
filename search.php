<?php
    $Title = 'Търсене по ключови думи/изрази';
?>

<?php include('html/header.php'); ?>

<?php
    
    if(!empty($_GET['page'])){
        
        $page = toID($_GET['page']);
        
    }else{
        
        $page = 1;
        
    }
    
    if(!empty($_GET['search-input'])){
        
        $search = validate($_GET['search-input']);
        
    }else{
        
        $search = '';
        
    }
    
    if(!empty($_POST['search-input'])){
        
        $search = validate($_POST['search-input']);
        
        refresh('search.php?search-input=' . $search);
        
    }
    
?>

<div class="column3">
    


<h1><?php echo $Title; ?></h1>
<hr>
<br>

<?php
    
    $blogPosts = fetchData('blog', $page, $search);
    
    if(!empty($blogPosts)){
        
        displayContent($blogPosts);
        
        pagination('blog', 'search.php', $search);
        
    }else{
        echo 'Няма налични публикации';
    }
    
?>

</div><!-- .column3 -->

<div class="column2">
<form method="POST" action="">
<?php
    
    displayLabel('Търсачка', 'search-field');
    displayField('search-field', $search);
    
?>
<input type="submit" value="Търсене">
<?php
    
    
    if(!empty($_POST)){

    
        if(!empty($_POST['search-field'])){
            
            $search = validate($_POST['search-field']);
            
            refresh('search.php?search-input=' . $search);
            
        }else{
            
            echo 'Не сте въвели ключов израз';
            
        }
        
    }
?>
</form>
</div><!-- .column2 -->

<?php include('html/footer.php'); ?>