<?php
	include 'Report.php';
	include 'Table.php';
	$latex = new Report("article", "First Latex File", "2/10/2017", "Phan Cuong");
	$latex->addUsePackage("graphicx");
	$latex->addUsePackage("multirow");
	$latex->addUsePackage("hhline");
	$latex->addUsePackage("longtable");
	$latex->addSection("First section");
	$latex->addSubsection("First subsection");
	$latex->addParagraph("Hello World 1");
	$latex->addSubsection("Second subsection");
	$latex->addSection("Second section");
	$latex->addFigure("h", "centering", "10cm", "/home/phancuong/Latex_Files/trasua.jpg", "Tra Sua", "");
	
	$table = new Table("|r|r|r|");
	$table->addHorizontalLine();
	for ($i=0; $i < 10; $i++) { 
		$rowloop = array("Hoang Van A", "Nguyen Van B", "Nguyeen Thi C");
		$table->addRow($rowloop);
		$table->addHorizontalLine();
	}
	$row = array("Phan Manh Cuong", "Cuong Phan");
	$mergedColumns = array(array(1, 2, "|c|"));
	$table->addRowWithMergedColumns($row, $mergedColumns);
	$table->addHorizontalLine();
	$row1 = array("merged row", "2", "3");
	$row2 = array("", "4", "5");
	$table->addMergedRow($row1, 1, 2);
	$table->addhhLine(1, 3);
	$table->addRow($row2);
	$table->addHorizontalLine();
	$latex->addLongTable($table);
	$latex->createLatexFile("latex.tex");
	$latex->createPdfFile("latex.tex");
?>