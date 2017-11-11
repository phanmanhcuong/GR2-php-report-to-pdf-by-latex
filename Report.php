<?php
	/**
	* texlive-lang-vietnamese
	*/
	class Report 
	{	
		var $usepackage;
		var $template;
		var $title;
		var $date;
		//var $author;
		var $section = array();
		var $subsection = array();
		var $content = array();
		var $filestring;
		// function __construct($template, $title, $date, $author)
		// {
		// 	$this->template = $template;	
		// 	$this->title = $title;
		// 	$this->date = date("d/m/Y");
		// 	$this->author = $author;	
		// }
		function __construct($template, $title, $date)
		{
			$this->template = $template;	
			$this->title = $title;	
			$this->date = $date;
		}

		function addUsePackage($package){
			$packageString = "";
			$packageString = "\\usepackage" . "{" . $package . "}\n";
			$this->usepackage .= $packageString;
		}

		function addUsePackageWithParameter($parameter, $package){
			$packageString = "";
			$packageString = "\\usepackage" . "[" . $parameter . "]{" . $package ."}\n";
			$this->usepackage .= $packageString;
		}

		function addColumnTypeForTable($columnType){
			$columnTypeString = "\\newcolumntype" . $columnType . "\n";
			$this->usepackage .= $columnTypeString;
		}

		function addFont($font){
			$fontString = "\\setmainfont" . "{" . $font . "}\n";
			$this->usepackage .= $fontString;
		}

		function addTitleFormat($item, $format, $theItem, $margin){
			$format = "\\titleformat{" . $item . "}{" . $format . "}{" . $theItem . "}{" . $margin . "}{}\n";
			$this->filestring . = $format;
		}

		function addSection($section){
			$this->filestring .= "\section{$section}\n";
		}

		function addSubsection($subsection){
			$this->filestring .= "\subsection{$subsection}\n";
		}

		function addSubSubsecion($subsubsection){
			$this->filestring .= "\subsubsection{$subsubsection}\n";
		}

		function reNewCommand($parameter1, $parameter2){
			$string = "\\renewcommand{" . $parameter1 . "}{" . $parameter2 . "}\n" ;
			$this->filestring .= $string;
		}

		function addPlainText($plaintext){
			$this->filestring .= $plaintext;
		}

		function addParagraph($paragraph){
			$this->filestring .= "\paragraph{{$paragraph}}";
		}

		function addSubparagraph($subparagraph){
			$this->filestring .= "\subparagraph{{$subparagraph}}\n";
		}

		function addFigure($placement, $alignment, $width, $filepath, $caption, $label){
			$this->filestring .= "\begin{figure}[{$placement}]\n\\{$alignment}\n\includegraphics[width=$width]{{$filepath}}\n\caption{{$caption}}\n\label{{$label}}\n\\end{figure}\n";
		}

		function addCheckBox(){
			$this->filestring .= "\makebox[0pt][l]{$\square$}\\raisebox{.15ex}{\hspace{0.1em}$\checkmark$}\n";
		}

		function addEmptyCheckBox(){
			$this->filestring .= "\makebox[0pt][l]{$\square$}\\raisebox{.15ex}{\hspace{0.1em}}\n";
		}

		function addNoIndentation(){
			$this->filestring .= "{\\noindent}";
		}

		function addLineBreak(){
			$this->filestring .= "\\\\\n";
		}

		function addhspace($length){
			$string = "\\hspace*{" . $length . "}";
			$this->filestring .= $string;
		}

		function addTable($table){
			$stringFormat = "\\begin{tabularx}{\\textwidth}{%s}\n";
			$string = sprintf($stringFormat, $table->template);
			$string .= $table->rowCollection;
			$string .= "\\end{tabularx}";
			$this->filestring .= $string;
		}

		function addLongTable($table){
			$stringFormat = "\\begin{longtable}{%s}\n";
			$string = sprintf($stringFormat, $table->template);
			$string .= $table->rowCollection;
			$string .= "\\end{longtable}";
			$this->filestring .= $string;
		}

		function createLatexFile($filepath){
			//$filepath = "/home/phancuong/Latex_Files/latex.tex";
			$file = fopen($filepath, "w")  or die ("Unable to create file");
			// $packageString = "";
			// foreach ($this->usepackage as $key => $package) {
			// 	$packageString = $packageString . "\\usepackage{" . $package . "}\n";
			// }
			$format = "\documentclass[a4paper,13pt]{%s}\n%s\begin{document}\n\\title{%s}\n\date{%s}\n\maketitle\n%s\n\\end{document}";
			
			$string = sprintf($format, $this->template, $this->usepackage, $this->title, $this->date, $this->filestring);
			print($string);
			fwrite($file, $string);
			fclose($file);
		}

		function createPdfFile($filepath){
			$output = shell_exec("xelatex " . $filepath);
			//print($output);
		}

	}
?>