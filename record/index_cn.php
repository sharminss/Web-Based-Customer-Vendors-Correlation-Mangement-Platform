<?php

  // Create database connection
  
  $db = mysqli_connect("localhost", "root", "", "bismillah");
  
    session_start();
     $uid1=$_SESSION['email'];
	 $cm_name1 = $_SESSION['user_name'];
	 $type = $_SESSION['type'];

    // echo $uid1;
	// echo $cm_name1;
	

  // Initialize message variable
  $msg = "";
   
  $size = "";
  
  

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
	 $date = date('Y-m-d H:i:s');
    // Get image name
    $image = $_FILES['image']['name'];

    // Get text
    $image_text = mysqli_real_escape_string($db, $_POST['image_text']);

    // image file directory
    $target = "image_ad/".basename($image);
	$sql = "INSERT INTO Advertise(company_id,cm_name,image,text_,dateposted) VALUES ('$uid1','$cm_name1','$image', '$image_text', '$date')";
    // execute query
mysqli_query($db, $sql);

    //Targeting Folder for videos
    $video = $_FILES['video']['name'];
    $target1="videos/".basename($video);
   // $target1=$target1.basename($_FILES['video']['name']);
      //Getting Selected video Type
    $type=pathinfo($target1,PATHINFO_EXTENSION);
    // Moving The video file to Desired Directory
    if (move_uploaded_file($_FILES['video']['tmp_name'],$target1)) {
      $msg = "video uploaded successfully";
      $name1=$_FILES['video']['name'];
      $size=$_FILES['video']['size'];
	  $sql = "INSERT INTO Advertise(company_id,cm_name,image,text_,vdo_name,vdo_size,vdo_type,dateposted) VALUES ('$uid1','$cm_name1','$image', '$image_text','$name1','$size','$type','$date')";
    // execute query
mysqli_query($db, $sql);


    }else{
      $msg = "Failed to upload video";
    }
     // $uplaod_success=move_uploaded_file($_FILES['video']['tmp_name'],$target1);
  // if($uplaod_success){
  //  //Getting Selected video Information
     
  //   }

 

 

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      $msg = "Image uploaded successfully";
    }else{
      $msg = "Failed to upload image";
    }
	header('Location: projects_cm1.php');
  }
  $result = mysqli_query($db, "SELECT * FROM advertise order by dateposted desc" );
  if (!$result) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Review management</title>
    <meta name="description" content="Free Bootstrap Theme by uicookies.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">
    <link rel="stylesheet" href="css/styles-merged.css">
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="css/custom.css">

    <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.min.js"></script>
      <script src="js/vendor/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <!-- START: header -->
  
  <div class="probootstrap-loader"></div>

  <header role="banner" class="probootstrap-header">
    <div class="container">
	
	     <div class="probootstrap-logo">
  
		 <a href="index_cn.php" class="probootstrap-logo">পণ্য আলাপ</a>
          </div>
       
        
        <a href="#" class="probootstrap-burger-menu visible-xs" ><i>Menu</i></a>
        <div class="mobile-menu-overlay"></div>

        <nav role="navigation" class="probootstrap-nav hidden-xs">
          <ul class="probootstrap-main-nav">
            <li class="active"><a href="index_cn.php">Launched products</a></li>
            <li><a href="projects_cn.php">Product reviews</a></li>
            <li><a href="services_cn.php">Profile</a></li>
            <li><a href="about_cn.php">Add review</a></li>
            <li><a href="contact_cn.php">Contact</a></li>
          </ul>
          <ul class="probootstrap-right-nav hidden-xs">

		
			
			<li><a href="logout.php"<button type="button" class="btn btn-link" ><b>Log out</b></button></a></li>
          </ul>
          <div class="extra-text visible-xs"> 
            <a href="#" class="probootstrap-burger-menu"><i>Menu</i></a>
            <h5>Address</h5>
            <p>198 West 21th Street, Suite 721 New York NY 10016</p>
            <h5>Connect</h5>
            <ul class="social-buttons">
              <li><a href="#"><i class="icon-twitter"></i></a></li>
              <li><a href="#"><i class="icon-facebook2"></i></a></li>
              <li><a href="#"><i class="icon-instagram2"></i></a></li>
            </ul>
          </div>
        </nav>
    </div>
  </header>
  <!-- END: header -->
  <section class="probootstrap-slider flexslider">
    <ul class="slides">
      <li style="background-image: url(img/c4.jpg);" class="overlay2">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              <div class="slides-text probootstrap-animate" data-animate-effect="fadeIn">
                <h2>Stay Updated!</h2>
				  <p>Be the first -> know about -> upcoming products, sales, offers</p>
				<p>Share your thought to the world, make products better! </p>  
              </div>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </section>
  <!-- END: slider  -->
  
  
    <section class="probootstrap-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center section-heading probootstrap-animate">
          <h2>New Launched products</h2>
        </div>
      </div>
	  

	  
