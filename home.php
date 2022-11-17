<?php

require "dbBroker.php";
require "model/service.php";
require "model/appointment.php";
require "model/user.php";


session_start();

$cookie_name = "admin";
$cookie_value = "admin";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");



if(!isset($_SESSION['admin_id'])){
    header('Location: index.php');
    exit();
}

if(!$_SESSION['auth']) {
  header('location:index.php');
}
else {
  $currentTime = time();
  if($currentTime > $_SESSION['expire']) {
    session_unset();
    session_destroy();
    header('location:index.php');
  }
  else {


$rezultat = Service::getAll($conn);

if(!$rezultat){
    echo "Greska pri ucitavanju usluga";
    die();
}
if($rezultat->num_rows==0){
    echo "Nema usluga za prikaz";
}else{

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Hair Salon HomePage</title>
<link href="https://fonts.googleapis.com/css?family=Big+Shoulders+Display:300,400,500,600,700|Josefin+Sans:300,400,600,700|Cormorant+Garamond:300,300i,400,400i,500,500i,600,600i,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/bootstrap-home.css">
<link rel="stylesheet" href="css/style-home.css">
<link rel="stylesheet" href="css/jquery.bxslider.css">
<link rel="stylesheet" href="https://cdn.lineicons.com/1.0.1/LineIcons.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg">
  <div class="container"> <a class="navbar-brand logo" href="home.php"><img src="images/logo.png" alt="Hair Salon"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon">
    <i class="lni-menu"></i>
    </span> </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active"> <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> </li>
        <li class="nav-item"> <a class="nav-link" href="#about">About</a> </li>
        <li class="nav-item"> <a class="nav-link" href="#services"> Services </a> 
        </li>
        <li class="nav-item"> <a class="nav-link" href="#appointments">Appointments</a> </li>
        <li class="nav-item"> <a class="nav-link" href="#contact">Contact</a> </li>
        <li class="nav-item"> <a class="nav-link" href="logout.php">Logout</a></li>
      </ul>
      
  </div>
</nav>

<!---------------Navigation ends here --------------------->
<div class="bd-example">
  <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active"> <img src="images/slider/slider-1.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-md-block">
          <h5>First slide label</h5>
          <p class="res1">We can use your plan, provide one for you, or help you come up with a custom plan to suit your needs. </p>
        </div>
      </div>
      <div class="carousel-item"> <img src="images/slider/slider-2.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-md-block">
          <h5>Second slide label</h5>
          <p class="res1">If you have an older home that is in need of a major renovation, we can help.</p>
        </div>
      </div>
      <div class="carousel-item"> <img src="images/slider/slider-3.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-md-block">
          <h5>Third slide label</h5>
          <p class="res1">If you have an older home that is in need of a major renovation, we can help.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev"> <span class="carousel-control-prev-icon bb" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next"> <span class="carousel-control-next-icon bb" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
</div>

<!---------------Slider ends here --------------------->

<div class="container my-5 py-5">
  <div class="row">
    <div class="col-12 text-center">
      <section id="about">
      <h4 class="small font-weight-bolder dd mb-5 pb-4">HUSH HAIR SALON</h4>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-12">
      <h5 class="dd2"> Now, also in downtown New York, The Benjamin Salon is a simple and understated approach to hair. We embrace our differences and uncover the beauty in everyone </h5>
      <div class="social-icon">
        <ul>
          <li><a href="#"><i class="lni-facebook-original"></i></a></li>
          <li><a href="#"><i class="lni-linkedin-original"></i></a></li>
          <li><a href="#"><i class="lni-instagram-original"></i></a></li>
          <li><a href="#"><i class="lni-youtube"></i></a></li>
        </ul>
      </div>
    </div>
    <div class="col-md-6 col-12">
      <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/kOlnHU8D6TM" allowfullscreen></iframe>
      </div>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-12 text-center"> 
      <button
        id="bookApp" 
        type="button" 
        class= "btn btn-sm btn-dark ml-3"
        data-toggle="modal"
        data-target="#addModal">BOOK APPOINTMENT
        </button>
        </section>
    </div>
  </div>
</div>
<!---------------About video section ends here --------------------->
<div class="bg-wrapper">
  <div class="container my-5 py-5">
    <div class="row">
      <div class="col-12 text-center">
      <section id="appointments">
        <h4 class="small font-weight-bolder dd mb-5 pb-4 text-white pt-5">Appointments</h4>
      </div>
    </div>
    
        <div class="row justify-content-center">
        <div class="row mb-2">
                            <div class="col-xs-12 col-md-5 ">
                                <select class="custom-select" id="search-appointments-dropdown">
                                    <option value="ID">ID termina</option>
                                    <option value="Prezime korisnika">Prezime korisnika</option>
                                    <option value="Usluga">Usluga</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-md-12 ">
                                <input type="text" id="searchAppointmentBar"
                                       placeholder="Pretražite termine..." class="form-control search mr-2"
                                       aria-label="Text input with dropdown button"
                                       onkeyup="searchAppointmentByProperty()"/>
                            </div>
                        </div>
            <table id="appointmentTable" class="table table-striped" style="background-color: white; border-color: rgba(0, 0, 0, 0.1);">
                <thead>

                <tr>  
                    <th scope="col">ID termina</th>
                    <th onclick="sortTable2(1)" scope="col">Ime korisnika</th>
                    <th onclick="sortTable2(2)" scope="col">Prezime korisnika</th>
                    <th scope="col">Kontakt</th>
                    <th onclick="sortTable2(3)" scope="col">Usluga</th>
                    <th scope="col">Cena</th>
                    <th scope="col">Datum</th>
                    <th scope="col">Izmeni</th>
                    <th scope="col">Obriši</th>
                    
                    
                </tr>
    
                </thead>

                <tbody id="my-appointments-table">
                  
                <?php
                $appointments = Appointment::getAll($conn);
                if ($appointments != null) {
                    foreach ($appointments as $appointment) :
                        ?>
               
                <tr>
                    <td><?php echo $appointment->id ?></td>
                    <td><?php echo $appointment->user->firstname ?></td>
                    <td><?php echo $appointment->user->lastname ?></td>
                    <td><?php echo $appointment->user->contact ?></td>
                    <td><?php echo $appointment->service->type?></td>
                    <td><?php echo $appointment->service->price?></td>
                    <td><?php echo $appointment->date->format("j M Y , g:i a")?></td>
                    <td>
                      <button id="editAppointment" 
                              class="btn btn-outline-dark ml-2 edit-appointment"
                              data-toggle="modal" data-target="#editModal"
                             
                              value="<?php echo $appointment->id ?>">Edit appointment</button>
                    </td>

                    <td>
                      <button id="deleteAppointment" 
                              class="btn btn-outline-dark ml-2 delete-appointment"
                              name="deleteAppointment"
                              
                              value="<?php echo $appointment->id ?>">Delete appointment</button>
                    </td>
                </tr>
                <?php
                  endforeach;
                }
                ?>
           
                </tbody>
            </table>
        </div>
              </section>
  </div>
</div>
<!---------------Appointments section ends here --------------------->
<div class="container mb-5">
  <div class="row">
    <div class="col-12">
      <div style="border:1px solid #ebebeb; box-shadow: 0 0 10px rgba(0,0,0, .15);">
        <div class="row">
          <div class="col-12 text-center">
          <section id="services">
            <h4 class="small font-weight-bolder dd mb-5 pb-4 pt-5">Usluge</h4>
          </div>
          <div class="col-12">
            
                  <table id="serviceTable" class="table table-striped">
                  <thead>
                      

                    <tr>  
                        <th onclick="sortTable(0)" scope="col">Usluga</th>
                        <th scope="col">Cena</th>
                        
                    </tr>

                    </thead>

                    <tbody>
                    <?php
                    while($red = $rezultat->fetch_array()):
                    ?>

                    <tr>
                        <td><?php echo $red["type"]?></td>
                        <td><?php echo $red["price"]?></td>
                    </tr>

                    <?php
                    endwhile;
                  }
                    ?>
                    </tbody>
                  </table>
                </section>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!---------------Services section ends here --------------------->
<div class="bg-wrapper2">
  <div class="container py-5">
    <div class="row">
      <div class="col-12 text-center">
        <h4 class="small font-weight-bolder dd mb-5 pb-4 pt-5">Blog</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4 blog"> <img src="images/blog/1.jpg" class="img-fluid">
        <h6>MONDAY 12 JUNE 2019</h6>
        <h3>Bad hair day? No biggie. When a quick at-home</h3>
        <p>It combines both heavenly Ila products and the brand’s unique philosophy, which involves seeing each.</p>
      </div>
      <div class="col-sm-4 blog"> <img src="images/blog/2.jpg" class="img-fluid">
        <h6>THURSDAY 18 JULY 2019</h6>
        <h3>From new and quirky to downright fancy</h3>
        <p>Fred created a full, brushed-forward style that hid both impediments. </p>
      </div>
      <div class="col-sm-4 blog"> <img src="images/blog/3.jpg" class="img-fluid">
        <h6>SUNDAY 25 AUGUST 2019</h6>
        <h3>Things have just got better and better in the world of hairdressing</h3>
        <p>Ment that you walk through the door nothing is too much trouble.</p>
      </div>
    </div>
    <div class="row pb-5 pt-4">
      <div class="col-12 text-center"> <a href="#" class="btn btn-dark"> VIEW ALL POSTS</a> </div>
    </div>
  </div>
</div>

<!---------------Blog section ends here --------------------->
<div class="bg-wrapper3">
  <div class="container">
    <div class="row justify-content-center py-5">
      <div class="col-md-6 col-sm-12 text-center">
        <h4>We don't keep our beauty secrets.</h4>
        <p>Subscribe now and thank us later.</p>
        <form>
          <div class="row no-gutters">
            <div class="col-8">
              <input class="form-control" name="" type="email" placeholder="you@example.com">
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-dark d-block w-100">SUBSCRIBE</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!---------------Subscribe section ends here --------------------->
<div class="bg-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 text-center">
        <h4 class="small font-weight-bolder dd pb-5 text-white pt-5">Our Instagram</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <ul class="our-insta">
          <li><a href="#"><img src="images/instagram/1.jpg" class="img-fluid"></a></li>
          <li><a href="#"><img src="images/instagram/4.jpg" class="img-fluid"></a></li>
          <li><a href="#"><img src="images/instagram/5.jpg" class="img-fluid"></a></li>
          <li><a href="#"><img src="images/instagram/6.jpg" class="img-fluid"></a></li>
          <li><a href="#"><img src="images/instagram/9.jpg" class="img-fluid"></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!---------------Instagram section ends here --------------------->
<div class="bg-wrapper py-5 dd3">
  <div class="container">
    <div class="row py-3">
      <div class="col-md-3 col-sm-6 d-flex align-items-center">
        <div class="footer-logo-wrapper">
          <div class="footer-logo"> <a href="#"><img src="images/logo-white.png" alt=""></a> </div>
          <div class="footer-copyright">
            <p>Hair Salon was founded by wife and husband Kevin and Jenifer in 20011. They wanted a friendly “no attitude” retreat for London.</p>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-sm-6">
        <div class="footer-links">
          <ul>
            <li><a href="#">Skin</a></li>
            <li><a href="#">Hair</a></li>
            <li><a href="#/">Makeup</a></li>
            <li><a href="#">Wellness</a></li>
            <li><a href="#">Reviews</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="footer-contact">
          <ul>
            <li> <a href="tel:(804) 614-4556"> Phone: (453) 567-2398 </a> </li>
            <li>Fax: (453) 567-2398</li>
            <li> 2958 River Road West, Goochland, VA 23063 </li>
            <li><a href="mailto:homedesign@gmail.com">Email: hairsalon@gmail.com</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <ul class="social-list">
          <li> <a href="#"><i class="lni-facebook-filled"></i></a> </li>
          <li><a href="#"><i class="lni-twitter-filled"></i></a></li>
          <li><a href="#"><i class="lni-pinterest"></i></a></li>
          <li><a href="#"><i class="lni-google-plus"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!---------------Footer section ends here --------------------->
<div class="container">
  <section id="contact">
  <div class="row py-3 footer-copyright">
    <div class="col-md-4"> <a href="#">Privacy Policy</a> - <a href="#">Contact Us</a> </div>
    <div class="col-md-8 text-right"> © Copyright 2019 Hair Salon. All Rights Reserved. Template by <a target="_blank" href="http://bootstraplily.com/">BootstrapLily.com</a> </div>
                </section>
  </div>
</div>

<!---------------Copyright section ends here ---------------------> 


<!--------------- MODAL ADD --------------------->
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Zakažite termin</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container add-form">
                    <form action="#" method="post" id="addForm">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Korisnik:</label>
                                        <select name="user" id="user" class="form-control">
                                            <option value="" selected disabled>--- Izaberite korisnika ---</option>
                                            <?php
                                            $users = User::getAllAsArray($conn);
                                            if ($users != null) {
                                                foreach ($users as $user) {
                                                    echo "<option value=\"" . $user->id . "\">" . $user->firstname . ", " . $user->lastname . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    <label for="">Usluga:</label>
                                    <select name="service" id="service" class="form-control">
                                        <option value="" selected disabled>--- Izaberite uslugu ---</option>
                                        <?php
                                        $services = Service::getAllAsArray($conn);
                                        if ($services != null) {
                                            foreach ($services as $service) {
                                              echo "<option value=\"" . $service->id . "\">" . $service->type . ", " . $service->price . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Datum i vreme:</label>
                                    <input type="datetime-local" id="date" name="date"
                                           class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <button id="btnAdd" type="submit" class="btn btn-outline-dark ml-2">Sačuvaj</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--------------- MODAL EDIT --------------------->
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Izmeni termin</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container edit-form">
                    <form action="#" method="post" id="editForm">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">ID</label>
                                    <input id="idEdit" type="text" name="idEdit" class="form-control" readonly/>
                                </div>
                                <div class="form-group">
                                <label for="">Korisnik:</label>
                                        <select name="userEdit" id="userEdit" class="form-control">
                                            <option value="" selected disabled>--- Izaberite korisnika ---</option>
                                            <?php
                                            $users = User::getAllAsArray($conn);
                                            if ($users != null) {
                                                foreach ($users as $user) {
                                                    echo "<option value=\"" . $user->id . "\">" . $user->firstname . ", " . $user->lastname . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                <label for="">Usluga:</label>
                                    <select name="serviceEdit" id="serviceEdit" class="form-control">
                                        <option value="" selected disabled>--- Izaberite uslugu ---</option>
                                        <?php
                                        $services = Service::getAllAsArray($conn);
                                        if ($services != null) {
                                            foreach ($services as $service) {
                                              echo "<option value=\"" . $service->id . "\">" . $service->type . ", " . $service->price . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Datum i vreme:</label>
                                    <input type="datetime-local" id="dateEdit" name="dateEdit"
                                           class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <button id="btnEdit" type="submit" class="btn btn-outline-dark ml-2">Izmeni</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
                                      }
                                    }
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> 
<script src="js/bootstrap.js"></script> 
<script src="js/jquery.bxslider.min1.js"></script> 
<script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>



<script>
  $(document).ready(function(){
    $('.slider').bxSlider({	
	      minSlides:1,
	      maxSlides:3,
        captions: true,
	      slideWidth:400
	  });

        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        now.setSeconds(null);
        now.setMilliseconds(null);

        const max = new Date(Date.now() + 14 * 24 * 60 * 60 * 1000);
        max.setMinutes(max.getMinutes() - max.getTimezoneOffset());
        max.setMilliseconds(null);
        max.setSeconds(null);

        document.getElementById('date').value = now.toISOString().slice(0, -1);

        document.getElementById('date').min = now.toISOString().slice(0, -1);
        document.getElementById('date').max = max.toISOString().slice(0, -1);

        document.getElementById('dateEdit').min = now.toISOString().slice(0, -1);
        document.getElementById('dateEdit').max = max.toISOString().slice(0, -1);


  });

  $('#addForm').submit(function () {
    event.preventDefault();
    console.log("Adding");
    const $form = $(this);
    const $input = $form.find('select');

    const serializedData = $form.serialize();
    console.log(serializedData);

    $input.prop('disabled', true);

    request = $.ajax({
        url: 'handler/add.php',
        type: 'post',
        data: serializedData
    });

    request.done(function (response) {
        console.log(response);
        if (response == "Success") {
          alert("Termin zakazan!");
            console.log("Added appointment");
            location.reload(true);
        } else {
          alert("Termin nije zakazan!");
            console.log("Appointment not added " + response);
        }
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error("Error occurred: " + textStatus, errorThrown);
    });
})

$(".edit-appointment").click(function () {
        var id = $(this).val();
        console.log("Filling edit form");
        console.log(id);

        request = $.ajax({
            url: 'handler/get.php',
            type: 'post',
            data: {'id': id},
            dataType: 'json'
        });

        
        request.done(function (response) {
            console.log('Form filled');
            console.log(response);

            $('#idEdit').val(response.id);
            $('#userEdit').val(response.user.id);
            $('#serviceEdit').val(response.service.id);
            

            const date = new Date(response.date_time.date);
            date.setMinutes(date.getMinutes() - date.getTimezoneOffset());
            date.setSeconds(null);
            date.setMilliseconds(null);

            document.getElementById('dateEdit').value = date.toISOString().slice(0, -1);
            
        });

         request.fail(function (jqXHR, textStatus, errorThrown) {
           console.error("Error occurred: " + textStatus, errorThrown);
        });
    });

$('#editForm').submit(function () {
        event.preventDefault();
        console.log("Editing");
        const $form = $(this);
        const $inputs = $form.find('input,select');
        const serializedData = $form.serialize();
        console.log(serializedData);
        $inputs.prop('disabled', true);

        request = $.ajax({
            url: 'handler/edit.php',
            type: 'post',
            data: serializedData
        });

        request.done(function (response) {
            if (response === 'Success') {
              alert("Termin promenjen!");
                console.log('Termin promenjen!');
                location.reload(true);
            } else {
              alert("Termin nije promenjen!");
              console.log('Termin nije promenjen! ' + response);
            }
            console.log(response);
        });

        request.fail(function (jqXHR, textStatus, errorThrown) {
          console.error("Error occurred: " + textStatus, errorThrown);
        });
    });

    $(".delete-appointment").click(function () {
        var id = $(this).val();
        console.log("Deleting appointment with ID: " + id);

        request = $.ajax({
            url: 'handler/delete.php',
            type: 'post',
            data: {'id': id}
        });

        request.done(function (response) {
            if (response == "Success") {
              alert("Termin izbrisan!");
                console.log('Deleted');
                location.reload();
            } else {
              alert("Termin nije izbrisan!");
                console.log("Appointment not deleted " + response);
            }
            console.log(response);
        });
    });

    function searchAppointmentByProperty() {
        let selectedProperty = $("#search-appointments-dropdown option:selected").text();
        input = document.getElementById("searchAppointmentBar");
        filter = input.value.toUpperCase();

        let table = document.getElementById("appointmentTable");
        let tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            switch (selectedProperty) {
               
                
                case "ID termina":
                    td = tr[i].getElementsByTagName("td")[0];

                    break;
                case "Ime korisnika":
                    td = tr[i].getElementsByTagName("td")[1];
                    break;

                case "Prezime korisnika":
                    td = tr[i].getElementsByTagName("td")[2];
                    break;

                case "Usluga":
                    td = tr[i].getElementsByTagName("td")[3];
                    break;
                default:
            }
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function sortTable(n) {
      var table, rows, switching, i, x, y, shouldSwitch;
      table = document.getElementById("serviceTable");
      switching = true;
      
      while (switching) {
        
        switching = false;
        rows = table.rows;
        
        for (i = 1; i < (rows.length - 1); i++) {
          
          shouldSwitch = false;
         
          x = rows[i].getElementsByTagName("TD")[n];
          y = rows[i + 1].getElementsByTagName("TD")[n];
         
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            
            shouldSwitch = true;
            break;
          }
        }
        if (shouldSwitch) {
         
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
        }
      }
    }

    function sortTable2(n) {
      var table, rows, switching, i, x, y, shouldSwitch;
      table = document.getElementById("appointmentTable");
      switching = true;
      
      while (switching) {
        
        switching = false;
        rows = table.rows;
        
        for (i = 1; i < (rows.length - 1); i++) {
          
          shouldSwitch = false;
         
          x = rows[i].getElementsByTagName("TD")[n];
          y = rows[i + 1].getElementsByTagName("TD")[n];
         
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            
            shouldSwitch = true;
            break;
          }
        }
        if (shouldSwitch) {
         
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
        }
      }
    }
  
</script>
</body>
</html>