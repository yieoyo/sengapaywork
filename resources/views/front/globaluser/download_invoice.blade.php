<?php
require_once(__DIR__.'/../../../vendor/autoload.php');
//require_once(APP_PATH.'/mpdf_/src/Mpdf.php');
$mpdf = new \Mpdf\Mpdf();
$mpdf->shrink_tables_to_fit = 1;
$mpdf->setAutoTopMargin = 'stretch'; 
$mpdf->autoMarginPadding = '0'; 
$html='<style>@page table, caption, tbody, tfoot, thead, th, .content_table{
    margin: 0;
    padding-top: 4px;  
    font-size: 100%;
    vertical-align: baseline;
    background: transparent;
}</style> 
    '; 
// Define the Header/Footer before writing anything so they appear on the first page
$mpdf->SetHTMLHeader('
<table autosize="1" border="1" width="100%" class="content_table" style="border-collapse:collapse;">
	<tr style="background-color:#ddd;">
		<td colspan="5" style="text-align: center;" width="100%">List of Sites In SecCast</td> 
	</tr> 
	<tr style="background-color:#ddd;">
		<th width="5%">#</th>
		<th width="20%">SITE</th>
		<th width="35%">EMAIL</th>
		<th width="20%">PHONE</th>
		<th width="20%">STATUS</th>
	</tr>' 
);
$mpdf->WriteHTML($html);
$form_documents ='';
	if(!empty($thead)){
$form_documents .='';  
	foreach($thead as $record){ 
		$form_documents	.='
		<tr>
			<td width="5%">'.$record['sn'].'</td>
			<td width="20%">'.$record['name'].'</td>
			<td width="35%">'.$record['email'].'</td>
			<td width="20%">'.$record['phone'].'</td>
			<td width="20%">'.$record['status'].'</td>
		</tr>';
	} 
$form_documents .=' 
		</table>';
	}
$mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="50%" style="text-align: left;">{DATE j-m-Y}</td> 
        <td width="50%" style="text-align: right;">{PAGENO}/{nbpg}</td>
    </tr>
</table>');

$mpdf->WriteHTML($form_documents);

$mpdf->Output('site.pdf','D');
die;
