<?php
	// Connect to database
	include("../model/connection.php");
	
	//  function to get all the items
	function getAllCastles() //get JSON of records from db
	{
		global $conn;
		$sql = "SELECT * FROM castles";
		$result = mysqli_query($conn, $sql);
		//  convert to JSON
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}
		return json_encode($rows,JSON_INVALID_UTF8_IGNORE);
	}

	function getArticleRecord() //get JSON of records from db
	{
		global $conn;
		$sql = "SELECT * FROM castlearticles"; //execute sql
		$result = mysqli_query($conn, $sql);
		//  convert to JSON
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}
		return json_encode($rows,JSON_INVALID_UTF8_IGNORE);
	}

	function getAssocRecord() //get JSON of records from db
	{
		global $conn;
		$sql = "SELECT * FROM cas_art"; //execute sql
		$result = mysqli_query($conn, $sql);
		//  convert to JSON
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}
		return json_encode($rows,JSON_INVALID_UTF8_IGNORE);
	}

	function getImageRecord() //get JSON of records from db
	{
		global $conn;
		$sql = "SELECT * FROM castleimages";
		$result = mysqli_query($conn, $sql);
		//  convert to JSON
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}
		return json_encode($rows,JSON_INVALID_UTF8_IGNORE);
	}
	
?>