<?php
	include 'Table.php';
	$table = new Table("|r|c|r|");
	$row1 = array("1", "2", "3");
	$row2 = array("4", "5", "6");
	$table->addRow($row1);
	$table->addRow($row2);
	printf($table->rowCollection);
?>