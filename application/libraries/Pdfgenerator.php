<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'third_party/dompdf/autoload.inc.php');

use Dompdf\Dompdf;

class Pdfgenerator
{
	public function generate($html, $filename = 'document', $stream = true)
	{
		$dompdf = new Dompdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();

		if ($stream) {
			$dompdf->stream($filename . ".pdf", array("Attachment" => false));
		} else {
			return $dompdf->output();
		}
	}
}
