<?php
require './classes/database.class.php';
require './classes/function.class.php'; 
$fn->AuthPage();
$slug=$_GET['resume']??'';
$resumes = $db->query("SELECT * FROM resumes WHERE (slug='$slug' AND user_id=".$fn->Auth()['id'].") ");
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrimeCV | Edit</title>
    <link rel="icon" href="images/logo_img.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="icon" href="logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            height: 100vh;
            background: rgb(249, 249, 249);
            background: radial-gradient(circle, rgba(249, 249, 249, 1) 0%, rgb(155, 213, 249) 49%, rgb(217, 228, 255) 100%);

        }
    </style>
</head>

<body>

    

    <div class="container">

        <div class="bg-white rounded shadow p-2 mt-4" style="min-height:80vh">
            <div class="d-flex justify-content-between border-bottom">
                <h5>Edit CV</h5>
                <div>
                    <a href="downloads.php" class="text-decoration-none"><i class="bi bi-arrow-left-circle"></i> Back</a>
                </div>
            </div>

            <div>

                <form action="actions/updatecv.action.php" method="post" class="row g-3 p-3">
                              <input type="hidden" name="id" value="<?=$resume['id']?>" />
                            <input type="hidden" name="slug" value="<?=$resume['slug']?>" /> 
                     <div class="col-md-6">
                       <label class="form-label">CV title</label>
                        <input type="text" name="resume_title" value="<?=@$resume['resume_title']?>" placeholder="Dev Ninja" class="form-control" required>
                    </div>
                    <h5 class="mt-3 text-secondary"><i class="bi bi-person-badge"></i> Personal Information</h5>
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" value="<?=@$resume['full_name']?>" placeholder="Dev Ninja" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email_id" value="<?=@$resume['email_id']?>" placeholder="dev@abc.com" class="form-control" required>
                    </div>
                   
                    <div class="col-md-6">
                        <label class="form-label">Mobile No</label>
                        <input type="number" name="mobile_no" value="<?=@$resume['mobile_no']?>" min="1111111111" placeholder="9569569569" max="9999999999"
                            class="form-control" required>
                    </div>


                    <div class="col-md-6">
                        <label class="form-label">Hobbies</label>
                        <input type="text" name="hobbies" value="<?=@$resume['hobbies']?>" placeholder="Reading Books, Watching Movies" class="form-control" required>
                    </div>
                     <div class="col-md-6">
                        <label class="form-label">Current Role</label>
                        <input type="text" placeholder="Student or working professional" name="role" value="<?=@$resume['role']?>" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Languages Known</label>
                        <input type="text" placeholder="Hindi,English" name="languages" value="<?=@$resume['languages']?>" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label for="inputAddress" class="form-label"> Address</label>
                        <input type="text" class="form-control" name="address" id="inputAddress" value="<?=@$resume['address']?>" placeholder="1234 Main St" required>
                    </div>
                     <div class="col-12">
                        <label for="inputAddress" class="form-label"> Objective</label>
                        <textarea class="form-control" name="objective"  placeholder=""><?=@$resume['objective']?></textarea>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5 class=" text-secondary"><i class="bi bi-briefcase"></i> Experience</h5>
                        <div>
                            <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addexp"><i class="bi bi-file-earmark-plus"></i> Add New</a>
                        </div>
                    </div>
      

                    <div class="d-flex flex-wrap">

<?php
if($exps){
foreach($exps as $exp){
    ?>
<div class="col-12 col-md-6 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6><?=$exp['position']?></h6>
                                    <a href="actions/deletexp.action.php?id=<?=$exp['id']?>&resume_id=<?=$resume['id']?>&slug=<?=$resume['slug']?>"><i class="bi bi-x-lg"></i></a>
                                </div>

                                <p class="small text-secondary m-0" style="">
                                    <i class="bi bi-buildings"></i> <?=$exp['company']?> (<?=$exp['started'].' - '.$exp['ended']?>)
                                </p>
                                <p class="small text-secondary m-0" style="">
                                    <?=$exp['job_desc']?>
                                </p>

                            </div>
                        </div>
    <?php
}
}else{
?>
<div class="col-12  p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6>No Job</h6>
                                </div>

                                <p class="small text-secondary m-0" style="">
                                    If you have any, you can add it
                                </p>

                            </div>
                        </div>
<?php
}
?>

                        
                        
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5 class=" text-secondary"><i class="bi bi-mortarboard-fill"></i> Education</h5>
                        <div>
                            <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addedu"><i class="bi bi-file-earmark-plus"></i> Add New</a>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap">
