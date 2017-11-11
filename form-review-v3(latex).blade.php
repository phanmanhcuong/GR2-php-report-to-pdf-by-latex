<?php
	header('Content-type: text/html; charset=utf-8');
	include 'Report.php';
	include 'Table.php';

	$report = new Report("article", "BẢN ĐĂNG KÍ XÉT CÔNG NHẬN ĐẠT TIÊU CHUẨN\\\\CHỨC DANH: PHÓ GIÁO SƯ", "");
	$report->addUsePackage("graphicx");
	$report->addUsePackage("multirow");
	$report->addUsePackage("hhline");
	$report->addUsePackage("ltablex");
	$report->addUsePackage("fontspec");
	$report->addUsePackage("amssymb");		//checkbox
	$report->addUsePackage("titlesec"); 		//reformat titles likes subsection to not bold
	$report->addUsePackageWithParameter("vietnam,english", "babel");
	$report->addColumnTypeForTable("{C}{>{\centering\arraybackslash}X}");
	$report->addFont("Times New Roman");

	$report->addNoIndentation();
	$report->addPlainText("(Nếu nội dung đúng ở ô nào thì đánh dấu vào ô đó:");
	$report->addCheckBox();
	$report->addPlainText("; Nếu nội dung không đúng thì để trống:");
	$report->addEmptyCheckBox();
	$report->addPlainText(")");
	$report->addLineBreak();
	$report->addPlainText("Đăng ký xét đạt tiêu chuẩn chức danh: ");
	if($isapplyprofessor == 1){
		$report->addPlainText("Giáo sư ");
		$report->addCheckBox();
		$report->addPlainText("; Phó Giáo Sư ");
		$report->addEmptyCheckBox();
	} else{
		$report->addPlainText("Giáo sư ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Phó Giáo Sư ");
		$report->addCheckBox();
	}
	$report->addLineBreak();

	$report->addPlainText("Đối tượng: ");
	if($islecturer == 1){
		$report->addPlainText("Giảng viên ");
		$report->addCheckBox();
		$report->addPlainText("; Nghiên cứu sinh ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Quản lý ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Nghề khác ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Nghỉ hưu ");
		$report->addEmptyCheckBox();
	} elseif($isresearcher == 1){
		$report->addPlainText("Giảng viên ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Nghiên cứu sinh ");
		$report->addCheckBox();
		$report->addPlainText("; Quản lý ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Nghề khác ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Nghỉ hưu ");
		$report->addEmptyCheckBox();
	} elseif ($ismanager == 1) {
		$report->addPlainText("Giảng viên ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Nghiên cứu sinh ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Quản lý ");
		$report->addCheckBox();
		$report->addPlainText("; Nghề khác ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Nghỉ hưu ");
		$report->addEmptyCheckBox();
	} elseif ($isotherjob == 1){
		$report->addPlainText("Giảng viên ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Nghiên cứu sinh ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Quản lý ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Nghề khác ");
		$report->addCheckBox();
		$report->addPlainText("; Nghỉ hưu ");
		$report->addEmptyCheckBox();
	} elseif($isretire == 1){
		$report->addPlainText("Giảng viên ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Nghiên cứu sinh ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Quản lý ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Nghề khác ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Nghỉ hưu ");
		$report->addCheckBox();
	}
	$report->addLineBreak();
	$report->addPlainText("Ngành: " . $topic->Name . ".");
	$report->addLineBreak();
	$report->addPlainText("Chuyên ngành " . $major->Name) . ".");
	$report->reNewCommand("\\thesection",  "\Alph{section}.");	//numbering section by Alphabet letters instead of numbers;
	$report->addSection("THÔNG TIN CÁ NHÂN");
	$report->reNewCommand("\\thesubsection", "\arabic{subsection}");	//numbering subsection by numbers
	$report->addTitleFormat("\subsection", "", "\\thesubsection", "0em");	//unbold the subsection
	$report->addTitleFormat("\subsubsection", "", "\\thesubsubsection", "0em");	//unbold the subsubsection
	$report->addSubsection("Họ và tên người đăng ký: " . $profile->FullName);
	$report->addSubsection("Ngày tháng năm sinh: " . $profile->BirthDate . ". ");
	if($profile->Sex == 1){
		$report->addPlainText("Nam ");
		$report->addCheckBox();
		$report->addPlainText("; Nữ ");
		$report->addEmptyCheckBox();
	} else{
		$report->addPlainText("Nam ");
		$report->addEmptyCheckBox();
		$report->addPlainText("; Nữ ");
		$report->addCheckBox();
	}
	$report->addPlainText(". Dân tộc: " . $ethnic->Name);
	$report->addSubsection(". Đảng viên ĐẢNG CSVN: ");
	if($IsInCommunistParty ==1 ){
		$report->addPlainText(" Có.");
	} else{
		$report->addPlainText(" Không.");
	}
	$report->addSubsection(". Quê quán:xã/phường/,huyện/quận,tỉnh/thành phố: " . $profile->HomeTown);
	$report->addSubsection(". Chỗ ở hiện nay (số nhà, phố, phường, quận, thành phố hoặc xã, huyện, tỉnh: ". $profile->ResidentAddress);
	$report->addLineBreak();
	$report->addPlainText("Điện thoại nhà riêng: " . $profile->HomePhone);
	$report->addLineBreak();
	$report->addPlainText("Điện thoại di động: " . $profile->MobiPhone);
	$report->addLineBreak();
	$report->addPlainText("Địa chỉ E-mail: " . $profile->OfficialEmail);
	$report->addLineBreak();
	$report->addSubsection(". Địa chỉ liên hệ (ghi rõ, đầy đủ để liên hệ được qua Bưu điện): " . $profile->ResidentAddress);
	$report->addSubsection(". Quá trình công tác (công việc, chức vụ, cơ quan): ");

	$tableWorkingTime = new Table("|l|C|C|C|C|r|");
	$tableWorkingTime->addHorizontalLine();
	$rowTitle = array("TT", "Thời gian", "Cơ quan công tác", "Cơ quan công tác (Tiếng Anh)",  "Địa chỉ", "Chức vụ");
	$tableWorkingTime->addRow($rowTitle);
	$tableWorkingTime->addHorizontalLine();
	$count = 0;
	foreach ($workinghistory as $workinghistory){
		$rowData = array(++$count, $workinghistory->FromDate . "đến " . "$workinghistory->ToDate", $workinghistory->Name, $workinghistory->EnglishName, $workinghistory->Address, $workinghistory->Position);
		$tableWorkingTime->addRow($rowData);
		$tableWorkingTime->addHorizontalLine();
	}
	$report->addTable($tableWorkingTime);
	$report->addSubsection(". Quá trình đào tạo: ");
	$tableTrainingProcess = new Table("|l|C|C|C|C|C|C|r|");
	$rowTitle = array("TT", "Thời gian", "Tên cơ sở đào tạo", "Tên cơ sở đào tạo (Tiếng Anh)", "Địa chỉ", "Chuyên ngành", "Chuyên ngành (Tiếng Anh)", "Bằng cấp", );
	$tableTrainingProcess->addHorizontalLine();
	$tableTrainingProcess->addRow($rowTitle);
	$tableTrainingProcess->addHorizontalLine();
	$count = 0;
	foreach($educationhistory as $educationhistory){
		$rowData = array(++$count, $educationhistory->FromDate . "đến" . $educationhistory->ToDate, $educationhistory->Name, $educationhistory->EnglishName, $educationhistory->Address, $educationhistory->Major, $educationhistory->EnglishMajor, $educationhistory->Degree);
		$tableTrainingProcess->addRow($rowData);
		$tableTrainingProcess->addHorizontalLine();
	}
	$report->addTable($tableTrainingProcess);
	$report->addSubsection(". Đã được công nhận chức danh: ");
	if($isapplyprofessor == 1){
		$report->addPlainText("Phó Giáo sư.");
	} else{
		$report->addPlainText("_____________");
	}
	$report->addLineBreak();
	$report->addPlainText("Thời gian: " . $profile->AssProf_Date . ", ngành " . $profile->ResearchInterest);
	$report->addLineBreak();
	$report->addSubsection(". Đăng ký xét đạt tiêu chuẩn chức danh ");
	if($isapplyprofessor == 1){
		$report->addPlainText("Giáo sư tại HĐCDGS cơ sở: " . $council->Name);
	} else{
		$report->addPlainText("Phó Giáo Sư tại HĐCDGS cơ sở: " . $council->Name);
	}
	$report->addLineBreak();
	$report->addSubsection(". Đăng ký xét đạt tiêu chuẩn chức danh");
	if($isapplyprofessor == 1){
		$report->addPlainText("Giáo sư  tại HĐCDGS ngành, liên ngành: " . $council2->Name);
	} else{
		$report->addPlainText("Phó Giáo Sư tại HĐCDGS ngành, liên ngành: " . $council2->Name);
	}
	$report->addSubsection(". Các hướng nghiên cứu chủ yếu: " . $profile->ResearchInterest);
	$report->addSubsection(". Kết quả đào tạo: ");
	$tableTrainingResult = new Table("|l|C|C|C|C|C|r|");
	$tableTrainingResult->addHorizontalLine();
	$rowTitle = array("Họ tên học viện", "Đối tượng", "Trách nhiệm hướng dẫn", "Thời gian", "Cơ sở đào tạo", "Năm bảo vệ");
	$tableTrainingResult->addRow($rowTitle);
	$tableTrainingResult->addHorizontalLine();
	$count = 0;
	foreach($master_phd as $master_phd){
		if($master_phd->IsMasterStudent == 1){
			$masterStudent = "Master";
		} else{
			$masterStudent = "PhD";
		}
		if($master_phd->IsFirstSupervisor ==1 ){
			$firstSuperVisor = "Người hướng dẫn chính";
		} else{
			$firstSuperVisor = "Người hướng dẫn số 2";
		}
		$rowData = array(++$count, $master_phd->FullName, $masterStudent, $firstSuperVisor, $master_phd->FromDate . "đến " . $master_phd->ToDate, $master_phd->Organization, $master_phd->GraduatedYear);
		$tableTrainingResult->addRow($rowData);
		$tableTrainingResult->addHorizontalLine();
	}
	$report->addTable($tableTrainingResult);
	$report->addSubsection(". Các đề tài đã tham gia: ");
	$tableJointedSubject = new Table("|l|C|C|C|C|C|C|r|");
	$tableJointedSubject->addHorizontalLine();
	$rowTitle = array("TT", "Tên chương trình/ đề tài, Mã chương trình/ đề tài", "Cấp chương trình/ đề tài", "Là chủ nhiệm chươngt trình/ đề tài", "Thời gian", "Ngày nhiệm thu", "Kết quả");
	$tableJointedSubject->addRow($rowTitle);
	$tableJointedSubject->addHorizontalLine();
	$count = 0;
	foreach($project as $project){
		if($project->IsProjectLeader == 1){
			$projectLeader = "Chủ nhiệm";
		} else{
			$projectLeader = "";
		}
		$rowData = array(++$count, $project->ProjectName, $project->ProjectCode, $project->ProjectLevel, $projectLeader, $project->FromDate . "đến ". $project->ToDate, $project->ExaminingDate, $project->Result);
		$tableJointedSubject->addRow($rowData);
		$tableJointedSubject->addHorizontalLine();
	}
	$report->addTable($tableJointedSubject);
	$report->addSubsection(". Các sách đã được xuất bản: ");
	$tablePublishedBook = new Table("|l|C|C|C|C|r|");
	$tableJointedSubject->addHorizontalLine();
	$rowTitle = array("TT", "Tên sách", "Danh sách tác gỉa", "Vai trò", "Loại sách", "Tên nhà xuất bản", "Năm xuất bản");
	$tableJointedSubject->addRow($rowTitle);
	$tableJointedSubject->addHorizontalLine();
	$count = 0;
	foreach($book as $book){
		if($book->IsEditorChief == 1){
			$editorChief = "Chủ biên";
		} else{
			$editorChief = "Người tham gia";
		}
		$rowData = array(++$count, $book->BookName, $book->Authors , $editorChief, $book->BookType, $book->EditorName, $book->Year);
		$tablePublishedBook->addRow($rowData);
		$tablePublishedBook->addHorizontalLine();
	}
	$report->addTable($tableJointedSubject);
	$report->addSubsection(". Bằng sáng chế: ");
	$tablePatent = new Table("|l|C|C|C|r|");
	$tablePatent->addHorizontalLine();
	$rowTitle = array("TT", "Tên bằng sáng chế", "Danh sách tác gỉa", "Tên cơ quan cấp", "Ngày cấp bằng sáng chế");
	$tablePatent->addRow($rowTitle);
	$tablePatent->addHorizontalLine();
	$count = 0;
	foreach($patent as $patent){
		$rowData = array(++$count, $patent->PatentName,  $patent->Authors, $patent->Organization, $patent->PatentDate);
		$tablePatent->addRow($rowData);
		$tablePatent->addHorizontalLine();
	}
	$report->addTable($tablePatent);
	$report->addSubsection(". Khen thưởng (các huân chương, huy chương, danh hiệu): ");
	$tableAward = new Table("|l|C|C|r|");
	$tableAward->addHorizontalLine();
	$rowTitle = array("TT", "Tên khen thưởng", "Cấp khen thưởng", "Mô tả");
	$tableAward->addRow($rowTitle);
	$tableAward->addHorizontalLine();
	$count = 0;
	foreach($award as $award){
		$rowData = array(++$count, $award->Name, $award->Organization, $award->Description);
		$tableAward->addRow($rowData);
		$tableAward->addHorizontalLine();
	}
	$report->addTable($tableAward);
	$report->addLineBreak();

	$report->addSection("TỰ KHAI THEO TIÊU CHUẨN CHỨC DANH GIÁO SƯ/ PHÓ GIÁO SƯ: ");
	$report->addSubsection(". Tiêu chuẩn và nhiệm vụ của nhà giáo (tự đánh giá).......................................................................................");
	$report->addSubsection(". Ngoại ngữ: ");
	$report->addSubSubsecion(". Ngoại ngữ thành thạo phục vụ chuyên môn:  ................................");
	if($language->IsStudyAbroad == 1){
		$studyAbroad = "Có";
	} else{
		$studyAbroad = "Không";
	}
	$report->addPlainText("a)  Được đào tạo ở nước ngoài: " . $studyAbroad);
	$report->addLineBreak();
	$report->addPlainText("- Học ĐH tại nước: " . $language->CountryNameStudent );
	$report->addLineBreak();
	$report->addPlainText("- Bảo vệ luận văn ThS hoặc luận án TS hoặc TSKH  tại nước : " . $language->CountryNameMaster);
	$report->addLineBreak();
	if($language->IsHaveFLDegree == 1){
		$haveFLDegree = "Có";
	} else{
		$haveFLDegree = "Không";
	}
	$report->addPlainText("b) Được đào tạo ngoại ngữ trong nước: " . $haveFLDegree);
	$report->addLineBreak();
	$report->addPlainText("- Trường ĐH cấp bằng tốt nghiệp ĐH ngoại ngữ: " . $language->UniversityName . "; số bằng: " . $language->DegreeNo . "; năm cấp: " . $language->DegreeYear);
	$report->addLineBreak();
	if($language->IsTeachingInFL == 1){
		$teachingInFL = "Có";
	} else{
		$teachingInFL = "Không";
	}
	$report->addPlainText("c) Giảng dạy bằng tiếng nước ngoài: " . $teachingInFL);
	$report->addLineBreak();
	$report->addPlainText("- Giảng dạy bằng ngoại ngữ : " . $language->TeachingFL);
	$report->addLineBreak();
	$report->addPlainText("- Nơi giảng dạy (cơ sở đào tạo, nước): " . $language->TeachingOrg);
	$report->addSubSubsecion(". Tiếng Anh giao tiếp ( văn bằng, chứng chỉ): " . $language->CommEnglish);
	$report->addSection("CAM ĐOAN CỦA NGƯỜI ĐĂNG KÝ XÉT CÔNG NHẬN ĐẠT TIÊU CHUẨN CHỨC DANH: ");
	$report->addPlainText("Tôi cam đoan những điều khai trên là đúng, nếu sai tôi xin chịu trách nhiệm trước pháp luật. ");
	$report->addhspace("6cm");
	$report->addPlainText("...,ngày.....tháng.....năm  201...");
	$report->addLineBreak();
	$report->addhspace("7cm");
	$report->addPlainText("Người đăng ký");
	$report->addLineBreak();
	$report->addhspace("6.5cm");
	$report->addPlainText("(Ghi rõ họ tên, ký tên)");
	$report->addLineBreak();
	$report->addLineBreak();
	$report->addLineBreak();
	$report->addLineBreak();
	$report->addSection("XÁC NHẬN CỦA THỦ TRƯỞNG CƠ QUAN NƠI ĐANG LÀM VIỆC: ");
	$report->addPlainText("- Về những nội dung \"Thông tin cá nhân\" ứng viên đã kê khai;");
	$report->addLineBreak();
	$report->addLineBreak();
	$report->addLineBreak();
	$report->addPlainText("- Về giai đoạn ứng viên thuộc biên chế giảng viên đại học và mức độ hoàn thành nhiệm vụ trong giai đoạn này.");
	$report->addLineBreak();
	$report->addLineBreak();
	$report->addLineBreak();
	$report->addPlainText("Trong những trường hợp còn lại người khai tự chịu trách nhiệm trước pháp luật về các nội dung đã kê khai. ");
	$report->addLineBreak();
	$report->addLineBreak();
	$report->addLineBreak();
	$report->addPlainText("...,ngày.....tháng.....năm  201...");
	$report->addLineBreak();
	$report->addhspace("7cm");
	$report->addPlainText("Thủ trưởng cơ quan ");
	$report->addLineBreak();
	$report->addhspace("6cm");
	$report->addPlainText("(Ghi rõ họ tên, ký tên, đóng dấu)");
	$report->addLineBreak();
	$report->addLineBreak();
	$report->addLineBreak();
	$report->addLineBreak();
	$report->addPlainText("Chú ý:  Bản đăng ký làm thành 04 bản.");
	$report->addLineBreak();
	$report->addPlainText("- 1 bản và 2 ảnh mầu 4X6 (mặt sau ảnh ghi họ tên, ngày tháng năm sinh, ngành đăng ký xét công nhận đạt tiêu chuẩn chức danh) gửi về Văn phòng HĐCDGSNN. (Địa chỉ: Tầng 7 Tòa nhà Thư viện Tạ Quang Bửu, trường Đại học Bách Khoa Hà Nội, số 01 Đại Cồ Việt, Hà Nội, Tel: (84.4) 38.697.943; Fax: (84.4) 38.680.806; Email:hdcdgsnn@scpt.gov.vn).");
	$report->addLineBreak();
	$report->addPlainText("- 3 bản còn lại đóng vào 03 bộ hồ sơ.");
?>