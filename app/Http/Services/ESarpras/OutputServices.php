<?php

namespace App\Http\Services\ESarpras;

use App\Models\Ticket;
use App\Models\SignerTicket;
use App\Models\UserTicket;
use App\Models\User;
use App\Models\Report;
use App\Models\Holiday;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use PDF;
// use QrCode;

class OutputServices
{

	public function data($type, $id, $documentTitle = false){
		$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		if($type == 'ticket'){

			//Data
			$Ticket = Ticket::find($id);

			//Get Signer
			$Signer = $this->getSignerTicket($Ticket);
			
			//Blade for View
			$viewBlade = view('e-sarpras.output.ticket', [
				'data'          => $Ticket,
				'userProcess'   => $this->getUserProcess($Ticket->id),
				'signer'        => $Signer[0],
				'sign'			=> $Signer[1]
			]);

			// Custom Footer
			$this->Footer($pdf, $type, $id);

			//Initial Document
			$title = \Str::slug($Ticket->date.'_'.$Ticket->token.'_Ticketing_'.$Ticket->type);
			PDF::SetAuthor('E-SarprasTI Pusdatin PMPTSP');
			PDF::SetTitle($title);
			PDF::SetSubject('Output Ticketing Sarpras TI');
			PDF::SetMargins(13, 10, 15);
			PDF::SetFontSubsetting(false);
			PDF::SetFontSize('10px');
			PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			//Page One
			PDF::AddPage('P', 'F4');
			PDF::writeHTML($viewBlade, true, false, true, false, '');

		} else if($type == 'report'){

			//Data
			$Report = Report::with('ReportDescription', 'ReportPicture')->whereId($id)->first();

			$dataPicture = '';

			foreach($Report->ReportPicture as $row){
				if($row->pictures != null){

					$dataPicture .= '<p style="page-break-after: always;"></p><table width="100%" border="1" cellpadding="3" cellspacing="1"><tr>
									<td width="30%">Hari</td>
									<td width="70%">'.DayFormat($row->date).'</td>
								</tr>
								<tr>
									<td width="30%">Tanggal</td>
									<td width="70%">'.DateFormat($row->date).'</td>
								</tr>
								<tr>
									<td colspan="2" height="750px" style="text-align:center;">';
				
					$dataPicture .= '<div class="container-box">';
					foreach(json_decode($row->pictures, true) as $key => $value){
						$dataPicture .= '<div>
											<img class="imageReport" src="'.\Storage::url('report/pictures/'.$value).'" class="img-thumbnail" alt="'.$value.'">
										</div>';
					}
					$dataPicture .= '</div>';
					$dataPicture .= '</td></tr></table>';
				}
			}
			
			//Blade for View
			$viewBlade = view('e-sarpras.output.report', [
				'data'          => $Report,
				'holidays' 		=> Holiday::whereMonth('date', $Report->month)->whereYear('date', $Report->year)->get(),
				'dataPics'		=> $dataPicture
			]);

			// Custom Footer
			$this->FooterReport($pdf, $type, $id);

			//Initial Document
			$title = \Str::slug($Report->month.'_'.$Report->year.'_Ticketing_'.$Report->user->name);
			PDF::SetAuthor('E-SarprasTI Pusdatin PMPTSP');
			PDF::SetTitle($title);
			PDF::SetSubject('Output Reporting Activity Sarpras TI');
			PDF::SetMargins(13, 10, 15);
			PDF::SetFontSubsetting(false);
			PDF::SetFontSize('10px');
			PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			//Page One
			PDF::AddPage('P', 'F4');
			PDF::writeHTML($viewBlade, true, false, true, false, '');
		}

		if($documentTitle == true){
			return $title;
		}
	}

    public function renderOutput($type, $id, $method)
    {
		$title = $this->data($type, $id, true);
		PDF::Output($title.'.pdf', (!empty($method) ? $method : 'I'));
      	exit;
    }

	public function Footer($pdf, $type, $data){
		$class = PDF::setFooterCallback(function($pdf) use($type, $data){
			$pdf->SetXY(-15,-15);
			$pdf->SetFont('helvetica', 'I', 8);
			$pdf->Cell(10, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
			// set style for barcode
			$style = array(
				'border' => 0,
				'vpadding' => 'auto',
				'hpadding' => 'auto',
				'fgcolor' => array(0,0,0),
				'bgcolor' => false, //array(255,255,255)
				'module_width' => 1, // width of a single module in points
				'module_height' => 1 // height of a single module in points
			);

			$link = route('output.render', [$type, $data]);
			$pdf->SetXY(10,318);
			$pdf->write2DBarcode($link, 'QRCODE,H', 10, 295, 25, 25, $style, 'N');
			$pdf->Text(12, 318, 'Verified by ESarprasTI');
		});
  
		return $class;
	}

	public function FooterReport($pdf, $type, $data){
		$class = PDF::setFooterCallback(function($pdf) use($type, $data){
			$pdf->SetXY(-15,-15);
			$pdf->SetFont('helvetica', 'I', 8);
			$pdf->Cell(10, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
			// set style for barcode
			$style = array(
				'border' => 0,
				'vpadding' => 'auto',
				'hpadding' => 'auto',
				'fgcolor' => array(0,0,0),
				'bgcolor' => false, //array(255,255,255)
				'module_width' => 1, // width of a single module in points
				'module_height' => 1 // height of a single module in points
			);

			$link = route('output.render', [$type, $data]);
			// $pdf->SetXY(10,318);
			$pdf->write2DBarcode($link, 'QRCODE,H', 11, 305, 20, 20, $style, 'N');
			// $pdf->Text(12, 318, 'Verified by ESarprasTI');
		});
  
		return $class;
	}

	public function  getSignerTicket($Ticket){
		if($Ticket->type == 'troubleshooting' || $Ticket->type == 'monitoring'){
			$Signer = $this->getSigner($Ticket->id);
			$UserSign = $this->getSignerUser($Signer->sign);
		} else {
			$Signer = '';
			$UserSign = '';
		}

		return [$Signer, $UserSign];
	}

	public function getSignerUser($signer){
		if(!empty($signer)){
			$img_base64_encoded = 'data:image/png;base64,'.$signer;
			$imageContent = file_get_contents($img_base64_encoded);
			$path = tempnam(sys_get_temp_dir(), 'prefix');
			file_put_contents ($path, $imageContent);
			return '<img src="'.$path.'" height="80px" alt="Sign">';
		} else {
			return null;
		}
	}

	public function getUserProcess($id)
    {
        return UserTicket::whereTicketId($id)->get();
    }

	public function getSigner($id)
    {
        return SignerTicket::whereTicketId($id)->first();
    }

	public function getImageReport($image){
		if(!empty($image)){
			$imageContent = file_get_contents(public_path('storage/report/pictures/'.$image));
			$path = tempnam(sys_get_temp_dir(), 'prefix');
			file_put_contents ($path, $imageContent);
			return '<img src="'.$path.'" height="150px" alt="Sign">';
		} else {
			return null;
		}
	}

    
}
