<?php
	include 'Report.php';
	include 'Table.php';
	$latex = new Report("article", "First Latex File", "2/10/2017", "Phan Cuong");
	$latex->addUsePackage("graphicx");
	$latex->addUsePackage("multirow");
	$latex->addUsePackage("hhline");
	$latex->addUsePackage("longtable");
	//for vietnamese
	$latex->addUsePackageWithParameter("utf8", "inputenc");
	$latex->addUsePackageWithParameter("vietnam", "babel");
	//for Times New Roman
	$latex->addUsePackageWithParameter("T1", "fontenc");
	$latex->addUsePackage("txfonts");
	
	$latex->addSection("First section");
	$latex->addSubsection("First subsection");
	$latex->addParagraph("Hello World 1");
	$latex->addSubsection("Second subsection");
	$latex->addSection("Second section");
	$latex->addFigure("h", "centering", "10cm", "/home/phancuong/Latex_Files/trasua.jpg", "Tra Sua", "");
	
	$table = new Table("|r|r|r|");
	$table->addHorizontalLine();
	for ($i=0; $i < 10; $i++) { 
		$rowloop = array("Hoang Van A", "Nguyễn Văn B", "Nguyeen Thi C");
		$table->addRow($rowloop);
		$table->addHorizontalLine();
	}
	$row = array("Phan Manh Cuong", "Cuong ");
	//$row = array("Phan Manh Cuong", "{\\multirow{2}{*}{Cuong }} ");
	$mergedColumns = array(array(2, 3, "|c|"));
	$table->addRowWithMergedColumns($row, $mergedColumns);
	$table->addHorizontalLine();
	$row1 = array("merged row", "2", "3");
	$row2 = array("4", " ", "5");
	$table->addMergedRow($row1, 2, 2);
	$table->addhhLine(0, 1);
	$table->addhhLine(2, 3);
	$table->addRow($row2);
	
	$table->addHorizontalLine();
	$latex->addLongTable($table);
	$latex->createLatexFile("latex.tex");
	$latex->createPdfFile("latex.tex");
?>