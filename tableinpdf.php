<?php
	header('Content-type: text/html; charset=utf-8');
	include 'Report.php';
	include 'Table.php';

	//$conn = new mysqli("localhost", "root", "cuọng95");
	$conn = mysql_connect('localhost', 'root', 'cuong95');
	if (!$conn) {
    	die("Connection failed: " . mysql_error());
	} else {
		mysql_select_db('hdcd');		
		//query unicode characters
		mysql_query ("set character_set_client='utf8'"); 
	 	mysql_query ("set character_set_results='utf8'"); 
	 	mysql_query ("set collation_connection='utf8_general_ci'"); 
	}
	$latex = new Report("article", "BẢN ĐĂNG KÍ XÉT CÔNG NHẬN ĐẠT TIÊU CHUẨN\\\\CHỨC DANH: PHÓ GIÁO SƯ", "");
	$latex->addUsePackage("graphicx");
	$latex->addUsePackage("multirow");
	$latex->addUsePackage("hhline");
	$latex->addUsePackage("ltablex");
	$latex->addUsePackage("fontspec");
	$latex->addUsePackageWithParameter("vietnam,english", "babel");
	$latex->addColumnTypeForTable("{C}{>{\centering\arraybackslash}X}");
	$latex->addFont("Times New Roman");

	$sql = "SELECT FULLNAME, BirthDate, BirthMonth, BirthYear,  Sex,  Ethnic_ID,  IsInCommunistParty, HomeTown, ResidentAddress, ContactAddress, FROM tbl_candidate WHERE User_ID = 1;";
	$result = mysql_query($sql, $conn);
	$rowFetch = mysql_fetch_array($result, MYSQL_NUM);
	$name = $rowFetch[0];

	$sql = "SELECT BirthDate, BirthMonth, BirthYear FROM tbl_candidate WHERE User_ID = 1;";
	$result = mysql_query($sql, $conn);
	$rowFetch = mysql_fetch_array($result, MYSQL_NUM);
	$birthday = $rowFetch[0] . "/" . $rowFetch[1] . "/" .$rowFetch[2];

	$sql = "SELECT Sex FROM tbl_candidate WHERE User_ID = 1;";
	$result = mysql_query($sql, $conn);
	$rowFetch = mysql_fetch_array($result, MYSQL_NUM);
	$gender = $rowFetch[0];
	if($gender == 0) $gender = " - Nữ";
	else $gender = " - Nam";

	$sql = "SELECT Ethnic_ID FROM tbl_candidate WHERE User_ID = 1;";
	$result = mysql_query($sql, $conn);
	$rowFetch = mysql_fetch_array($result, MYSQL_NUM);
	$name = $rowFetch[;

	$latex->addSection("THÔNG TIN CÁ NHÂN");
	$latex->addSubsection("Họ và tên người đăng ký: ");
	//Create table Sách tiêu biểu
	// $tableBook = new Table("|l|C|C|C|C|C|C|r|");
	// $tableBook->addHorizontalLine();
	// $tableBookName = ẩy("Sách tiêu biểu");
	// $Title = ẩy("TT", "Tên sách", "Số tác gỉa", "Vai trò", "Loại sách", "ISBN", "Tên nhà xuất bản", "Năm xuất bản");
	//Create table Đề tài tiêu biểu
	$tableTopic = new Table("|l|C|C|C|C|C|r|");
	$tableTopic->addHorizontalLine();
	$tableName = array("Đề tài tiêu biểu");
	$rowTitle = array("TT", "Tên chương trình/đề tài", "Cấp quản lí", "Là chủ nhiệm chương trình/đề tài", "Thời gian", "Ngày nhiệm thu", "Kết quả");
	//get data
	$sql = "SELECT ProjectName, ProjectLevel, IsProjectLeader, FromDate, FromMonth, FromYear, ToDate, ToMonth, ToYear, ExaminingDate, ExaminingMonth, ExaminingYear, Result FROM tbl_project WHERE ID = '1';";

	$result = mysql_query($sql, $conn);
	while($rowFetch = mysql_fetch_array($result, MYSQL_NUM)) {
		//to display correctly if there is no data about date;
		if(!empty($rowFetch[3])) $rowFetch[3] .= "/";
		if(!empty($rowFetch[6])) $rowFetch[6] .= "/";
		if(!empty($rowFetch[9])) $rowFetch[9] .= "/";

		$rowData = array("1", $rowFetch[0], $rowFetch[1], $rowFetch[2], $rowFetch[3] . $rowFetch[4] . "/" .$rowFetch[5] . " đến " . $rowFetch[6] . $rowFetch[7] . "/" . $rowFetch[8], $rowFetch[9] . $rowFetch[10] . "/" . $rowFetch[11], $rowFetch[12]);
		$mergedColumn = array(array(1, 7, "|c|"));
		$tableTopic->addRowWithMergedColumns($tableName, $mergedColumn);
		$tableTopic->addHorizontalLine();
		$tableTopic->addRow($rowTitle);
		$tableTopic->addHorizontalLine();
		$tableTopic->addRow($rowData);
		$tableTopic->addHorizontalLine();
		$latex->addTable($tableTopic);	
	}

	$latex->createLatexFile("TestTable.tex");
	$latex->createPdfFile("TestTable.tex");

	mysql_close($conn);
?>