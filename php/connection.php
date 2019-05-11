<?php
	$Host = 'localhost';
	$Username = 'root';
	$Password = '';
	$Database = 'cms';

	$db = new mysqli($Host, $Username, $Password, $Database);

	if($db->connect_error){
		
		die($db->connect_error);
		
	}
	
	