<?php

error_reporting(0);
 

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'gcrashco_AVI');
define('DB_PASSWORD', 'gcrashco_AVI');
define('DB_NAME', 'gcrashco_AVI');

// Establish a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$merchant_key = "888807890";
$amount = $_POST["amount"];
$mchId = $_POST["mchId"];
$mchOrderNo = $_POST["mchOrderNo"];
$merRetMsg = $_POST["merRetMsg"];
$orderDate = $_POST["orderDate"];
$orderNo = $_POST["orderNo"]; 
$oriAmount = $_POST["oriAmount"];
$tradeResult = $_POST["tradeResult"];
$signType = $_POST["signType"];
$sign = $_POST["sign"];

function random_strings($length_of_string)
{

    // String of all alphanumeric character
    $str_result = '0123456789AXYZ012345678901234567890123456789';

    // Shuffle the $str_result and returns substring
    // of specified length
    return substr(
        str_shuffle($str_result),
        0,
        $length_of_string
    );
}
$rand = random_strings(22);
$msg = "";

// If upload button is clicked ...

if (isset($_POST['upload'])) {

    $utr = random_strings(12);

    $filename = $utr . '.jpeg';

    $tempname = $_FILES["uploadfile"]["tmp_name"];

    $folder = "./Pay_Proof/" . $filename;



    // Get all the submitted data from the form


    $sql1 = "INSERT INTO recharge (username, recharge,status,upi,utr,rand) VALUES ('$user', '$am','unpaid','$upiid','$utr','$rand')";

    $conn->query($sql1);


    // Now let's move the uploaded image into the folder: image

    if (move_uploaded_file($tempname, $folder)) {

        header("location: /#/rechargerecord");
    } else {

        echo "<h3>  Failed to upload image!</h3>";
    }
}
?>

<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
    <meta http-equiv="expires" content="1">
    <meta name="google" value="notranslate">
    <meta name="msapplication-TileColor" content="#0093ff">
    <meta name="theme-color" content="#0093ff">
    <meta name="msapplication-navbutton-color" content="#0093ff">
    <meta name="apple-mobile-web-app-status-bar-style" content="#0093ff">
    <meta name="description" content="Make money with Rudarwin">
    <link rel="shortcut icon" href="fevicon.png" type="image/x-icon">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Rudarwin">
    <meta name="twitter:site" content="Rudarwin">
    <meta name="twitter:description" content="Make money with Rudarwin">
    <meta name="twitter:image" content="logo.jpg">
    <meta property="og:title" content="Rudarwin">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Rudarwin">
    <meta property="og:url" content="">
    <meta name="msapplication-TileImage" content="logo.jpg">
    <meta property="og:image" content="logo.jpg">
    <meta property="og:description" content="Make money with Rudarwin">
    <meta property="url" content="">
    <meta property="type" content="website">
    <meta property="title" content="Rudarwin">
    <meta property="description" content="Make money with Rudarwin">
    <meta property="image" content="logo.jpg">
    <meta itemprop="image" content="logo.jpg">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="light.css?23.2.21.6">
    <link rel="stylesheet" href="dropzone.css?23.2.21.6">
<script type='text/javascript'>
function chooseFile() {
      document.getElementById("fileInput").click();
   }
   function submit(){
       document.getElementById("ssupload").submit();
   }
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
    document.getElementById('uimg').style.display=""; 
    document.getElementById('upifrm').style.display="none";
  var output = document.getElementById('payss');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap');
    </style>
    <title>Fivewin</title>
    <style id="aby-style"></style>
</head>

