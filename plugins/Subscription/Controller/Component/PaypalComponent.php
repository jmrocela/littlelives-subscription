<?php 

class PaypalComponent extends Component {

     
        function PPHttpPost($methodName_, $nvpStr_, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode) {
	       // Set up your API credentials, PayPal end point, and API version.
	       $API_UserName = urlencode($PayPalApiUsername);
	       $API_Password = urlencode($PayPalApiPassword);
	       $API_Signature = urlencode($PayPalApiSignature);
   
	       if($PayPalMode=='sandbox')
	       {
		   $paypalmode     =   '.sandbox';
	       }
	       else
	       {
		   $paypalmode     =   '';
	       }
   
	       $API_Endpoint = "https://api-3t".$paypalmode.".paypal.com/nvp";
	       $version = urlencode('76.0');
   
	       // Set the curl parameters.
	       $ch = curl_init();
	       curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
	       curl_setopt($ch, CURLOPT_VERBOSE, 1);
   
	       // Turn off the server and peer verification (TrustManager Concept).
	       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
   
	       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	       curl_setopt($ch, CURLOPT_POST, 1);
   
	       // Set the API operation, version, and API signature in the request.
	       $nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
   
	       // Set the request as a POST FIELD for curl.
	       curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
   
	       // Get response from the server.
	       $httpResponse = curl_exec($ch);
   
	       if(!$httpResponse) {
		   exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
	       }
   
	       // Extract the response details.
	       $httpResponseAr = explode("&", $httpResponse);
   
	       $httpParsedResponseAr = array();
	       foreach ($httpResponseAr as $i => $value) {
		   $tmpAr = explode("=", $value);
		   if(sizeof($tmpAr) > 1) {
		       $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
		   }
	       }
   
	       if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
		   exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
	       }
   
	   return $httpParsedResponseAr;
       }
       
       
       public function process($ItemName,$ItemPrice,$ItemNumber,$ItemQty,$listing_id){
	    
            $PayPalMode         = 'sandbox'; // sandbox or live
            $PayPalApiUsername  = ''; //PayPal API Username
            $PayPalApiPassword  = ''; //Paypal API password
            $PayPalApiSignature = ''; //Paypal API Signature
            $PayPalCurrencyCode = 'SGD'; //Paypal Currency Code
            $PayPalReturnURL   = 'http://localhost/smartowner/client/listings/edit/'.$listing_id.'/6'; //Point to process.php page
            $PayPalCancelURL   = 'http://localhost/smartowner/client/listings/edit'.$listing_id.'/6'; //Cancel URL if user clicks cancel
	
            
            $ItemTotalPrice = ($ItemPrice*$ItemQty); //(Item Price x Quantity = Total) Get total amount of product;
        //echo $PayPalCurrencyCode; exit();
            //Data to be sent to paypal
            $padata =   '&CURRENCYCODE='.urlencode($PayPalCurrencyCode).
            '&PAYMENTACTION=Sale'.
            '&ALLOWNOTE=1'.
            '&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode).
            '&PAYMENTREQUEST_0_AMT='.urlencode($ItemTotalPrice).
            '&PAYMENTREQUEST_0_ITEMAMT='.urlencode($ItemTotalPrice).
            '&L_PAYMENTREQUEST_0_QTY0='. urlencode($ItemQty).
            '&L_PAYMENTREQUEST_0_AMT0='.urlencode($ItemPrice).
            '&L_PAYMENTREQUEST_0_NAME0='.urlencode($ItemName).
            '&L_PAYMENTREQUEST_0_NUMBER0='.urlencode($ItemNumber).
            '&AMT='.urlencode($ItemTotalPrice).
            '&RETURNURL='.urlencode($PayPalReturnURL).
            '&CANCELURL='.urlencode($PayPalCancelURL);

            $httpParsedResponseAr = $this->PPHttpPost('SetExpressCheckout', $padata, $PayPalApiUsername,$PayPalApiPassword, $PayPalApiSignature,$PayPalMode);
          
            //Respond according to message we receive from Paypal
            if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
            {
          
              // If successful set some session variable we need later when user is redirected back to page from paypal.
              $_SESSION['itemprice'] =  $ItemPrice;
              $_SESSION['totalamount'] = $ItemTotalPrice;
              $_SESSION['itemName'] =  $ItemName;
              $_SESSION['itemNo'] =  $ItemNumber;
              $_SESSION['itemQTY'] =  $ItemQty;
          
              if($PayPalMode=='sandbox')
              {
                  $paypalmode     =   '.sandbox';
              }
              else
              {
                  $paypalmode     =   '';
              }
              //Redirect user to PayPal store with Token received.
              $paypalurl ='https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"].'';
              header('Location: '.$paypalurl);
          
            }else{
                //Show error message
                echo '<div style="color:red"><b>Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
                echo '<pre>';
                print_r($httpParsedResponseAr);
                echo '</pre>';
            }
	
	
	
	
	
       }
       
       function ret(){
        //Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
	
            $PayPalMode         = 'sandbox'; // sandbox or live
            $PayPalApiUsername  = ''; //PayPal API Username
            $PayPalApiPassword  = ''; //Paypal API password
            $PayPalApiSignature = ''; //Paypal API Signature
            $PayPalCurrencyCode = 'SGD'; //Paypal Currency Code
              
            //we will be using these two variables to execute the "DoExpressCheckoutPayment"
            //Note: we haven't received any payment yet.
        
            $token = $_GET["token"];
            $playerid = $_GET["PayerID"];
        
            //get session variables
            $ItemPrice      = $_SESSION['itemprice'];
            $ItemTotalPrice = $_SESSION['totalamount'];
            $ItemName       = $_SESSION['itemName'];
            $ItemNumber     = $_SESSION['itemNo'];
            $ItemQTY        =$_SESSION['itemQTY'];
        
            $padata =   '&TOKEN='.urlencode($token).
              '&PAYERID='.urlencode($playerid).
              '&PAYMENTACTION='.urlencode("SALE").
              '&AMT='.urlencode($ItemTotalPrice).
              '&CURRENCYCODE='.urlencode($PayPalCurrencyCode);
        
            //We need to execute the "DoExpressCheckoutPayment" at this point to Receive payment from user.
           // $paypal= new MyPayPal();
            $httpParsedResponseAr = $this->PPHttpPost('DoExpressCheckoutPayment', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
        
            //Check if everything went ok..
            if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
            {
              $return['transacion_id']= $httpParsedResponseAr["TRANSACTIONID"];
        
            /*
            //Sometimes Payment are kept pending even when transaction is complete.
            //because of Currency change, user choose other payment option or its pending review etc.
            //hence we need to notify user about it and ask him manually approve the transiction
            */
        
            if('Completed' == $httpParsedResponseAr["PAYMENTSTATUS"])
            {
               $return['status']='completed';
            }
            elseif('Pending' == $httpParsedResponseAr["PAYMENTSTATUS"])
            {
                $return['status']='pending';
            }
        
              
        
            }else{
              $return['status']='failed';
                          $return['message']=urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]);
                          
            }
                  
                  return $return;
        
             }
       

}