<?php
if($edus){
foreach($edus as $exp){
    ?>
    <div class="col-12 col-md-6 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6><?=$exp['course']?></h6>
                                    <a href="actions/deletedu.action.php?id=<?=$exp['id']?>&resume_id=<?=$resume['id']?>&slug=<?=$resume['slug']?>"><i class="bi bi-x-lg"></i></a>
                                </div>

                                <p class="small text-secondary m-0" style="">
                                    <i class="bi bi-book"></i> <?=$exp['institute']?>
                                </p>
                                <p class="small text-secondary m-0" style="">
                                    (<?=$exp['started'].' - '.$exp['ended']?>)
                                </p>

                            </div>
                        </div>
    <?php
}
}else{
?>
<div class="col-12 col-md-6 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6>No Education</h6>
                                </div>

                                <p class="small text-secondary m-0" style="">
                                     Add if you any
                                </p>

                            </div>
                        </div>
<?php
}
?>

                    </div>

                    <hr>
        
                    <div class="d-flex justify-content-between">
                        <h5 class=" text-secondary"><i class="bi bi-journal-bookmark"></i> Certification</h5>
                        <div>
                            <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addcertificate"><i class="bi bi-file-earmark-plus"></i> Add New</a>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap">
<?php
if($certificates){
foreach($certificates as $exp){
    ?>
          <div class="col-12 col-md-6 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6><?=$exp['course']?></h6>
                                    <a href="actions/deletcir.action.php?id=<?=$exp['id']?>&resume_id=<?=$resume['id']?>&slug=<?=$resume['slug']?>"><i class="bi bi-x-lg"></i></a>
                                </div>

                                <p class="small text-secondary m-0" style="">
                                    <i class="bi bi-book"></i> <?=$exp['description']?>
                                </p>
                                <p class="small text-secondary m-0" style="">
                                    <?=$exp['ended']?>
                                </p>

                            </div>
            </div>



                
    <?php
}
}else{
?>
      <div class="col-12 col-md-6 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between">
                                    <h6>No certificate</h6>
                                    <a href=""><i class="bi bi-x-lg"></i></a>
                                </div>

                                <p class="small text-secondary m-0" style="">
                                    <i class="bi bi-book"></i> If you have any add
                                </p>
                                
                            </div>
            </div>



                    
<?php
}
?>

</div>

                   <hr>
                    

                    <div class="d-flex justify-content-between">
                         <h5 class=" text-secondary"><i class="bi bi-pen"></i> Skills</h5>
                            <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addskill"><i class="bi bi-file-earmark-plus"></i> Add New</a>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap">
<?php
if($skills){
foreach($skills as $exp){
    ?>
     <div class="col-12 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6><i class="bi bi-caret-right"></i> <?=$exp['skill']?></h6>
                                    <a href="actions/deletskill.action.php?id=<?=$exp['id']?>&resume_id=<?=$resume['id']?>&slug=<?=$resume['slug']?>"><i class="bi bi-x-lg"></i></a>
                                </div>
                            </div>
                        </div>
    <?php
}
}else{
?>
      <div class="col-12 p-2">
                            <div class="p-2 border rounded">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6><i class="bi bi-caret-right"></i> Add your Skills</h6>
                                    <a href=""><i class="bi bi-x-lg"></i></a>
                                </div>
                            </div>
                        </div>               
<?php
}
?>


                       
                  </div>



                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Update
                            Resume</button>
                    </div>
                </form>
            </div>





        </div>

    </div>
                  <!-- modal experience-->
