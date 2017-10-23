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

		//$mergedColumns is 2 dimentional array with value of each key is an array of (start column, end column, alignment of mergedcolumn)
		function addRowWithmergedColumns($row, $mergedColumns){
			$rowString = "";
			for ($i=0; $i < count($row); $i++) {
				if(!empty($mergedColumns)){
					if($mergedColumns[0][0] == ($i+1)){
					$stringFormat = "\\multicolumn{%d}{%s}{%s}";
					$string = sprintf($stringFormat, $mergedColumns[0][1]- $mergedColumns[0][0] + 1, $mergedColumns[0][2], $row[$i]);
					array_splice($mergedColumns, 0, 1);
					$rowString .= $string;
					$rowString .= "&";  
					}	
				} else{
					$rowString .= $row[$i];
					$rowString .= "&";
				}
			}
			$rowString[strlen($rowString)-1] = "\\";
			$rowString .= "\\\n";
			$this->rowCollection .= $rowString;
		}

		function addMergedRow($row, $startColumn, $numberOfRow){
			$rowString = "";
			for ($i=0; $i < count($row); $i++) { 
				if($i != ($startColumn - 1)){
					$rowString .= $row[$i];
					$rowString .= "&";
				} else{
					$stringFormat = "\\multirow{%s}{*}{%s}";
					$string = sprintf($stringFormat, $numberOfRow, $row[$i]);
					$rowString .= $string;
					$rowString .= "&";
				}
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
		
		function addhhLine($columnIndex, $columnNumber){
			$string = "\\hhline{";
			for ($i=0; $i < $columnNumber; $i++) { 
				if($i == ($columnIndex -1)){
					$string .= "~";
				} else{
					$string .= "-";
				}
			}
			$string .= "}\n";
			$this->rowCollection .= $string;
		}
	}
?>