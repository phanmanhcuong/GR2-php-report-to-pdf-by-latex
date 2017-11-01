<?php
	/**
	* 
	*/
	class Report 
	{	
		var $usepackage;
		var $template;
		var $title;
		var $date;
		var $author;
		var $section = array();
		var $subsection = array();
		var $content = array();
		var $filestring;
		function __construct($template, $title, $date, $author)
		{
			$this->template = $template;	
			$this->title = $title;
			$this->date = date("d/m/Y");
			$this->author = $author;	
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

		function addSection($section){
			$this->filestring .= "\section{{$section}}\n";
		}

		function addSubsection($subsection){
			$this->filestring .= "\subsection{{$subsection}}\n";
		}

		function addSubSubsecion($subsubsection){
			$this->filestring .= "\subsubsection{{$subsubsection}}\n";
		}

		function addParagraph($paragraph){
			$this->filestring .= "\paragraph{{$paragraph}}\n";
		}

		function addSubparagraph($subparagraph){
			$this->filestring .= "\subparagraph{{$subparagraph}}\n";
		}

		function addFigure($placement, $alignment, $width, $filepath, $caption, $label){
			$this->filestring .= "\begin{figure}[{$placement}]\n\\{$alignment}\n\includegraphics[width=$width]{{$filepath}}\n\caption{{$caption}}\n\label{{$label}}\n\\end{figure}\n";
		}

		function addTable($table){
			$stringFormat = "\\begin{tabular}{%s}\n";
			$string = sprintf($stringFormat, $table->template);
			$string .= $table->rowCollection;
			$string .= "\\end{tabular}";
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
			$format = "\documentclass[a4paper,13pt]{%s}\n%s\begin{document}\n\\title{%s}\n\author{%s}\n\date{%s}\n\maketitle\n%s\n\\end{document}";
			
			$string = sprintf($format, $this->template, $this->usepackage, $this->title, $this->date, $this->author, $this->filestring);
			print($string);
			fwrite($file, $string);
			fclose($file);
		}

		function createPdfFile($filepath){
			$output = shell_exec("pdflatex " . $filepath);
			//print($output);
		}

	}
?>