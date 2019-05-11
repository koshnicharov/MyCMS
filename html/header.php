<!DOCTYPE html>
<html>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/php/core.php'); ?>
<head>
<link rel="shortcut icon" type="image/png" href="<?php echo basicLink() . '/'; ?>img/favicon.png">
<link rel="stylesheet" type="text/css" href="<?php echo basicLink() . '/'; ?>css/design.css">
<meta http-equiv="content-type" content="text/html" charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="">
<title><?php echo $Title; ?></title>
</head>
<body>
<div class="container">

<div id="heading" class="row">
<div id="logo" class="column3">
	<a href="index.php">
		<img src="<?php echo basicLink() . '/'; ?>img/logo.png" alt="Лого">
		<h5>CMS система</h5>
	</a>
</div><!-- End .column3 -->
<div id="search-area" class="column2 right">
<form method="POST" action="<?php echo basicLink(); ?>/search.php" autocomplete="off">
	<input type="text" name="search-input" id="search-input" placeholder="Търсене по ключови изрази">
	<input type="submit" value="OK" name="search-button" id="search-button">
</form>
</div><!-- End .column2 -->
</div><!-- End .row -->

<div id="nav" class="row">
<div id="navigation" class="column3">

<ul class="navigation">
<?php
	if(getFolderName(getURL()) == 'adm'){
?>
	<li><a href="index.php" id="index-link">Начало</a></li>
	<li><a href="posts.php" id="posts-link">Публикации</a></li>
	<li><a href="pages.php" id="pages-link">Страници</a></li>
<?php		
	}else{
?>
	
	<li><a href="index.php" id="index-link">Начало</a></li>
	
	<?php
		if(!empty($NavigationItems)){
			foreach($NavigationItems as $navItem){
				
	?>
	
	<li><a href="page.php?id=<?php echo $navItem['id'] ?>" id="index-link"><?php echo $navItem['title'] ?></a></li>
	
	<?php
			
			}
		}
	?>
<?php
		
	}
?>
</ul>

</div><!-- End .column3 -->
<div id="action" class="column2">

<ul class="navigation right-nav">
<?php
	if(getFolderName(getURL()) == 'adm'){
?>

<?php		
	}else{
		
		if(isLoggedIn()){
?>
	<li><a href="profile.php" id="login-link">Моят профил</a></li>
	<li><a href="logout.php" id="login-link">Изход</a></li>
<?php
		}else{
?>
	<li><a href="login.php" id="login-link">Вход / Регистрация</a></li>
<?php
		}
	}
?>
</ul>

</div><!-- End .column2 -->
</div><!-- End .row -->

<div class="row">