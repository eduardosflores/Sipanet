<?php
/**
 *  SipaNet 2.0 - Sistema de Informação Processual e Arquivo
    Copyright (C) 2008 Universidade Estadual de Ciências da Saúde de Alagoas - UNCISAL <http://www.uncisal.edu.br>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

 */

/**
* Helper para criação de PDF
* Baseado em http://bakery.cakephp.org/articles/view/pdf-helper-using-fpdf
**/


vendor('fpdf/fpdf');

if (!defined('PARAGRAPH_STRING')) define('PARAGRAPH_STRING', '~~~');

class fpdfHelper extends FPDF {
	
	var $title;
	
	/**
	* Allows you to change the defaults set in the FPDF constructor
	*
	* @param string $orientation page orientation values: P, Portrait, L, or Landscape    (default is P)
	* @param string $unit values: pt (point 1/72 of an inch), mm, cm, in. Default is mm
	* @param string $format values: A3, A4, A5, Letter, Legal or a two element array with the width and height in unit given in $unit
	*/
	function setup ($orientation='P',$unit='mm',$format='A4') {
		$this->FPDF($orientation, $unit, $format);
		$this->SetMargins(2, 2, 2);
	}
	
	/**
	* Allows you to control how the pdf is returned to the user, most of the time in CakePHP you probably want the string
	*
	* @param string $name name of the file.
	* @param string $destination where to send the document values: I, D, F, S
	* @return string if the $destination is S
	*/
	function fpdfOutput ($name = 'page.pdf', $destination = 's') {
		// I: send the file inline to the browser. The plug-in is used if available. 
		//    The name given by name is used when one selects the "Save as" option on the link generating the PDF.
		// D: send to the browser and force a file download with the name given by name.
		// F: save to a local file with the name given by name.
		// S: return the document as a string. name is ignored.
		return $this->Output($name, $destination);
	}
	
	/**
	* Cria um título
	**/
	function h1($message) {
		$this->SetFont('Arial', 'B', 14);
		$this->Cell(0, 0, $message , 0, 0, 'C');
		$this->Ln(10);
	}
	
	/**
	* Cria um sub-título
	**/
	function h2($message) {
		$this->SetFont('Arial', '', 14);
		$this->Cell(0, 0, $message , 0, 1, 'C');
		$this->Ln(5);
	}
	
	/**
	* Cria o cabeçalho de uma tabela
	**/
	function tableHeader($data, $width) {
		$this->SetFont('Arial', 'B', 12);
		
		$i = 0;
		
		foreach($data as $col) {
			$this->Cell($width[$i], 7, $col, 1, 'C');
			$i++;
		}
		
		$this->Ln();
	}
	
	/**
	* Cria a linha de uma tabela
	**/
	function tableLine($data, $width) {
		$this->SetFont('Arial', '', 12);
		
		$i = 0;
		
		foreach($data as $col) {
			$this->Cell($width[$i], 7, $col, 1, 'C');
			$i++;
		}
		
		$this->Ln();
	}
	
	function dataLine($label, $content) {
		$this->SetFont('Arial', 'B', 12);
		$this->Write(7, $label);
		$this->Ln();
		
		$this->SetFont('Arial', '', 12);
		$this->Write(7, $content);
		$this->Ln();
	}
	
	function Header() {
		$this->SetFont('Arial', 'B', 14);
		$this->Cell(0, 0, $this->title, 0, 0, 'C');
		$this->Ln(10);
	}
	
	function Footer() {
		$this->SetY(-15);
		$this->SetFont('Arial','I',8);
		$this->Cell(0,10, 'Impresso em ' . date('d/m/Y') . ' / Página ' . $this->PageNo(),0,1,'C'); 
	}
}
?>