<?php
    $Title = 'Преглед страница';
?>

<?php include('html/header.php'); ?>

<?php
    
    if(!empty($_GET['id'])){
        
        $pageID = toID($_GET['id']);
        
    }else{
        
        $pageID = 0;
        
    }
    
?>

<div class="column3">

<?php
    
    $queryString = "SELECT * FROM pages WHERE id = '$pageID' LIMIT 1";
    $query = mysqli_query($db, $queryString);
    $results = mysqli_num_rows($query);
    
    if($results == 1){
        
        $array = mysqli_fetch_array($query);
        
        $title = $array['title'];
        $content = $array['content'];
        
        $content = newLinestoHTML($content);
?>

<h1><?php echo $title; ?></h1>

<hr>
<br>

<p><?php echo $content; ?></p>

<?php
    }else{
        
        echo 'Тази страница не съществува.';
        
    }
    
?>

</div><!-- .column3 -->

<div class="column2">
<form method="POST" action="">
<?php
    
    displayLabel('Търсачка', 'search-field');
    displayField('search-field');
    
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