<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \PhpOffice\PhpWord\PhpWord;
use \PhpOffice\PhpWord\Shared\Html;
use Mpdf\Mpdf;

class DocumentController extends Controller
{

   public function document_template()
   {
      return view('layouts.Admin.document');
   }
    
    public function GenerateDocument(Request $request)
    {
       
        $post_data = $_POST;
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        
        if($request->has('export_to_doc'))
        {
            
            $doc_html = '<table style="width:100%;  border-spacing:0; vertical-align:middle; padding:0;" cellspacing="0" cellpadding="0" border="0"><thead><tr><td style="padding:0;margin:0;vertical-align:middle;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background-color: #eee;text-align: left;" cellspacing="0" cellpadding="0"><thead><tr style="background-color: #FFFFFF;"><th style="text-align:center;padding: 25px 35px;margin:0;vertical-align: middle;"><p style="font-size: 36px;font-family: verdana;line-height: 100%;border-right: 1px solid #ddd;padding: 0;margin: 0;padding-right: 0;margin-right: 0;"><b>Curriculum Vitae</b></p></th></tr></thead></table></td></tr>';$doc_html .= '<tr><td style="padding:0;margin:0;vertical-align:middle;line-height:0;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background-color: #fffff;text-align: left;line-height:0;" cellspacing="0" cellpadding="0"><thead><tr style="background-color: #ffffff;line-height:0;"><th style="padding:0px; margin:0px; vertical-align:middle;line-height:0;"></th></tr></thead></table></td></tr>';$doc_html .= '<tr><td style="padding:0;margin:0;vertical-align:middle;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background-color: #eee;text-align: left;" cellspacing="0" cellpadding="0"><thead><tr style="background-color: #FFFFFF;"><th style="text-align:center;padding: 25px 35px;margin:0;vertical-align: middle;"><p style="font-size: 22px;font-family: verdana;line-height: 100%;border-right: 1px solid #ddd;padding: 0;margin: 0;padding-right: 0;margin-right: 0;"><b>' . $post_data['name'] .'</b></p></th></tr></thead></table></td></tr>';$doc_html .= '<tr><td style="padding:0;margin:0;vertical-align:middle;line-height:0;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background-color: #fffff;text-align: left;line-height:0;" cellspacing="0" cellpadding="0"><thead><tr style="background-color: #ffffff;line-height:0;"><th style="padding:0;margin:0;vertical-align: middle;line-height:0;"></th></tr></thead></table></td></tr>';$doc_html .= '<tr><td style="padding:0;margin:0;vertical-align:middle;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;" cellspacing="0" cellpadding="0"><thead><tr style="border:1px solid #000000;border-color:#EEEEEE;border-width:1px;border-style: solid;border-width: 1px;border-color: #EEEEEE;"><th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:50px;"><p style="margin: 0;padding: 0px 0 10px 0;font-size: 18px;font-family: verdana;font-weight: 600;border-bottom: 1px solid #ccc;"><b>Personal / Registration Information:</b></p></th></tr></thead></table></td></tr>';$doc_html .= '<tr><td style="padding:0;margin:0;vertical-align:middle;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;" cellspacing="0" cellpadding="0"><thead><tr><th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:24px;"><p style="font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 15px;line-height:24px;"><b>Medical Registration :</b> &nbsp;&nbsp;&nbsp;<span style=" margin: 0;padding: 0;margin-left: 0px;color: #666;">' . $post_data['reg_info'] . '</span></p></th></tr></thead></table></td></tr>';$doc_html .= '<tr><td style="padding:0;margin:0;vertical-align:middle;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;" cellspacing="0" cellpadding="0"><thead><tr style="border:1px solid #000000;border-color:#EEEEEE;border-width:1px;border-style: solid;border-width: 0px;border-color: #EEEEEE;"><th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:50px;"><p style="margin: 0;padding: 0px 0 10px 0;font-size: 18px;font-family: verdana;font-weight: 600;border-bottom: 1px solid #ccc;"><b>Qualifications / Education:</b></p></th></tr></thead></table></td></tr>';$doc_html .= '<tr><td style="padding:0;margin:0;vertical-align:middle;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;" cellspacing="0" cellpadding="0"><thead><tr><th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:24px;">';if(!empty($post_data['edu_date'])){foreach($post_data['edu_date'] as $edu_key => $edu_val){$doc_html .= '<p style="font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 15px;line-height:24px;"><b>' . $edu_val . ' :</b> &nbsp;&nbsp;&nbsp;<span style=" margin: 0;padding: 0;margin-left: 30px;color: #666;">' . $post_data['education_info'][$edu_key] . '</span></p>';}}$doc_html .= '</th></tr></thead></table></td></tr>';$doc_html .= '<tr><td style="padding:0;margin:0;vertical-align:middle;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;" cellspacing="0" cellpadding="0"><thead><tr style="border:1px solid #000000;border-color:#EEEEEE;border-width:1px;border-style: solid;border-width: 1px;border-color: #EEEEEE;"><th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:50px;"><p style="margin: 0;padding: 0px 0 10px 0;font-size: 18px;font-family: verdana;font-weight: 600;border-bottom: 1px solid #ccc;"><b>Work / Practice History:</b></p></th></tr></thead></table></td></tr>';$doc_html .= '<tr><td style="padding:0;margin:0;vertical-align:middle;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;" cellspacing="0" cellpadding="0"><thead><tr><th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:24px;">';if(!empty($post_data['work_start'])){foreach($post_data['work_start'] as $start_key => $start_val){$doc_html .= '<p style="font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 15px;line-height:24px;"><b>' . $start_val . ' - ' . $post_data['work_end'][$start_key] . ' :</b> &nbsp;&nbsp;&nbsp;<span style=" margin: 0;padding: 0;margin-left: 30px;color: #666;">' . $post_data['work_history'][$start_key] . '</span></p>';}}$doc_html .= '</th></tr></thead></table></td></tr>';$doc_html .= '<tr><td style="padding:0;margin:0;vertical-align:middle;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;" cellspacing="0" cellpadding="0"><thead><tr style="border:1px solid #000000;border-color:#EEEEEE;border-width:1px;border-style: solid;border-width: 1px;border-color: #EEEEEE;"><th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:50px;"><p style="margin: 0;padding: 0px 0 10px 0;font-size: 18px;font-family: verdana;font-weight: 600;border-bottom: 1px solid #ccc;"><b>Other Work Experience:</b></p></th></tr></thead></table></td></tr>';$doc_html .= '<tr><td style="padding:0;margin:0;vertical-align:middle;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;" cellspacing="0" cellpadding="0"><thead><tr><th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:24px;">';if($post_data['other_work_start'][0] != ''){foreach($post_data['other_work_start'] as $other_start_key => $other_start_val){$doc_html .= '<p style="font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 15px;line-height:24px;"><b>' . $other_start_val . ' - ' . $post_data['other_work_end'][$other_start_key] . ' :</b> &nbsp;&nbsp;&nbsp;<span style=" margin: 0;padding: 0;margin-left: 30px;color: #666;">' . $post_data['other_work_exp'][$other_start_key] . '</span></p>';}}$doc_html .= '</th></tr></thead></table></td></tr>';$doc_html .= '<tr><td style="padding:0;margin:0;vertical-align:middle;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;" cellspacing="0" cellpadding="0"><thead><tr style="border:1px solid #000000;border-color:#EEEEEE;border-width:1px;border-style: solid;border-width: 1px;border-color: #EEEEEE;"><th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:50px;"><p style="margin: 0;padding: 0px 0 10px 0;font-size: 18px;font-family: verdana;font-weight: 600;border-bottom: 1px solid #ccc;"><b>Clinical / Procedural Skills:</b></p></th></tr></thead></table></td></tr>';$doc_html .= '<tr><td style="padding:0;margin:0;vertical-align:middle;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;" cellspacing="0" cellpadding="0"><thead><tr><th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:24px;"><p style="font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 15px;line-height:24px;">' . nl2br(strip_tags($post_data['skills'])) . '</p></th></tr></thead></table></td></tr>';$doc_html .= '<tr><td style="padding:0;margin:0;vertical-align:middle;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;" cellspacing="0" cellpadding="0"><thead><tr style="border:1px solid #000000;border-color:#EEEEEE;border-width:1px;border-style: solid;border-width: 1px;border-color: #EEEEEE;"><th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:50px;"><p style="margin: 0;padding: 0px 0 10px 0;font-size: 18px;font-family: verdana;font-weight: 600;border-bottom: 1px solid #ccc;"><b>Objectives / Goals / Personal Statement:</b></p></th></tr></thead></table></td></tr>';$doc_html .= '<tr><td style="padding:0;margin:0;vertical-align:middle;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;" cellspacing="0" cellpadding="0"><thead><tr><th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:24px;"><p style="font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 15px;line-height:24px;">' . nl2br(strip_tags($post_data['goals'])) . '</p></th></tr></thead></table></td></tr>';$doc_html .='<tr><td style="padding:0;margin:0;vertical-align:middle;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;" cellspacing="0" cellpadding="0"><thead><tr style="border:1px solid #000000;border-color:#EEEEEE;border-width:1px;border-style: solid;border-width: 1px;border-color: #EEEEEE;"><th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:50px;"><p style="margin: 0;padding: 0px 0 10px 0;font-size: 18px;font-family: verdana;font-weight: 600;border-bottom: 1px solid #ccc;"><b>Contact Details:</b></p></th></tr></thead></table></td></tr>';if(!empty($post_data['contact_details'])){$doc_html .= '<tr><td style="padding:0;margin:0;vertical-align:middle;"><table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;" cellspacing="0" cellpadding="0"><thead><tr><th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:24px;"><p style="font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 0px;">' .nl2br(strip_tags($post_data['contact_details'])).'</p></th></tr></thead></table></td></tr>';}$doc_html .= '</thead></table>';
            
            Html::addHtml($section,$doc_html);
            $phpWord->save(public_path('Documents/'.$post_data['name'].'.docx', 'Word2007'));
            return response()->download(public_path('Documents/'.$post_data['name'].'.docx'));
        }
        else
        {
            $phpWord->addParagraphStyle('Heading2', array('alignment' => 'center'));
            $phpWord->addParagraphStyle('Heading4', array('alignment' => 'center'));
            
            $doc_html = '<div style="margin: 0;padding: 0;border: 0;">';
            $doc_html .= '<h2  style="text-align: center;font-size: 36px;font-family: verdana;line-height: 100%;border: 0;padding: 0;margin: 0;padding-bottom: 0px;font-weight:bold;">Curriculum Vitae</h2>';
            $doc_html .= '<h4 style="text-align: center;font-size: 22px;font-family:verdana ;line-height: 50px;border: 0;padding: 0;margin: 0;padding-bottom: 0px;font-weight:bold;" >' . $post_data['name'] . '</h4><br></br>';
            $doc_html .= '<div style="margin: 0;padding: 0;vertical-align: top;padding-bottom: 15px;">';
            $doc_html .= '<h5 style="margin: 0;padding: 0px 0 5px 0;font-size: 18px;font-family: verdana;font-weight: 600;border: 0;"><b>Personal / Registration Information:</b></h5>';
            $doc_html .= '<p style="border: 0;font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 0;line-height:24px;font-weight: 600;"><b>Medical Registration:</b> ' . $post_data['reg_info'] . '</p>';
            $doc_html .= '</div>';
            
            if(!empty($post_data['edu_date'])){
               $doc_html .= '<div style="margin: 0;padding: 0;vertical-align: top;padding-bottom: 15px;">';
               $doc_html .= '<h5 style="margin: 0;padding: 0px 0 5px 0;font-size: 18px;font-family: verdana;font-weight: 600;border: 0;"><b>Qualifications / Education:</b></h5>';
               foreach($post_data['edu_date'] as $edu_key => $edu_val){
                  $doc_html .= '<p style="border: 0;font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 0;line-height:24px;font-weight: 600;"><b>' . $edu_val . ' :</b> ' . $post_data['education_info'][$edu_key] . '</p>';
               }
               $doc_html .= '</div>';
            }
            
            
            if(!empty($post_data['work_start'])){
               $doc_html .= '<div style="margin: 0;padding: 0;vertical-align: top;padding-bottom: 15px;">';
               $doc_html .= '<h5 style="margin: 0;padding: 0px 0 5px 0;font-size: 18px;font-family: verdana;font-weight: 600;border: 0;"><b>Work / Practice History:</b></h5>';
               foreach($post_data['work_start'] as $start_key => $start_val){
                  $doc_html .= '<p style="border: 0;font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 0;line-height:24px;font-weight: 600;"><b>' . $start_val . ' - ' . $post_data['work_end'][$start_key] . ' :</b> ' . $post_data['work_history'][$start_key] . '</p>';
               }
               $doc_html .= '</div>';
            }
            
            
            if($post_data['other_work_start'][0] != ''){
               $doc_html .= '<div style="margin: 0;padding: 0;vertical-align: top;padding-bottom: 15px;">';
               $doc_html .= '<h5 style="margin: 0;padding: 0px 0 5px 0;font-size: 18px;font-family: verdana;font-weight: 600;border: 0;"><b>Other Work Experience:</b></h5>';
                  foreach($post_data['other_work_start'] as $other_start_key => $other_start_val){
                     $doc_html .= '<p style="border: 0;font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 0;line-height:24px;font-weight: 600;"><b>' . $other_start_val . ' - ' . $post_data['other_work_end'][$other_start_key] . ' :</b> ' . $post_data['other_work_exp'][$other_start_key] . '</p>';
                  }
                  $doc_html .= '</div>';
            }
            
            $doc_html .= '<div style="margin: 0;padding: 0;vertical-align: top;padding-bottom: 15px;">';
            $doc_html .= '<h5 style="margin: 0;padding: 0px 0 5px 0;font-size: 18px;font-family: verdana;font-weight: 600;border: 0;"><b>Clinical / Procedural Skills :</b></h5>';
            $doc_html .= '<p style="border: 0;font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 0;line-height:24px;font-weight: 600;">';
            $doc_html .= nl2br(strip_tags($post_data['skills']));
            $doc_html .= '</p>';
            $doc_html .= '</div>';
            $doc_html .= '<div style="margin: 0;padding: 0;vertical-align: top;padding-bottom: 15px;">';
            $doc_html .= '<h5 style="margin: 0;padding: 0px 0 5px 0;font-size: 18px;font-family: verdana;font-weight: 600;border: 0;"><b>Objectives / Goals / Personal Statement :</b></h5>';
            $doc_html .= '<p style="border: 0;font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 0;line-height:24px;font-weight: 600;">';
            $doc_html .= nl2br(strip_tags($post_data['goals']));
            $doc_html .= '</p>';
            $doc_html .= '</div>';
            $doc_html .= '<div style="margin: 0;padding: 0;vertical-align: top;padding-bottom: 15px;">';
            $doc_html .= '<h5 style="margin: 0;padding: 0px 0 5px 0;font-size: 18px;font-family: verdana;font-weight: 600;border: 0;"><b>Contact Details :</b></h5>';
            $doc_html .= '<p style="border: 0;font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 0;line-height:24px;font-weight: 600;">';
            $doc_html .= nl2br(strip_tags($post_data['contact_details']));
            $doc_html .= '</p>';
            $doc_html .= '</div>';
            $doc_html .= '</div>';
            
            $mpdf = new Mpdf();
            $mpdf->WriteHTML($doc_html);
            $mpdf->Output($post_data['name'].".pdf", 'D');
        }

    }
}