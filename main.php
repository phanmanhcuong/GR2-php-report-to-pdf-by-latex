<?php
	include 'Report.php';
	include 'Table.php';
	$latex = new Report("article", "First Latex File", "2/10/2017", "Phan Cuong");
	$latex->addSection("First section");
	$latex->addSubsection("First subsection");
	$latex->addParagraph("Hello World 1");
	$latex->addSubsection("Second subsection");
	$latex->addSection("Second section");
	$latex->addParagraph("Hello World 2\\\\");
	$latex->addFigure("p", "centering", "10cm", "/home/phancuong/Latex_Files/trasua.jpg", "Tra Sua", "");
	
	$table = new Table("|r|r|r|");
	$row1 = array("1", "2", "3");
	$row2 = array("4", "5", "6");
	$table->addHorizontalLine();
	$table->addRow($row1);
	$table->addPartialHorizontalLine("1", "2");
	$table->addRow($row2);
	$table->addHorizontalLine();
	
	$latex->addTable($table);
	$latex->createLatexFile("/home/phancuong/Latex_Files/latex.tex");
	$latex->createPdfFile("/home/phancuong/Latex_Files/latex.tex");
?>