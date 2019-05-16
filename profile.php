<?php
    $Title = 'Потребителски профил';
	include('html/header.php'); ?>

<?php
    
    if(!isLoggedIn()){
        refresh();
    }
    
?>

<div class="column3">
<h1><?php echo $Title; ?></h1>

<div class="row">
    <div class="table-left">
        Потребителско име
    </div><!-- End .table-left -->
    <div class="table-right">
        <?php echo $UserData['username']; ?>
    </div><!-- End .table-right -->
</div><!-- End .row -->

<div class="row">
    <div class="table-left">
        Електронна поща
    </div><!-- End .table-left -->
    <div class="table-right">
        <?php echo $UserData['email']; ?>
    </div><!-- End .table-right -->
</div><!-- End .row -->

<div class="row">
    <div class="table-left">
        Телефон
    </div><!-- End .table-left -->
    <div class="table-right">
        <?php echo $UserData['phone']; ?>
    </div><!-- End .table-right -->
</div><!-- End .row -->

<div class="row">
    <div class="table-left">
        Пълно име
    </div><!-- End .table-left -->
    <div class="table-right">
        <?php echo $UserData['fullname']; ?>
    </div><!-- End .table-right -->
</div><!-- End .row -->

<div class="row">
    <div class="table-left">
        Пол
    </div><!-- End .table-left -->
    <div class="table-right">
        <?php echo defineGender($UserData['gender']); ?>
    </div><!-- End .table-right -->
</div><!-- End .row -->

<div class="row">
    <div class="table-left">
        Дата на раждане
    </div><!-- End .table-left -->
    <div class="table-right">
        <?php echo $UserData['birthdate']; ?>
    </div><!-- End .table-right -->
</div><!-- End .row -->

<div class="row">
    <div class="table-left">
        Дата на регистрация
    </div><!-- End .table-left -->
    <div class="table-right">
        <?php echo $UserData['registerdate']; ?>
    </div><!-- End .table-right -->
</div><!-- End .row -->

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