<?php
    while ($row = mysqli_fetch_array($result)) 
  {
	   
	  $aid=$row['ad_id'];
	   
	  $vid=$row['vdo_name'];
      
	  echo '<div class="container">';
	                
					echo '<div class="card" style="width: 100rem;">';
					echo '<div class="card-body">';
					echo '<div class="col-md-4 probootstrap-animate">';
				    echo '<div class="probootstrap-card with-hover">';
					echo '<div class="probootstrap-card-media">';
					
				if($row['image']!=null){
				
					echo '<img src="image_ad/'.$row['image'].'" class="img-responsive img-border">';
					
				    echo '<div class="probootstrap-card-text">';
					echo '<h2 class="probootstrap-card-heading mb0">';
					echo '<div class="Row">';
					echo '<img class="card-img-top" src="img/ruchi.png" width=10%>';
					echo "<p>".$row['cm_name']."</p>";
					echo '</h2>';
					
					
					
					
					echo '<p class="category">';
					echo "post date: ".$row['dateposted']."<br>";
					//echo " " . date("h:i:sa");
					echo '</p>';
					
					echo '<p class="card-text">';
					echo "<p>".$row['text_']."</p>";
					echo'</p>';
					echo '</div>';
					echo '  <p><a href="single-page.php">Reply</a></p>';
				}
				
				else if($row['vdo_name']!=null)
				{   
			    echo' <div class="probootstrap-video">';
					echo'<div class="embed-responsive embed-responsive-16by9">';
					// echo'<a href="https://vimeo.com/45830194" class="popup-vimeo probootstrap-video-play //overlay"><span><i class="icon-play3"></i></span></a>
					//echo '<iframe class="embed-responsive-item" src="videos/'.$row['vdo_name'].'" allowfullscreen>';
					//echo'</iframe>';
					//echo "<p>".$row['vdo_name']."</p>";
					//echo $row['vdo_type'];
					/*<div class="row">
        <div class="col-md-12 probootstrap-animate" data-animate-effect="fadeIn">
          <figure>
            <div class="probootstrap-video">
              <a href="https://vimeo.com/45830194" class="popup-vimeo probootstrap-video-play overlay"><span><i class="icon-play3"></i></span></a>
              <img src="img/slider_3.jpg" alt="Free HTML5 Bootstrap Template by uicookies.com" class="img-responsive">
            </div>
          </figure>
        </div>*/
					
					echo '<video class="embed-responsive-item" id="backgroundvid" width=100% controls >';
					//echo '<source src="videos/'.$row['vdo_name'].'" type="video/mp4"  position="relative">';
					echo '<source src="videos/'.$row['vdo_name'].'" type="video/webm" codecs="vp8.0, vorbis">';
					echo '<source src="videos/'.$row['vdo_name'].'" type="video/ogg" codecs="theora, vorbis">';
					echo '<source src="videos/'.$row['vdo_name'].'" type="video/mp4" codecs="avc1.4D401E, mp4a.40.2">';
					echo '</video>'; 
					echo '</div>';echo '</div>';
				    
					
					echo '<div class="probootstrap-card-text">';
					echo '<h2 class="probootstrap-card-heading mb0">';
					echo '<div class="Row">';
					echo '<img class="card-img-top" src="img/ruchi.png" width=10%>';
					echo "<p>".$row['cm_name']."</p>";
					echo '</h2>';
					
				
					echo '<p class="category">';
					echo "post date: ".$row['dateposted']."<br>";
					//echo " " . date("h:i:sa");
					echo '</p>';
					
					echo '<p class="card-text">';
					echo "<p>".$row['text_']."</p>";
					echo'</p>';
					echo '</div>';
					echo '  <p><a href="single-page.php">Reply</a></p>';
				}
	
		        
                  echo '</div>';
				  echo '</div>';
					
				echo '</div>';
				echo ' </div>';
				echo '</div>';
			
			 
	/*  echo'<div class="form-control">';
      echo "<p>".$row['text_']."</p>";
	  echo "</div>";
	  
 if($row['image']!=null)
 {  
     
	  echo "<div id='img_div'>";
      echo "<img src='image_ad/".$row['image']."' width=60% position:relative; >";
	  echo "</div>";
 }*/
    
 
   
    //  echo number_format($row['vdo_size']/(1024*1024),2);
     

  
  
     
	  
	  echo "</div>";
  
  
  }
  