<body>
    <section class="">
        <div class="row mcas">
            <div class="col-md-6 col-lg-4 main">
                <div class="row" id="warea">
                    <div class="col-12 m-record">
                        <div class="row nav-top auto xtl tf-14">
                            <div class="col-6 ddavc"><span class="nav-back wt"  onclick="window.location.href='/#/recharge'"></span><span
                                    class="tfw-5 tf-18">Recharge</span></div>
                            <div class="col-6 xtr">KSH <span class="tf-28 tfw-5" id="rmt" onclick="copyAMT()"><?php echo $am; ?></span>
                            </div>
                            <div class="col-7 pt-3 xtl">
                                <div class="lnhn30">Transaction Id：<span id="trid"><?php echo rand(2000000,99999999); ?></span></div>
                                <div class="lnhn30">Payment mode：<span class="xic" id="pmod"><?php echo $mode; ?></span></div>
                                <div class="lnhn30">UPI：<span id="upid"><?php echo $upiid; ?></span></div>
                            </div>
                            <div class="col-5 xtr pt-3">
                                </br>
                                
                                   <span class="paynqr mr-2" id="cu" onclick="copyUPI()">Copy UPI</span>
                            </div>
                            <div class="col-12 xtr tf-18 pb-3 dflx jusfcr">
                               <!-- <span class="paynqr mr-2" onclick="copyamount()">Copy Amt</span>--> 
                          
                              
                                <!--
 <span class="paynqr" id="pnnb"onclick="window.location.href='<?php echo $open; ?>?pa=<?php echo $upiid; ?>&amp;pn=Rudarwin&amp;tn=recharge&amp;&amp;am=<?php echo $am; ?>&amp;cu=INR'">Open App</span>--></div>
                        </div>
                        <div class="row mt-4" id="rcpro">
                            <div class="col-2 xtc pa-0"><img class="dhkm" src="tick_p.svg" height="40"></div>
                            <div class="col-10 xtl tfw-6 tf-18 tfcdb pl-0">ऊपर दी गयी upi को कॉपी करके पेमेंट करके उसका स्क्रीनशॉट अपलोड कर दीजिये, 15 मिनट में आपके वॉलेट में बैलेंस आ जायेगा
                            </div>
                            <div class="col-2 xtc pa-0">
                                <div class="lhsu bg" id="ln1"></div>
                            </div>
                            <div class="col-10 mt-3 gsbgi" id="upimg">
                                <div class="pt-2 pb-2" id="uimg" style="display:none">
                                <img class="bodr6" id="payss" src="">
                                </div>
                                <div class="pt-2 pb-2" id="upifrm" onclick="chooseFile();">
                                    <form  class="dropzone dz-clickable zooani" id="ssupload" method="POST" action="" enctype="multipart/form-data">
                                        <div class="dz-message">
                                            <div style="height:0px;overflow:hidden">
                                                <input type="hidden" value="true" name="upload">
                                                <input id="fileInput" type="file" name="uploadfile" onchange="preview_image(event)" required>

                                             </div>
                                            <div class="dropdocs"><span class="add"></span><br>Upload</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-2 mt-3 xtc pa-0"><img id="rcagnt" class="dhkm" src="tick_p.svg" height="40">
                            </div>
                            <div class="col-10 mt-4 xtl tfw-6 tf-18 tfcdb pl-0">Submit to complete Recharge</div>
                            <div class="col-2 xtc pa-0">
                                <div class="lhsu" id="ln2"></div>
                            </div>
                            <div class="col-10 pl-0 xtc">
                                <div class="mb-3 xtl ddavc" id="spuvt" ><span
                                        class="comp"></span><span class="">Rest assured! Our recharge agents processing</span></div>
                            </div>
                            <div class="col-2 xtc pa-0"><img id="rccmp" class="dhkm" src="tick_inac.png" height="40">
                            </div>
                            <div class="col-10 mt-2 xtl tfw-6 tf-18 tfcdb pl-0">Submit</div>
                        </div>
                        <div class="row mt-2 mb-4" id="ccomod">
                            <div class="col-6 pr-1">
                                <div class="mt-3 btn-con rc" id="canod" onclick="window.location.href='/#/recharge'">Cancel</div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="mt-3 btn-con rc"  onclick="submit()">Submit</div>
                            </div>
                        </div>
                    </div>
                    <div id="dtaod">

                    </div>
                </div>
                <div class="row" id="odrea"></div>
                <div class="row" id="footer"></div>
                <div class="row" id="opffp"></div>
                <div class="row" id="anof">

                </div>
                <div class="row" id="dta_ref"></div>
            </div>
        </div>
    </section>
    <input type="file" class="dz-hidden-input" accept=".png,.PNG,.jpg,.jpeg,.JPG,.JPEG"
        style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;"><input type="file"
        class="dz-hidden-input" accept=".png,.PNG,.jpg,.jpeg,.JPG,.JPEG"
        style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;">
</body>
<script>
  function copyUPI() {
    // Code to copy UPI goes here (if needed)
    
    // Display a message
    alert('UPI copied successfully!');
  }
</script>
</html>