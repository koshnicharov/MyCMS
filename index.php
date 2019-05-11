<?php
    $Title = 'Начална страница';
?>

<?php include('html/header.php'); ?>

<?php
    
    if(!empty($_GET['page'])){
        
        $page = toID($_GET['page']);
        
    }else{
        
        $page = 1;
        
    }
    
?>

<h1>Блог</h1>
<hr>
<br>

<?php
    
    $blogPosts = fetchData('blog', $page);
    
    if(!empty($blogPosts)){
        
        displayContent($blogPosts);
        
        pagination('blog', 'index.php');
        
    }else{
        echo 'Няма налични публикации';
    }
    
?>

<?php include('html/footer.php'); ?>