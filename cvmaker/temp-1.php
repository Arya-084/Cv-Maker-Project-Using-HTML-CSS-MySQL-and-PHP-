<?php
require './classes/database.class.php';
require './classes/function.class.php'; 
$slug=$_GET['resume']??'';
$resumes = $db->query("SELECT * FROM resumes WHERE (slug='$slug') ");
$resume = $resumes->fetch_assoc();
if(!$resume){
    $fn->redirect('downloads.php');
}
$exps = $db->query("SELECT * FROM experiences WHERE (resume_id=".$resume['id'].") ");
$exps = $exps->fetch_all(1);

$edus = $db->query("SELECT * FROM educations WHERE (resume_id=".$resume['id'].") ");
$edus = $edus->fetch_all(1);

$certificates = $db->query("SELECT * FROM certification WHERE (resume_id=".$resume['id'].") ");
$certificates = $certificates->fetch_all(1);

$skills = $db->query("SELECT * FROM experties WHERE (resume_id=".$resume['id'].") ");
$skills = $skills->fetch_all(1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Andada+Pro:ital,wght@0,400..840;1,400..840&family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Dancing+Script:wght@400..700&family=Edu+QLD+Hand:wght@400..700&family=Libertinus+Mono&family=Lora:ital,wght@0,400..700;1,400..700&family=Parisienne&family=Permanent+Marker&family=Roboto:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
  <title><?=$resume['full_name'].' | '.$resume['resume_title']?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="icon" href="images/logo_img.png">
  <style>
    * {
      box-sizing: border-box;
    }

    html, body {
      margin: 0;
      padding: 0;
      background:rgb(168, 227, 247);
      color: #ffffff;
      font-family: 'Inter', sans-serif;
    }

    .resume {
      width: 210mm;
      height: 297mm;
      background: #ff8f00;
      margin: auto;
      padding: 30px 40px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
      border-radius: 12px;
      position: relative;
      color: #fff;
    }

    h1, h2 {
      color: #ffffff;
    }

    h1 {
      font-size: 32px;
      font-weight: 600;
      text-align: center;
      border-bottom: 2px solid #fff;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    h2 {
      font-size: 20px;
      margin-top: 25px;
      border-bottom: 1px dashed #fff;
      padding-bottom: 4px;
    }

    .info {
      text-align: center;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .info span {
      display: inline-block;
      margin: 0 10px;
      color: #fce4ec;
    }

    .section p,
    .section li {
      font-size: 14px;
      line-height: 1.6;
    }

    .section ul {
      padding-left: 20px;
    }

    .text-right {
      text-align: right;
    }

    .footer-sign {
      margin-top: 40px;
      font-size: 14px;
    }

    @media print {
      @page {
        size: A4;
        margin: 0;
      }

      html, body {
        background: #ff6f00 !important;
        width: 210mm;
        height: 297mm;
        overflow: hidden;
      }

      body {
        margin: 0 !important;
        padding: 0 !important;
      }

      .resume {
        box-shadow: none !important;
        border-radius: 0 !important;
        position: fixed;
        top: 0;
        left: 0;
        width: 210mm;
        height: 297mm;
        background: #ff8f00 !important;
        color: #fff !important;
      }

      * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
      }
    }
  </style>
</head>
<body>
  <?php
  if($fn->Auth()!= false && $fn->Auth()['id']==$resume['user_id']){
    ?>
    <div class="extra">
<div class=" w-100 py-3 bg-dark d-flex justify-content-center gap-4">
  <?php
  $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  ?>
<a href="whatsapp://send?text=<?=$actual_link?>" class="btn btn-light btn-sm"><i class="bi bi-whatsapp"></i> Share</a>
<button class="btn btn-light btn-sm" id="print"><i class="bi bi-printer"></i> Print</button>
<button class="btn btn-light btn-sm" data-bs-toggle="offcanvas" data-bs-target="#font"><i class="bi bi-file-earmark-font-fill"></i> Change Font</button>
<button class="btn btn-light btn-sm" id="downloadpdf"><i class="bi bi-filetype-pdf"></i> Download</button>
</div>
  </div>
    <?php
  }
  ?>
  <br>
  <div class="resume" style="font-family:<?=$resume['font']?>">
    <h1><?=$resume['full_name']?></h1>
    <div class="info">
      <span>📞 +91-<?=$resume['mobile_no']?></span>
      <span>📧 <?=$resume['email_id']?></span>
      <span>🏠 <?=$resume['address']?></span>
    </div>

    <h2>Objective</h2>
    <p><?=$resume['objective']?></p>

    <h2>Experience</h2>
<?php
if($exps){
foreach($exps as $exp){
  ?>
<p><strong><?=$exp['position']?></strong> - <?=$exp['company']?><br>
      <em><?=$exp['started']?> – <?=$exp['ended']?></em><br>
      <?=$exp['job_desc']?></p>
  <?php
}
}else{
  ?>
 <p> I am a Fresher </p>
  <?php
}
?>
    

    <h2>Education</h2>
<?php
if($edus){
foreach($edus as $exp){
  ?>
  <ul>
      <li><strong> <?=$exp['course']?></strong><br> <?=$exp['institute']?> </li>
      <em><?=$exp['started']?> – <?=$exp['ended']?></em>
    </ul>
  <?php
}
}else{
  ?>
 <p> I don't have any education </p>
  <?php
}
?>
    
    <h2>Certificate</h2>
    <?php
if($certificates){
foreach($certificates as $exp){
  ?>
       <ul>
      <li><strong><?=$exp['course']?></strong><br><?=$exp['ended']?></li><P><?=$exp['description']?><P>
    </ul>
  <?php
}
}else{
  ?>
 <p> I don't have any Certificate </p>
  <?php
}
?>

    <h2>Skills</h2>
    <?php
if($skills){
foreach($skills as $exp){
  ?>
  <ul>
      <li><?=$exp['skill']?></li>
    </ul>
  <?php
}
}else{
  ?>
  <p>I don't have any skills</p>
  <?php
}
?>
  

    <h2>Hobbies</h2>
    <p><?=$resume['hobbies']?></p>

    <h2>Languages Known</h2>
    <p><?=$resume['languages']?></p>

  </div>

<div class="offcanvas offcanvas-bottom" tabindex="-1" id="font" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel"><strong><i class="bi bi-file-earmark-font-fill"></i> Fonts</strong></h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <select class="form-control" id="font">
      <option value="'Roboto', sans-serif" <?=$resume['font']=="'Roboto', sans-serif"?'selected':''?> style="font-family:'Roboto', sans-serif">'Roboto', sans-serif</option>
      <option value="'Libertinus Mono', monospace" <?=$resume['font']=="'Libertinus Mono', monospace"?'selected':''?> style="font-family:'Libertinus Mono', monospace">'Libertinus Mono', monospace</option>
      <option value="'Ubuntu', sans-serif" <?=$resume['font']=="'Ubuntu', sans-serif"?'selected':''?> style="font-family:'Ubuntu', sans-serif">'Ubuntu', sans-serif</option>
      <option value="'Lora', serif" <?=$resume['font']=="'Lora', serif"?'selected':''?> style="font-family:'Lora', serif">'Lora', serif</option>
      <option value="'Dancing Script', cursive" <?=$resume['font']=="'Dancing Script', cursive"?'selected':''?> style="font-family:'Dancing Script', cursive">'Dancing Script', cursive</option>
      <option value="'Cormorant Garamond', serif" <?=$resume['font']=="'Cormorant Garamond', serif"?'selected':''?> style="font-family:'Cormorant Garamond', serif">'Cormorant Garamond', serif</option>
      <option value="'Permanent Marker', cursive" <?=$resume['font']=="'Permanent Marker', cursive"?'selected':''?> style="font-family:'Permanent Marker', cursive">'Permanent Marker', cursive</option>
      <option value="'Edu QLD Hand', cursive" <?=$resume['font']=="'Edu QLD Hand', cursive"?'selected':''?> style="font-family:'Edu QLD Hand', cursive">'Edu QLD Hand', cursive</option>
      <option value="'Parisienne', cursive" <?=$resume['font']=="'Parisienne', cursive"?'selected':''?> style="font-family:'Parisienne', cursive">'Parisienne', cursive</option>
      <option value="'Andada Pro', serif" <?=$resume['font']=="'Andada Pro', serif"?'selected':''?> style="font-family:'Andada Pro', serif">'Andada Pro', serif</option>
    </select>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
<script>
$("#downloadpdf").click(function(){
    window.jsPDF = window.jspdf.jsPDF
    var doc = new jsPDF();
    var page = document.querySelector('.resume');
    doc.html(page,{
  callback: function(doc){
    doc.save('<?=$resume['resume_title']?>.pdf');
  },
  margin:[2,2,2,2],
  x:0,
  y:0,
  width:200,
  windowWidth:800
    })
})

$("#font").change(function(){
   let font = $(this).find(":selected").val();
   $(".resume").css('font-family',font);
   $.ajax({
    url:'actions/changefont.action.php',
    method:'post',
    data:{
      resume_id: <?=@$resume['id']?>,
      font : font
    },
    success:function(res){
      console.log(res);
    },
    error:function(res){
      console.log(res);
      alert('Font is not updated');
    }
   })
})

$("#print").click(function(){
  $(".extra").hide();
  window.print();

  setTimeout(() => {
      $(".extra").show();
  }, 500);
})
  </script>
  </body>
</body>
</html>
