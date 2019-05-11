<?php
    $Title = 'Администраторски панел';
?>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/html/header.php'); ?>

<?php
    
    if(!loginAdmin()){
        
        refresh('../login.php');
        
    }
    
?>

<div class="column5">
    <h1><?php echo $Title; ?></h1>
    <p>От тука можете да управлявате съдържанието на сайта.</p>
    
</div><!-- End .column5 -->

<?php include($_SERVER['DOCUMENT_ROOT'] . '/html/footer.php'); ?>