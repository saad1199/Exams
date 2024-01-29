<?php
function convertNumberToWord($num = false)
{
   $num = str_replace(array(',', ' '), '', trim($num));
   if (!$num) {
      return false;
   }
   $num = (int) $num;
   $words = array();
   $list1 = array(
      '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
      'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
   );
   $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
   $list3 = array(
      '', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
      'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
      'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
   );
   $num_length = strlen($num);
   $levels = (int) (($num_length + 2) / 3);
   $max_length = $levels * 3;
   $num = substr('00' . $num, -$max_length);
   $num_levels = str_split($num, 3);
   for ($i = 0; $i < count($num_levels); $i++) {
      $levels--;
      $hundreds = (int) ($num_levels[$i] / 100);
      $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
      $tens = (int) ($num_levels[$i] % 100);
      $singles = '';
      if ($tens < 20) {
         $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
      } else {
         $tens = (int)($tens / 10);
         $tens = ' ' . $list2[$tens] . ' ';
         $singles = (int) ($num_levels[$i] % 10);
         $singles = ' ' . $list1[$singles] . ' ';
      }
      $words[] = $hundreds . $tens . $singles . (($levels && (int) ($num_levels[$i])) ? ' ' . $list3[$levels] . ' ' : '');
   } //end for loop
   $commas = count($words);
   if ($commas > 1) {
      $commas = $commas - 1;
   }
   return implode(' ', $words);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style-print.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <title>Document</title>
</head>
<script>
   function PrintElem(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = '';
      document.body.innerHTML += printContents;
      window.print();

      document.body.innerHTML = originalContents;
   }

   function Print() {
      PrintElem("report");

   }
</script>

<body>

<button onclick="Print();" value="Print" style="width:100px; background-color:red; color:white;">Print</button>

<div id="report">

<div class="wrap">
      <table style=" width:100%;">
         <thead>
            <tr>
               <th class="bnk">
                  <h5 class="copy">Bank Copy
                  </h5>
               </th>
               <th class="form">
                  <h2 class="chln" style="color:white; background-color:black; padding:5px;">Challan Form No. 32-A</h2>
               </th>
               <th class="nbp"><u>Treasury/Sub-Treasury</u><br> <u>National Bank of Pakistan</u> <br>
                  <u>State Bank of Pakistan</u>
               </th>
            </tr>
         </thead>
      </table>


      <p class="paid">Challan of cash paid to the </p>
      <table class="head">
         <thead>
            <tr>
               <th class="rem">To be filled in by the remitter</th>
               <th class="dep">To be filled in by the
                  <br> Department officer or the Treasury
               </th>
            </tr>
         </thead>
      </table>
      <table class="container">
         <thead>
            <tr>
               <th class="can">By whom tendered (Name of the candidate)</th>
               <th class="des">Name (or Designation) &nbsp;and the address of the person on whose behalf money is paid</th>
               <th class="auth">Full particulars of the remittance and of authority (if any)</th>
               <th class="amt">Amount <br>
                  Rs.
               </th>
               <th class="hoa">Head <br> of <br> account</th>
               <th class="ottb">Order to the <br> Bank</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td id="cid"></td>
               <td id="cname">Federal Directorate of Education G-9/4 Islamabad</td>
               <td>Federal Directorate of Education Islamabad Examination Board Fee</td>
               <td id="camt"></td>
               <td><br><br><br><br>C-02818</td>
               <td>
                  <p>Date
                     <br>
                     <br>
                     <br>
                     <br>
                     <br>
                     Correct,
                     <br>
                     received and
                     <br>
                     grant receipt
                     <br>
                     <br>
                     <br>
                     (signature
                     <br>
                     and full
                     <br>
                     designation
                     <br>
                     of the officer
                     <br>
                     odering the
                     <br>
                     money to
                     <br>
                     paid in)
                  </p>
               </td>
            </tr>
         </tbody>
      </table>
      <table style="width:100%;">
         <thead class="footer">
            <tr>
               <th style="width:50%;">
                  <p class="sgn">Signature__________________<br>(in word) Rupees <u id="amtwords"></u></p>
               </th>


               <th>
                  <p class="sgn">Total_________________</p>
               </th>


               <th style="text-align:left;">To be used only in the case of remittance to Bank through an officer of the Goveronment</th>
            </tr>
         </thead>
      </table>
      <p class="rss">Received Payments(in words)___________</p>
      <table style="width:100%;">
         <thead class="footers">
            <tr>
               <th>
                  <p class="sgn">Treasure</p>
               </th>
               <th>
                  <p class="sgn">Accountant</p>
               </th>
               <th>
               <p class="sgn"> DUE DATE: <u>EXPIRED</u></p>
               </th>
               <th class="nb">Back Officer Account</th>
            </tr>
         </thead>
      </table>
   </div>

   <div class="wrap">
      <table style=" width: 100%;">
         <thead>
            <tr>
               <th class="bnk">
                  <h5 class="copy">Office Copy
                  </h5>
               </th>
               <th class="form">
                  <h2 class="chln" style="color:white; background-color:black; padding:5px;">Challan Form No. 32-A</h2>
               </th>
               <th class="nbp"><u>Treasury/Sub-Treasury</u><br> <u>National Bank of Pakistan</u> <br>
                  <u>State Bank of Pakistan</u>
               </th>
            </tr>
         </thead>
      </table>


      <p class="paid">Challan of cash paid to the </p>
      <table class="head">
         <thead>
            <tr>
               <th class="rem">To be filled in by the remitter</th>
               <th class="dep">To be filled in by the
                  <br> Department officer or the Treasury
               </th>
            </tr>
         </thead>
      </table>
      <table class="container">
         <thead>
            <tr>
               <th class="can">By whom tendered (Name of the candidate)</th>
               <th class="des">Name (or Designation) &nbsp;and the address of the person on whose behalf money is paid</th>
               <th class="auth">Full particulars of the remittance and of authority (if any)</th>
               <th class="amt">Amount <br>
                  Rs.
               </th>
               <th class="hoa">Head <br> of <br> account</th>
               <th class="ottb">Order to the <br> Bank</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td id="cid2"></td>
               <td id="cname2">Federal Directorate of Education G-9/4 Islamabad</td>
               <td>Federal Directorate of Education Islamabad Examination Board Fee</td>
               <td id="camt2"></td>
               <td><br><br><br><br>C-02818</td>
               <td>
                  <p>Date
                     <br>
                     <br>
                     <br>
                     <br>
                     <br>
                     Correct,
                     <br>
                     received and
                     <br>
                     grant receipt
                     <br>
                     <br>
                     <br>
                     (signature
                     <br>
                     and full
                     <br>
                     designation
                     <br>
                     of the officer
                     <br>
                     odering the
                     <br>
                     money to
                     <br>
                     paid in)
                  </p>
               </td>
            </tr>
         </tbody>
      </table>
      <table style="width:100%;">
         <thead class="footer">
            <tr>
               <th style="width:50%;">
                  <p class="sgn">Signature__________________<br>(in word) Rupees <u id="amtwords2"></u></p></p> 
               </th>


               <th>
                  <p class="sgn">Total_________________</p>
               </th>


               <th style="text-align:left;">To be used only in the case of remittance to Bank through an officer of the Goveronment</th>
            </tr>
         </thead>
      </table>
      <p class="rss">Received Payments(in words)___________</p>
      <table style="width:100%;">
         <thead class="footers">
            <tr>
               <th>
                  <p class="sgn">Treasure</p>
               </th>
               <th>
                  <p class="sgn">Accountant</p>
               </th>
               <th>
               <p class="sgn">DUE DATE: <u>EXPIRED</u></p>
               </th>
               <th class="nb">Back Officer Account</th>
            </tr>
         </thead>
      </table>
   </div>
   <div class="wrap">
      <table style=" width: 100%;">
         <thead>
            <tr>
               <th class="bnk">
                  <h5 class="copy">Student Copy
                  </h5>
               </th>
               <th class="form">
                  <h2 class="chln" style="color:white; background-color:black; padding:5px;">Challan Form No. 32-A</h2>
               </th>
               <th class="nbp"><u>Treasury/Sub-Treasury</u><br> <u>National Bank of Pakistan</u> <br>
                  <u>State Bank of Pakistan</u>
               </th>
            </tr>
         </thead>
      </table>


      <p class="paid">Challan of cash paid to the </p>
      <table class="head">
         <thead>
            <tr>
               <th class="rem">To be filled in by the remitter</th>
               <th class="dep">To be filled in by the
                  <br> Department officer or the Treasury
               </th>
            </tr>
         </thead>
      </table>
      <table class="container">
         <thead>
            <tr>
               <th class="can">By whom tendered (Name of the candidate)</th>
               <th class="des">Name (or Designation) &nbsp;and the address of the person on whose behalf money is paid</th>
               <th class="auth">Full particulars of the remittance and of authority (if any)</th>
               <th class="amt">Amount <br>
                  Rs.
               </th>
               <th class="hoa">Head <br> of <br> account</th>
               <th class="ottb">Order to the <br> Bank</th>
            </tr>
         </thead>
         <tbody>
           <tr>
               <td id="cid3"></td>
               <td id="cname3">Federal Directorate of Education G-9/4 Islamabad</td>
               <td>Federal Directorate of Education Islamabad Examination Board Fee</td>
               <td id="camt3"></td>
               <td><br><br><br><br>C-02818</td>
               <td>
                  <p>Date
                     <br>
                     <br>
                     <br>
                     <br>
                     <br>
                     Correct,
                     <br>
                     received and
                     <br>
                     grant receipt
                     <br>
                     <br>
                     <br>
                     (signature
                     <br>
                     and full
                     <br>
                     designation
                     <br>
                     of the officer
                     <br>
                     odering the
                     <br>
                     money to
                     <br>
                     paid in)
                  </p>
               </td>
            </tr>
         </tbody>
      </table>
      <table style="width:100%;">
         <thead class="footer">
            <tr>
               <th style="width:50%;">
                  <p class="sgn">Signature__________________<br>(in word) Rupees <u id="amtwords3"></u></p></p>
               </th>


               <th>
                  <p class="sgn">Total_________________</p>
               </th>


               <th style="text-align:left;">To be used only in the case of remittance to Bank through an officer of the Goveronment</th>
            </tr>
         </thead>
      </table>
      <p class="rss">Received Payments(in words)___________</p>
      <table style="width:100%;">
         <thead class="footers">
            <tr>
               <th>
                  <p class="sgn">Treasure</p>
               </th>
               <th>
                  <p class="sgn">Accountant</p>
               </th>
               <th>
               <p class="sgn">DUE DATE: <u>EXPIRED</u></p>
               </th>
               <th class="nb">Back Officer Account</th>
            </tr>
         </thead>
      </table>
   </div>
   </div>
</body>
<script>
function doConvert (numberInput){
    let oneToTwenty = ['','ONE ','TWO ','THREE ','FOUR ', 'FIVE ','SIX ','SEVEN ','EIGHT ','NINE ','TEN ',
    'ELEVEN ','TWELVE ','THIRTEEN ','FOURTEEN ','FIFTEEN ','SIXTEEN ','SEVENTEEN ','EIGHTEEN ','NINETEEN '];
    let tenth = ['', '', 'TWENTY','THIRTY','FOURTY','FIFTY', 'SIXTY','SEVENTY','EIGHTY','NINETY'];

    if(numberInput.toString().length > 7) return myDiv.innerHTML = 'overlimit' ;
    console.log(numberInput);
    //let num = ('0000000000'+ numberInput).slice(-10).match(/^(\d{1})(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
  let num = ('0000000'+ numberInput).slice(-7).match(/^(\d{1})(\d{1})(\d{2})(\d{1})(\d{2})$/);
   
    if(!num) return;

    let outputText = num[1] != 0 ? (oneToTwenty[Number(num[1])] || `${tenth[num[1][0]]} ${oneToTwenty[num[1][1]]}` )+' MILLION ' : ''; 
  
    outputText +=num[2] != 0 ? (oneToTwenty[Number(num[2])] || `${tenth[num[2][0]]} ${oneToTwenty[num[2][1]]}` )+'HUNDRED ' : ''; 
    outputText +=num[3] != 0 ? (oneToTwenty[Number(num[3])] || `${tenth[num[3][0]]} ${oneToTwenty[num[3][1]]}`)+' THOUSAND ' : ''; 
    outputText +=num[4] != 0 ? (oneToTwenty[Number(num[4])] || `${tenth[num[4][0]]} ${oneToTwenty[num[4][1]]}`) +'HUNDRED ': ''; 
    outputText +=num[5] != 0 ? (oneToTwenty[Number(num[5])] || `${tenth[num[5][0]]} ${oneToTwenty[num[5][1]]} `) : ''; 

   return outputText;
}

$.ajax({
    url: 'Engine/getChallan.php',
    data: {
      "token": "<?php echo $_SESSION['session_token']; ?>"
    },
    type: "GET",
    async: false,
    dataType: "json",
    success: function(myJson) {
      
      
      if(myJson[0].challan_id==null){
       

      }
        alert(myJson[0].challan_id);
      document.getElementById('cid').innerHTML = "EXPIRED "+myJson[0].challan_id+"<br><br>"+"<?php echo $_GET['name'];?>";
      document.getElementById('cid2').innerHTML = "EXPIRED "+myJson[0].challan_id+"<br><br>"+"<?php echo $_GET['name'];?>";
      document.getElementById('cid3').innerHTML = "EXPIRED "+myJson[0].challan_id+"<br><br>"+"<?php echo $_GET['name'];?>";
      
      
      if(myJson[0].challan_fee_type_fee_type_id==null){


         if(myJson[0].challan_difference!=null){
//adjusted
var senior_total = (parseFloat(myJson[0].challan_total_amount)-parseFloat(myJson[0].challan_difference));

document.getElementById('camt').innerHTML = "Rs. &nbsp;"+myJson[0].challan_total_amount+"/- (LATE)<br>Rs. -"+myJson[0].challan_difference+"/- (adj.)<br>____________<br><strong>Rs. "+senior_total+"/- (BAL.)</strong>";
document.getElementById('amtwords').innerHTML = doConvert(senior_total)+" ONLY";
document.getElementById('camt2').innerHTML = "Rs. &nbsp;"+myJson[0].challan_total_amount+"/- (LATE)<br>Rs. -"+myJson[0].challan_difference+"/- (adj.)<br>____________<br><strong>Rs. "+senior_total+"/- (BAL.)</strong>";
document.getElementById('amtwords2').innerHTML = doConvert(senior_total)+" ONLY";
document.getElementById('camt3').innerHTML = "Rs. &nbsp;"+myJson[0].challan_total_amount+"/- (LATE)<br>Rs. -"+myJson[0].challan_difference+"/- (adj.)<br>____________<br><strong>Rs. "+senior_total+"/- (BAL.)</strong>";
document.getElementById('amtwords3').innerHTML = doConvert(senior_total)+" ONLY";

         }else{
//un-adjusted

document.getElementById('camt').innerHTML = "Rs. "+myJson[0].challan_total_amount+"/-";
document.getElementById('amtwords').innerHTML = doConvert(myJson[0].challan_total_amount)+" ONLY";
         
document.getElementById('camt2').innerHTML = "Rs. "+myJson[0].challan_total_amount+"/-";
document.getElementById('amtwords2').innerHTML = doConvert(myJson[0].challan_total_amount)+" ONLY";
         
document.getElementById('camt3').innerHTML = "Rs. "+myJson[0].challan_total_amount+"/-";
document.getElementById('amtwords3').innerHTML = doConvert(myJson[0].challan_total_amount)+" ONLY";



         }
      }else{
          
          
          
if(myJson[0].challan_difference!=null){

//adjusted
var senior_total = (parseFloat(myJson[0].challan_total_amount)-parseFloat(myJson[0].challan_difference));

document.getElementById('camt').innerHTML = "Rs. &nbsp;"+myJson[0].challan_total_amount+"/- (LATE)<br>Rs. -"+myJson[0].challan_difference+"/- (adj.)<br>____________<br><strong>Rs. "+senior_total+"/- (BAL.)</strong>";
document.getElementById('amtwords').innerHTML = doConvert(senior_total)+" ONLY";
document.getElementById('camt2').innerHTML = "Rs. &nbsp;"+myJson[0].challan_total_amount+"/- (LATE)<br>Rs. -"+myJson[0].challan_difference+"/- (adj.)<br>____________<br><strong>Rs. "+senior_total+"/- (BAL.)</strong>";
document.getElementById('amtwords2').innerHTML = doConvert(senior_total)+" ONLY";
document.getElementById('camt3').innerHTML = "Rs. &nbsp;"+myJson[0].challan_total_amount+"/- (LATE)<br>Rs. -"+myJson[0].challan_difference+"/- (adj.)<br>____________<br><strong>Rs. "+senior_total+"/- (BAL.)</strong>";
document.getElementById('amtwords3').innerHTML = doConvert(senior_total)+" ONLY";

         }else{
//un-adjusted

document.getElementById('camt').innerHTML = "Rs. "+myJson[0].challan_total_amount+"/-";
document.getElementById('amtwords').innerHTML = doConvert(myJson[0].challan_total_amount)+" ONLY";
         
document.getElementById('camt2').innerHTML = "Rs. "+myJson[0].challan_total_amount+"/-";
document.getElementById('amtwords2').innerHTML = doConvert(myJson[0].challan_total_amount)+" ONLY";
         
document.getElementById('camt3').innerHTML = "Rs. "+myJson[0].challan_total_amount+"/-";
document.getElementById('amtwords3').innerHTML = doConvert(myJson[0].challan_total_amount)+" ONLY";



         }
          
        //  document.getElementById('camt').innerHTML = "Rs. "+myJson[0].fee_type_amount+"/- <br>("+myJson[0].fee_type_det+")";
        //  document.getElementById('amtwords').innerHTML = doConvert(myJson[0].fee_type_amount)+" ONLY"; 
         
        //  document.getElementById('camt2').innerHTML = "Rs. "+myJson[0].fee_type_amount+"/- <br>("+myJson[0].fee_type_det+")";
        //  document.getElementById('amtwords2').innerHTML = doConvert(myJson[0].fee_type_amount)+" ONLY";   
         
         
        //   document.getElementById('camt3').innerHTML = "Rs. "+myJson[0].fee_type_amount+"/- <br>("+myJson[0].fee_type_det+")";
        //  document.getElementById('amtwords3').innerHTML = doConvert(myJson[0].fee_type_amount)+" ONLY";   
      }
    },
    error: function(){
        var tables = document.querySelectorAll('table');
  tables.forEach(function(table) {
    table.style.display = 'none';
  });
        window.history.back();
    }
  });


   </script>

</html>