?>  
	  


  <div class="probootstrap-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center section-heading probootstrap-animate">
          <h2>Our Profile</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 probootstrap-animate" data-animate-effect="fadeInLeft">

          <div class="panel-group probootstrap-panel" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingOne">
                <h3 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

                    Web Design
                  </a>
                </h3>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>

                  
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingTwo">
                <h3 class="panel-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    WordPress Integration
                  </a>
                </h3>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                  <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                  
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingThree">
                <h3 class="panel-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    SEO &amp; Ranking
                  </a>
                </h3>
              </div>
              <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                  <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                </div>
              </div>
            </div>
          </div>
          <!-- END panel-group -->
        </div>
        <div class="col-md-6 probootstrap-animate" data-animate-effect="fadeInRight">
          <p><img src="img/slider_2.jpg" alt="Free HTML Bootstrap Theme by uicookies.com" class="img-responsive"></p>
        </div>
      </div>
    </div>
  </div>
  <!-- END section -->

  <section class="probootstrap-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center section-heading probootstrap-animate">
          <h2>Watch Video</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 probootstrap-animate" data-animate-effect="fadeIn">
          <figure>
            <div class="probootstrap-video">
              <a href="https://vimeo.com/45830194" class="popup-vimeo probootstrap-video-play overlay"><span><i class="icon-play3"></i></span></a>
              <img src="img/slider_3.jpg" alt="Free HTML5 Bootstrap Template by uicookies.com" class="img-responsive">
            </div>
          </figure>
        </div>
      </div>
    </div>
  </section>
  <!-- END section -->

  <section class="probootstrap-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center section-heading probootstrap-animate">
          <h2>Recent Work</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 probootstrap-animate">
          <div class="probootstrap-card with-hover">
            <div class="probootstrap-card-media">
              <a href="single-page.php"><img src="img/slider_1.jpg" class="img-responsive img-border" alt="Free HTML5 Template by uicookies.com"></a>
            </div>
            <div class="probootstrap-card-text">
              <h2 class="probootstrap-card-heading mb0">Vokalia and Consonantia</h2>
              <p class="category">Design</p>
              <p><a href="single-page.php">View details</a></p>
            </div>
          </div>
        </div>
        <div class="col-md-4 probootstrap-animate">
          <div class="probootstrap-card with-hover">
            <div class="probootstrap-card-media">
              <a href="single-page.php"><img src="img/slider_2.jpg" class="img-responsive img-border" alt="Free HTML5 Template by uicookies.com"></a>
            </div>
            <div class="probootstrap-card-text">
              <h2 class="probootstrap-card-heading mb0">Live the Blind Texts</h2>
              <p class="category">Model</p>
              <p><a href="single-page.php">View details</a></p>
            </div>
          </div>
        </div>
        <div class="col-md-4 probootstrap-animate">
          <div class="probootstrap-card with-hover">
            <div class="probootstrap-card-media">
              <a href="single-page.php"><img src="img/slider_3.jpg" class="img-responsive img-border" alt="Free HTML5 Template by uicookies.com"></a>
            </div>
            <div class="probootstrap-card-text">
              <h2 class="probootstrap-card-heading mb0">Behind the Word Mountains</h2>
              <p class="category">Website</p>
              <p><a href="single-page.php">View details</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END section -->

  <section class="probootstrap-section probootstrap-section-lighter">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center section-heading probootstrap-animate">
          <h2>People Says...</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4  probootstrap-animate">
          <div class="probootstrap-testimony">
            <blockquote>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </blockquote>
            <div class="author">
              <img src="img/person_1.jpg" class="img-responsive" alt="Free HTML5 Bootstrap Theme by uicookies.com">
              <div>John Doe <span>Designer at uicookies.com</span></div>
            </div>
          </div>
        </div>
        <div class="col-md-4  probootstrap-animate">
          <div class="probootstrap-testimony">
            <blockquote>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </blockquote>
            <div class="author">
              <img src="img/person_2.jpg" class="img-responsive" alt="Free HTML5 Bootstrap Theme by uicookies.com">
              <div>John Doe <span>Designer at uicookies.com</span></div>
            </div>
          </div>
        </div>
        <div class="col-md-4  probootstrap-animate">
          <div class="probootstrap-testimony">
            <blockquote>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </blockquote>
            <div class="author">
              <img src="img/person_3.jpg" class="img-responsive" alt="Free HTML5 Bootstrap Theme by uicookies.com">
              <div>John Doe <span>Designer at uicookies.com</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- END section -->
  

  <footer class="probootstrap-footer probootstrap-bg">
    <div class="container">
      <div class="row mb60">
        <div class="col-md-3">
          <div class="probootstrap-footer-widget">
            <h4 class="heading">Add review Virb.</h4>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
            <p><a href="#">Read more...</a></p>
          </div> 
        </div>
        <div class="col-md-3">
          <div class="probootstrap-footer-widget probootstrap-link-wrap">
            <h4 class="heading">Quick Links</h4>
            <ul class="stack-link">
              <li><a href="#">Launched products</a></li>
              <li><a href="#">Add review</a></li>
              <li><a href="#">Profile</a></li>
              <li><a href="#">Products</a></li>
              <li><a href="#">Testimonial</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-3">
          <div class="probootstrap-footer-widget">
            <h4 class="heading">More Links</h4>
            <ul class="stack-link">
              <li><a href="#">Projects</a></li>
              <li><a href="#">Privacy</a></li>
              <li><a href="#">Terms</a></li>
              <li><a href="#">Career</a></li>
              <li><a href="#">Support Help</a></li>
            </ul>
          </div> 
        </div>
        <div class="col-md-3">
          <div class="probootstrap-footer-widget">
            <h4 class="heading">Subscribe</h4>
            <p>Far far away behind the word mountains far from.</p>
            <form action="#">
              <div class="form-field">
                <input type="text" class="form-control" placeholder="Enter your email">
                <button class="btn btn-subscribe">Send</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row copyright">
        <div class="col-md-6">
          <div class="probootstrap-footer-widget">
            <p>&copy; 2017 <a href="https://uicookies.com/">uiCookies:Virb</a>. Designed by <a href="https://uicookies.com/">uicookies.com</a> <br> Demo Photos from <a href="https://unsplash.com/">Unsplash</a></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="probootstrap-footer-widget right">
            <ul class="probootstrap-social">
              <li><a href="#"><i class="icon-twitter"></i></a></li>
              <li><a href="#"><i class="icon-facebook"></i></a></li>
              <li><a href="#"><i class="icon-instagram2"></i></a></li>
			  
			  <li><a href="logout.php"<button type="button" class="btn btn-link" ><b>Log out</b></button></a></li>
			  
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-chevron-thin-up"></i></a>
  </div>
  

  <script src="js/scripts.min.js"></script>
  <script src="js/main.min.js"></script>
  <script src="js/custom.js"></script>

  </body>
</html>