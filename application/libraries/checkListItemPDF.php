<?php
session_start();
if( !defined( "__APP_PATH__" ) )
define( "__APP_PATH__", realpath( dirname( __FILE__ ) . "/" ) );
require_once( __APP_PATH__ . "/inc/constants.php" );
require_once( __APP_PATH__ . "/inc/functions.php" );
require_once( __APP_PATH__ . "/inc/new_user_function.php" );
require_once(__APP_PATH__ . "/tcpdf/tcpdf.php");

require_once( __APP_PATH_CLASSES__ . "/user.class.php" );
require_once( __APP_PATH_CLASSES__ . "/setup.class.php" );
require_once( __APP_PATH_CLASSES__ . "/medical.class.php" );
require_once( __APP_PATH_CLASSES__ . "/goal.class.php" );
require_once( __APP_PATH_CLASSES__ . "/userworkout.class.php" );
$kUser= new cUser();
$kSetup = new cSetup();

if((int)$_SESSION['userFl40PlusAry']['id']==0)
{
    header("Location:".__BASE_WP_URL__);
    die();
}

$userArr=$kUser->userDetailsById($_SESSION['userFl40PlusAry']['id']);

$file_name=__APP_PATH_PDF_FILES__."/userCheckListItem.pdf";
  class ACFIPDF extends TCPDF
    {

                //Page header
                function Header() 
                {	
                        //overwriting header function 
                }

                // Page footer
                function Footer() 
                {
                         // Position at 15 mm from bottom
                 $this->SetY(-6);
                  // Set font
                 $this->SetFont('helvetica', 'I', 10);
                 // Page number
                 $this->SetTitle('FL40Plus Printout');  
                 $footer_table = '
                        <table width="100%" cellspacing="0" cellpadding="0">
                                        <tr nobr="true">
                                                <td width="33%" align="left"  style="font-weight:bold;">
                                                        
                                                                 Fitness Lifestyle 40Plus
                                                       
                                                </td>
                                                <td width="33%" align="center" style="font-weight:bold;">
                                                        <strong>Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages().'</strong>
                                                </td>
                                                <td width="33%" align="right">
                                                </td>
                                        </tr>
                                </table>
                 ';
                        //overwriting footer function	
                        $this->writeHTML($footer_table, true, false, true, false, '');
                }
    }
    $kPdf=new ACFIPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);;		

    $logoPath=__APP_PATH__."/theme/assets/admin/layout/img/logo.png";
    
   
    $string .='<table cellpadding="3" cellspacing="1" border="0" valign="bottom">
                        <tr nobr="true">
                            <td align="left" valign="bottom" colspan="3" ><img src="'.$logoPath.'"></td>
                            <td align="left" valign="bottom" style="color:#1e5899;font-weight:bold;font-size:11px;">Helping you live a longer & healthier life...</td>                                
                        </tr>	
                </table>
                <table cellpadding="3" cellspacing="1" border="0">
                 <tr nobr="true">
                                <td align="center" valign="bottom" style="color:#1e5899;font-weight:bold;font-size:16px;">Member\'s Check List Item Report </td>
                        </tr>
                </table>               	
                <table cellpadding="3" cellspacing="1" border="0">                      
                       <thead>
                        <tr>
                                <th style="border-left:solid 1px #000;border-top:solid 1px #000;" align="left" valign="bottom" width="15%" bgcolor="#C2C2C2">Type</th>
                                <th style="border-left:solid 1px #000;border-top:solid 1px #000;" align="left" valign="bottom" width="15%" bgcolor="#C2C2C2">Module </th>  
                                <th style="border-left:solid 1px #000;border-top:solid 1px #000;" align="left" valign="bottom" width="65%" bgcolor="#C2C2C2">Description </th>                                
                                <th style="border-left:solid 1px #000;border-right:solid 1px #000;border-top:solid 1px #000;" align="left" valign="bottom" width="5%" bgcolor="#C2C2C2">&nbsp;&nbsp;</th>                                
                        </tr></thead><tbody> ';
    
$PersonalFlag=false;
$noRecordFlag=true;
$checkListArr=array();
$ctr=0;
$checkListArr=userCheckListItem();
    
$toalCount = count($checkListArr);
                    if(!empty($checkListArr))
                    {
                        $i=1;
                        foreach($checkListArr as $checkListArrs)
                        {    
                            $style="";
                            if($i%2==0)
                            {
                               $style='bgcolor="#ddd"';
                            }
                                                      
                            $styleCode='';
                            if($toalCount==$i)
                            {
                                $styleCode='border-bottom:solid 1px #000;';
                            }
                            
                             
                            $string .='<tr>
                                <td style="'.$styleCode.'border-left:solid 1px #000;border-top:solid 1px #000;" align="left" valign="bottom" width="15%" '.$style.'>'.$checkListArrs['szType'].'</td>
                                <td style="'.$styleCode.'border-left:solid 1px #000;border-top:solid 1px #000;" align="left" valign="bottom" width="15%" '.$style.'>'.$checkListArrs['szModule'].'</td>
                                <td style="'.$styleCode.'border-left:solid 1px #000;border-right:solid 1px #000;border-top:solid 1px #000;" align="left" valign="bottom" width="65%" '.$style.'>'.$checkListArrs['szDescription'].'</td>     
                                <td style="'.$styleCode.'border-left:solid 1px #000;border-right:solid 1px #000;border-top:solid 1px #000;" align="left" valign="bottom" width="5%" '.$style.'><img src="'.__APP_PATH__.'/img/pdf-checkbox.jpg"></td>     
                               
                        </tr>';
                        ++$i;                           
                       }
                   }
                   	
                   
                        
               $string .='</tbody></table>';

        //set page margins left top right
        $kPdf->SetMargins(5, 5, 5);

        // set auto page breaks and bottom margin
        $kPdf->SetAutoPageBreak(true, 10);

        $fontname = $kPdf->addTTFfont(__APP_PATH__.'/tcpdf/fonts/Calibri.ttf', 'TrueTypeUnicode', '', 32);
        // set page font
        $kPdf->SetFont($fontname, 'NN', 10);

        // add a page
        $kPdf->AddPage('L');

        $kPdf->WriteHTML($string, true, false, true, false, '');
        //echo $file_name;
        //Close and output PDF document
        $kPdf->Output($file_name,'I');	      

?>



