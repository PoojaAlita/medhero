<?php
include_once 'vendor/phpoffice/phpword/bootstrap.php';

// New Word Document
// echo date('H:i:s') , ' Create new PhpWord object' , PHP_EOL;
$phpWord = new \PhpOffice\PhpWord\PhpWord();
// $phpWord->addParagraphStyle('Heading2', array('alignment' => 'center'));


$post_data = $_POST;

$section = $phpWord->addSection();



if(isset($post_data['export_to_doc'])){
   $doc_html = '<table style="width:100%;  border-spacing:0; vertical-align:middle; padding:0;" cellspacing="0" cellpadding="0" border="0">
   <thead>
   <tr>
      <td style="padding:0;margin:0;vertical-align:middle;">
         <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background-color: #eee;text-align: left;" cellspacing="0" cellpadding="0">
            <thead>
               <tr style="background-color: #FFFFFF;">
                  <th style="text-align:center;padding: 25px 35px;margin:0;vertical-align: middle;">
                     <p style="font-size: 36px;font-family: verdana;line-height: 100%;border-right: 1px solid #ddd;padding: 0;margin: 0;padding-right: 0;margin-right: 0;"><b>Curriculum Vitae</b></p>
                  </th>
               </tr>
            </thead>
         </table>
      </td>
   </tr>';

   $doc_html .= '<tr>
   <td style="padding:0;margin:0;vertical-align:middle;line-height:0;">
      <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background-color: #fffff;text-align: left;line-height:0;" cellspacing="0" cellpadding="0">
         <thead>
            <tr style="background-color: #ffffff;line-height:0;">
               <th style="text-align:left;padding:0;margin:0;vertical-align: middle;line-height:0;">
               <br></br>
               </th>
            </tr>
                  </thead>
            </table>
         </td>
      </tr>';
      $doc_html .= '<tr>
   <td style="padding:0;margin:0;vertical-align:middle;">
         <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background-color: #eee;text-align: left;" cellspacing="0" cellpadding="0">
            <thead>
               <tr style="background-color: #FFFFFF;">
                  <th style="text-align:center;padding: 25px 35px;margin:0;vertical-align: middle;">
                     <p style="font-size: 22px;font-family: verdana;line-height: 100%;border-right: 1px solid #ddd;padding: 0;margin: 0;padding-right: 0;margin-right: 0;">' . $post_data['name'] . '</p>
                  </th>
               </tr>
            </thead>
         </table>
      </td>
   </tr>';

   $doc_html .= '<tr>
   <td style="padding:0;margin:0;vertical-align:middle;line-height:0;">
      <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background-color: #fffff;text-align: left;line-height:0;" cellspacing="0" cellpadding="0">
         <thead>
            <tr style="background-color: #ffffff;line-height:0;">
               <th style="text-align:left;padding:0;margin:0;vertical-align: middle;line-height:0;">
               <br></br>
               </th>
            </tr>
                  </thead>
            </table>
         </td>
      </tr>';

      $doc_html .= '<tr>
      <td style="padding:0;margin:0;vertical-align:middle;">
         <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;text-align: left;" cellspacing="0" cellpadding="0">
            <thead>
               <tr style="border:1px solid #000000;border-color:#EEEEEE;border-width:1px;border-style: solid;border-width: 1px;border-color: #EEEEEE;">
                  <th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:50px;">
                     <p style="margin: 0;padding: 0px 0 10px 0;font-size: 18px;font-family: verdana;font-weight: 600;border-bottom: 1px solid #ccc;">Personal / Registration Information:</p>
                  </th>
               </tr>
            </thead>
         </table>
      </td>
   </tr>';

   $doc_html .= '<tr>
      <td style="padding:0;margin:0;vertical-align:middle;">
         <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;text-align: left;" cellspacing="0" cellpadding="0">
            <thead>
               <tr>
                  <th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:24px;">
                  
                  <p style="font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 15px;line-height:24px;"><b>Medical Registration:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=" margin: 0;padding: 0;margin-left: 0px;color: #666;">' . $post_data['reg_info'] . '</span></p>
                     
                  </th>
               </tr>
            </thead>
         </table>
      </td>
   </tr>';


   $doc_html .= '<tr>
      <td style="padding:0;margin:0;vertical-align:middle;">
         <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;text-align: left;" cellspacing="0" cellpadding="0">
            <thead>
               <tr style="border:1px solid #000000;border-color:#EEEEEE;border-width:1px;border-style: solid;border-width: 0px;border-color: #EEEEEE;">
                  <th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:50px;">
                     <p style="margin: 0;padding: 0px 0 10px 0;font-size: 18px;font-family: verdana;font-weight: 600;border-bottom: 1px solid #ccc;">Qualifications / Education:</p>
                  </th>
               </tr>
            </thead>
         </table>
      </td>
   </tr>';
   $doc_html .= '<tr>
      <td style="padding:0;margin:0;vertical-align:middle;">
         <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;text-align: left;" cellspacing="0" cellpadding="0">
            <thead>
               <tr>
                  <th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:24px;">';
                  if(!empty($post_data['edu_date'])){
                     foreach($post_data['edu_date'] as $edu_key => $edu_val){
                        $doc_html .= '<p style="font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 15px;line-height:24px;"><b>' . $edu_val . ':</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=" margin: 0;padding: 0;margin-left: 30px;color: #666;">' . $post_data['education_info'][$edu_key] . '</span></p>';
                     }
                  }
                     
   $doc_html .= '</th>
               </tr>
            </thead>
         </table>
      </td>
   </tr>';




   $doc_html .= '<tr>
   <td style="padding:0;margin:0;vertical-align:middle;">
      <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;text-align: left;" cellspacing="0" cellpadding="0">
         <thead>
            <tr style="border:1px solid #000000;border-color:#EEEEEE;border-width:1px;border-style: solid;border-width: 1px;border-color: #EEEEEE;">
               <th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:50px;">
                  <p style="margin: 0;padding: 0px 0 10px 0;font-size: 18px;font-family: verdana;font-weight: 600;border-bottom: 1px solid #ccc;">Work / Practice History:</p>
            </th>
            </tr>
         </thead>
      </table>
   </td>
   </tr>';

   $doc_html .= '<tr>
   <td style="padding:0;margin:0;vertical-align:middle;">
      <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;text-align: left;" cellspacing="0" cellpadding="0">
         <thead>
            <tr>
               <th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:24px;">';
               if(!empty($post_data['work_start'])){
                  foreach($post_data['work_start'] as $start_key => $start_val){
                     $doc_html .= '<p style="font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 15px;line-height:24px;"><b>' . $start_val . ' - ' . $post_data['work_end'][$start_key] . ':</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=" margin: 0;padding: 0;margin-left: 30px;color: #666;">' . $post_data['work_history'][$start_key] . '</span></p>';
                  }
               }
   $doc_html .= '</th>
            </tr>
         </thead>
      </table>
   </td>
   </tr>';



   $doc_html .= '<tr>
   <td style="padding:0;margin:0;vertical-align:middle;">
   <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;text-align: left;" cellspacing="0" cellpadding="0">
      <thead>
         <tr style="border:1px solid #000000;border-color:#EEEEEE;border-width:1px;border-style: solid;border-width: 1px;border-color: #EEEEEE;">
            <th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:50px;">
               <p style="margin: 0;padding: 0px 0 10px 0;font-size: 18px;font-family: verdana;font-weight: 600;border-bottom: 1px solid #ccc;">Other Work Experience:</p>
            </th>
         </tr>
      </thead>
   </table>
   </td>
   </tr>';
   $doc_html .= '<tr>
   <td style="padding:0;margin:0;vertical-align:middle;">
   <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;text-align: left;" cellspacing="0" cellpadding="0">
      <thead>
         <tr>
            <th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:24px;">';
            if($post_data['other_work_start'][0] != ''){
                  foreach($post_data['other_work_start'] as $other_start_key => $other_start_val){
                     $doc_html .= '<p style="font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 15px;line-height:24px;"><b>' . $other_start_val . ' - ' . $post_data['other_work_end'][$other_start_key] . '</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=" margin: 0;padding: 0;margin-left: 30px;color: #666;">' . $post_data['other_work_exp'][$other_start_key] . '</span></p>';
                  }
            }
   $doc_html .= '</th>
         </tr>
      </thead>
   </table>
   </td>
   </tr>';



   $doc_html .= '<tr>
   <td style="padding:0;margin:0;vertical-align:middle;">
   <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;text-align: left;" cellspacing="0" cellpadding="0">
      <thead>
         <tr style="border:1px solid #000000;border-color:#EEEEEE;border-width:1px;border-style: solid;border-width: 1px;border-color: #EEEEEE;">
            <th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:50px;">
               <p style="margin: 0;padding: 0px 0 10px 0;font-size: 18px;font-family: verdana;font-weight: 600;border-bottom: 1px solid #ccc;">Clinical / Procedural Skills:</p>
            </th>
         </tr>
      </thead>
   </table>
   </td>
   </tr>';

   $doc_html .= '<tr>
   <td style="padding:0;margin:0;vertical-align:middle;">
   <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;text-align: left;" cellspacing="0" cellpadding="0">
      <thead>
         <tr>
            <th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:24px;">
            
            <p style="font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 15px;line-height:24px;">' . nl2br(strip_tags($post_data['skills'])) . '</p>
               
            </th>
         </tr>
      </thead>
   </table>
   </td>
   </tr>';



   $doc_html .= '<tr>
   <td style="padding:0;margin:0;vertical-align:middle;">
   <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;text-align: left;" cellspacing="0" cellpadding="0">
      <thead>
         <tr style="border:1px solid #000000;border-color:#EEEEEE;border-width:1px;border-style: solid;border-width: 1px;border-color: #EEEEEE;">
            <th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:50px;">
               <p style="margin: 0;padding: 0px 0 10px 0;font-size: 18px;font-family: verdana;font-weight: 600;border-bottom: 1px solid #ccc;">Objectives / Goals / Personal Statement:</p>
            </th>
         </tr>
      </thead>
   </table>
   </td>
   </tr>';

   $doc_html .= '<tr>
   <td style="padding:0;margin:0;vertical-align:middle;">
   <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;text-align: left;" cellspacing="0" cellpadding="0">
      <thead>
         <tr>
            <th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:24px;">
            
            <p style="font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 15px;line-height:24px;">' . nl2br(strip_tags($post_data['goals'])) . '</p>
               
            </th>
         </tr>
      </thead>
   </table>
   </td>
   </tr>';



   $doc_html .= '<tr>
   <td style="padding:0;margin:0;vertical-align:middle;">
   <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;text-align: left;" cellspacing="0" cellpadding="0">
      <thead>
         <tr style="border:1px solid #000000;border-color:#EEEEEE;border-width:1px;border-style: solid;border-width: 1px;border-color: #EEEEEE;">
            <th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:50px;">
               <p style="margin: 0;padding: 0px 0 10px 0;font-size: 18px;font-family: verdana;font-weight: 600;border-bottom: 1px solid #ccc;">Contact Details:</p>
            </th>
         </tr>
      </thead>
   </table>
   </td>
   </tr>';

   if(!empty($post_data['contact_details'])){
      $doc_html .= '<tr>
      <td style="padding:0;margin:0;vertical-align:middle;">
      <table style="width: 100%;padding: 0;margin: 0 auto;border-spacing: 0;vertical-align: middle;background: #fff;text-align: left;" cellspacing="0" cellpadding="0">
         <thead>
            <tr>
            <th style="vertical-align: middle;padding: 15px;background: transparent;margin: 0;margin-bottom: 0;line-height:24px;">
            
            <p style="font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 0px;line-height:24px;">' . nl2br(strip_tags($post_data['contact_details'])) . '</p>
                  
            </th>
            </tr>
         </thead>
      </table>
      </td>
      </tr>';
   }


   $doc_html .= '</thead>
   </table>';
   \PhpOffice\PhpWord\Shared\Html::addHtml($section, $doc_html, false, false);
   $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
   // $objWriter->save('php://output');
   $objWriter->save($post_data['name'] . '.docx');
   $file_name = $post_data['name'].'.docx';
}
else{
   $phpWord->addParagraphStyle('Heading2', array('alignment' => 'center'));
   $phpWord->addParagraphStyle('Heading4', array('alignment' => 'center'));
   
   $doc_html = '<div style="margin: 0;padding: 0;border: 0;">';
   $doc_html .= '<h2 style="text-align: center;font-size: 36px;font-family: verdana;line-height: 100%;border: 0;padding: 0;margin: 0;padding-bottom: 0px;font-weight:bold;text-align:center !important;">Curriculum Vitae</h2>';
   $doc_html .= '<h4 style="text-align: center;font-size: 22px;font-family: verdana;line-height: 100%;border: 0;padding: 0;margin: 0;padding-bottom: 0px;font-weight:bold;">' . $post_data['name'] . '</h4><br></br>';
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
         $doc_html .= '<p style="border: 0;font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 0;line-height:24px;font-weight: 600;"><b>' . $start_val . ' - ' . $post_data['work_end'][$start_key] . ':</b> ' . $post_data['work_history'][$start_key] . '</p>';
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
   $doc_html .= '<h5 style="margin: 0;padding: 0px 0 5px 0;font-size: 18px;font-family: verdana;font-weight: 600;border: 0;"><b>Clinical / Procedural Skills:</b></h5>';
   $doc_html .= '<p style="border: 0;font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 0;line-height:24px;font-weight: 600;">';
   $doc_html .= nl2br(strip_tags($post_data['skills']));
   $doc_html .= '</p>';
   $doc_html .= '</div>';
   $doc_html .= '<div style="margin: 0;padding: 0;vertical-align: top;padding-bottom: 15px;">';
   $doc_html .= '<h5 style="margin: 0;padding: 0px 0 5px 0;font-size: 18px;font-family: verdana;font-weight: 600;border: 0;"><b>Objectives / Goals / Personal Statement:</b></h5>';
   $doc_html .= '<p style="border: 0;font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 0;line-height:24px;font-weight: 600;">';
   $doc_html .= nl2br(strip_tags($post_data['goals']));
   $doc_html .= '</p>';
   $doc_html .= '</div>';
   $doc_html .= '<div style="margin: 0;padding: 0;vertical-align: top;padding-bottom: 15px;">';
   $doc_html .= '<h5 style="margin: 0;padding: 0px 0 5px 0;font-size: 18px;font-family: verdana;font-weight: 600;border: 0;"><b>Contact Details:</b></h5>';
   $doc_html .= '<p style="border: 0;font-size: 14px;font-family: verdana;color: #333;margin: 0;padding: 0;padding-top: 0;line-height:24px;font-weight: 600;">';
   $doc_html .= nl2br(strip_tags($post_data['contact_details']));
   $doc_html .= '</p>';
   $doc_html .= '</div>';
   $doc_html .= '</div>';

   

   

   \PhpOffice\PhpWord\Shared\Html::addHtml($section, $doc_html, false, false);
   $rendererLibraryPath = \PhpOffice\PhpWord\Settings::setPdfRendererPath('vendor/phpoffice/phpword/src/PhpWord/Writer/PDF/MPDF.php');
   $rendererName = \PhpOffice\PhpWord\Settings::setPdfRendererName('MPDF');
   \PhpOffice\PhpWord\Settings::setPdfRenderer($rendererName, $rendererLibraryPath);
   $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');
   $objWriter->save($post_data['name'].'.pdf');
   $file_name = $post_data['name'].'.pdf';
}

// header('Content-Description: File Transfer');
// header('Content-Type: application/force-download');
// header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
// header('Expires: 0');
// header('Cache-Control: must-revalidate');
// header('Pragma: public');
// header('Content-Length: ' . filesize($file));
// readfile($file);
// exit;



header("Content-Disposition: attachment; filename=$file_name");
header('Content-Type: application/vnd.openxmlformats-officedocument.' .'wordprocessingml.document');
flush();
readfile($file_name);
exit;
header('Content-Type: application/vnd.openxmlformats-officedocument.' .'wordprocessingml.document');
header("Content-Transfer-Encoding: Binary"); 
header('Content-Length: ' . filesize($file_name)); 
header("Content-disposition: attachment; filename=\"".$file_name."\""); 
readfile($file_name);
exit;

?>