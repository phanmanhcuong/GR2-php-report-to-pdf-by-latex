<?php
	/**
	* 
	*/
	class Report 
	{
		var $title;
		var $date;
		function __construct(argument)
		{
			# code...
		}

		function addTitle_Data($title, $date){
			$this->title = $title;
			$this->date = $date;
		}

		function createLatexFile($filepath){
			//$filepath = "/home/phancuong/Latex_Files/latex.tex";
			$file = fopen($filepath, "w")  or die ("Unable to create file");
			$format = 
			"\documentclass[a4paper,12pt]{article}
			\begin{document}
			\title{%s}
			\date(%s)
			\maketitle
			\end{document}'"
			$string = sprintf($format, $this->title, $this->date);
			fwrite($file, $string)
			fclose($file);
		}
	}
?>