<?php
require './classes/database.class.php';
require './classes/function.class.php'; 
$fn->AuthPage();
$resumes = $db->query('SELECT * FROM resumes WHERE user_id='.$fn->Auth()['id'].' ORDER BY id DESC');
$resumes = $resumes->fetch_all(1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrimeCV | Downloads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="cssfile/downloads.css">
    <link rel="icon" href="images/logo_img.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
</head>
<body>

    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="landing_page-2.php">
                <img src="images/Logo2.png" alt="Logo" height="24" class="d-inline-block align-text-top">
            </a>
            <div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="Myprofile.php">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="downloads.php">Downloads</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <div class="bg-white rounded shadow p-2 mt-4" style="min-height:80vh">
            <div class="d-flex justify-content-between border-bottom">
                <h5>Resumes</h5>
                <div>
                    <a href="form_submission.php" class="text-decoration-none"><i class="bi bi-file-earmark-plus"></i> Add New</a>
                </div>
            </div>
<?php
if($resumes){
    ?>
  <div class="d-flex flex-wrap">
    <?php
    foreach($resumes as $resume){
        ?>
          <div class="col-12 col-md-6 p-2">
                    <div class="p-2 border rounded">
                        <h5><?=$resume['resume_title']?></h5>
                        <p class="small text-secondary m-0" style="font-size:12px"><i class="bi bi-clock-history"></i>
                            Last Updated <?=date('d M, Y h:i A',$resume['updated_at'])?>
                        </p>
                        <div class="d-flex gap-2 mt-1">
                            <a href="temp-1.php?resume=<?=$resume['slug']?>" target="_blank" class="text-decoration-none small"><i class="bi bi-file-text"></i> Open with templet-1</a>
                            <a href="temp-2.php?resume=<?=$resume['slug']?>" target="_blank" class="text-decoration-none small"><i class="bi bi-file-text"></i> Open with templet-2</a>
                            <a href="updatecv.php?resume=<?=$resume['slug']?>" class="text-decoration-none small"><i class="bi bi-pencil-square"></i> Edit</a>
                            <a href="actions/deletcv.action.php?id=<?=$resume['id']?>" class="text-decoration-none small"><i class="bi bi-trash2"></i> Delete</a>
                            <a href="actions/clonecv.action.php?resume=<?=$resume['slug']?>" class="text-decoration-none small"><i class="bi bi-copy"></i> Clone</a>
                        </div>
                    </div> 
                </div>
        <?php
    }
    ?>

                
               
        </div>
    <?php
}else{
?>
   <div class="text-center py-3 border rounded mt-3" style="background-color: rgba(236, 236, 236, 0.56);">
                <i class="bi bi-file-text"></i> No Resumes Available
            </div>
<?php 
}
?>

        </div>
    </div>
</body>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
$(function(){
<?php
$fn->error();
$fn->alert();
?>
})

</script>
</html>