<div class="modal fade" id="addexp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Experience</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="actions/addexp.action.php" class="row g-3">
            <input type="hidden" name="resume_id" value="<?=$resume['id']?>" />
            <input type="hidden" name="slug" value="<?=$resume['slug']?>" />
  <div class="col-12">
    <label for="inputEmail4" class="form-label">Position / Job Role</label>
    <input type="text" class="form-control" name="position" placeholder="Web Developer Consultant (2+ Years)" id="inputEmail4" required>
  </div>
  <div class="col-12">
    <label for="inputPassword4" class="form-label">Company</label>
    <input type="text" class="form-control" name="company" placeholder="Dominos,Kolkata" id="inputPassword4" required>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Joined</label>
    <input type="text" name="started" class="form-control" placeholder="October 2022" id="inputPassword4" required>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Resigned</label>
    <input type="text" name="ended" class="form-control" placeholder="Currently Working" id="inputPassword4" required>
  </div>
  <div class="col-12">
    <label for="inputPassword4" class="form-label">Job Description</label>
    <textarea class="form-control"name="job_desc" required></textarea>
  </div>
  <div class="col-12 text-end">
    <button type="submit" class="btn btn-primary">Add Experience</button>
  </div>
</form>
      </div>
      </div>
  </div>
</div>
                    <!-- modal education -->
<div class="modal fade" id="addedu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Education</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="actions/addeducation.action.php" class="row g-3">
             <input type="hidden" name="resume_id" value="<?=$resume['id']?>" />
            <input type="hidden" name="slug" value="<?=$resume['slug']?>" />
  <div class="col-12">
    <label for="inputEmail4" class="form-label">Course / Degree</label>
    <input type="text" class="form-control" name="course" placeholder="Subject / Degree name" id="inputEmail4" required>
  </div>
  <div class="col-12">
    <label for="inputPassword4" class="form-label">Institute</label>
    <input type="text" class="form-control" name="institute" placeholder="ABC School / College" id="inputPassword4" required>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Started</label>
    <input type="text" name="started" class="form-control" placeholder="October 2021" id="inputPassword4" required>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Ended</label>
    <input type="text" name="ended" class="form-control" placeholder="July 2025" id="inputPassword4" required>
  </div>
  
  <div class="col-12 text-end">
    <button type="submit" class="btn btn-primary">Add Education</button>
  </div>
</form>
      </div>
      </div>
  </div>
</div>
                                        <!-- modal Cirtificate -->
<div class="modal fade" id="addcertificate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Cirtificate</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="actions/addcirtificate.action.php" class="row g-3">
            <input type="hidden" name="resume_id" value="<?=$resume['id']?>" />
            <input type="hidden" name="slug" value="<?=$resume['slug']?>" />
  <div class="col-12">
    <label for="inputEmail4" class="form-label">Course / Degree</label>
    <input type="text" class="form-control" name="course" placeholder="Subject / Degree name" id="inputEmail4" required>
  </div>
 
  
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Ended</label>
    <input type="text" name="ended" class="form-control" placeholder="July 2025" id="inputPassword4" required>
  </div>
  <div class="col-12">
    <label for="inputPassword4" class="form-label">Cirtificate Description</label>
    <textarea class="form-control"name="description" required></textarea>
  </div>
  
  <div class="col-12 text-end">
    <button type="submit" class="btn btn-primary">Add Cirtificate</button>
  </div>
</form>
      </div>
      </div>
  </div>
</div>
                            <!-- modal Skill -->
<div class="modal fade" id="addskill" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Expertise</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="actions/addskill.action.php" class="row g-3">
            <input type="hidden" name="resume_id" value="<?=$resume['id']?>" />
            <input type="hidden" name="slug" value="<?=$resume['slug']?>" />
  <div class="col-12">
    <label for="inputEmail4" class="form-label">Course / Degree</label>
    <input type="text" class="form-control" name="skill" placeholder="PHP & Bootstrap" id="inputEmail4" required>
  </div>
  <div class="col-12 text-end">
    <button type="submit" class="btn btn-primary">Add Skill</button>
  </div>
</form>
      </div>
      </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
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
</body>

</html>