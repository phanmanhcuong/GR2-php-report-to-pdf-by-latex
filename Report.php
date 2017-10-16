<?php
	/**
	* 
	*/
	class Report 
	{
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
			$this->title = $title;
			$this->date = date("d/m/Y");
			$this->template = $template;	
			$this->author = $author;	
		}

		function addSection($section){
			$this->filestring .= "\section{{$section}}\n";
		}

		function addSubsection($subsection){
			$this->filestring .= "\subsection{{$subsection}}\n";
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

		function createLatexFile($filepath){
			//$filepath = "/home/phancuong/Latex_Files/latex.tex";
			$file = fopen($filepath, "w")  or die ("Unable to create file");
			$format = "\documentclass[a4paper,12pt]{%s}\n\usepackage{graphicx}\n\begin{document}\n\\title{%s}\n\author{%s}\n\date{%s}\n\maketitle\n%s\n\\end{document}";
			
			$string = sprintf($format, $this->template, $this->title, $this->date, $this->author, $this->filestring);
			echo $string;
			fwrite($file, $string);
			fclose($file);
		}

		function createPdfFile($filepath){
			$output = shell_exec("pdflatex " . $filepath);
			print($output);
		}

	}
?>