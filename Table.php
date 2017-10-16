<?php
	/**
	* 
	*/
	class Table 
	{
		var $template;
		var $rowCollection;
		function __construct($template)
		{
			$this->template = $template;
		}

		function addRow($row){
			$rowString = "";
			for ($i=0; $i < count($row) ; $i++) { 			
				$rowString .= $row[$i];
				$rowString .= "&";
			}
			$rowString[strlen($rowString)-1] = "\\";
			$rowString .= "\\\n";
			$this->rowCollection .= $rowString;
		}

		function addHorizontalLine(){
			$this->rowCollection .= "\\hline\n";
		}

		function addPartialHorizontalLine($startLine, $endLine){
			$string = "\\cline{" . $startLine . "-" . $endLine ."}\n";
			$this->rowCollection .= $string;
		}

	}
?>