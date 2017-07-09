<!DOCTYPE HTML>
<html>

<head>
  <title>Home</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>

<body>
  <div id="main">
    
    <div id="top_split">	
	
	<header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php"> Student <span class="logo_colour"> Accommodations</span></a></h1>
          <h2>The Best Accommodation Service For University Students.</h2>
        </div>
      </div>
      <nav>
        <ul class="sf-menu" id="nav">
          <li class="selected"><a href="index.php">Home</a></li>
          <li><a href="aboutus.php">About Us</a></li>
          <li><a href="information.php">Accommdoation</a>
            <ul>
              <li><a href="information.php">Information</a></li>
              <li><a href="#">Student</a>
                <ul>
                  <li><a href="UserRegistration.php">Create New Account</a></li>
                  <li><a href="Login.php">Login</a></li>
                  <li><a href="Bookings.php">Book-A-Room</a></li>
                  
                </ul>
              </li>
              <li><a href="#">Chinhoyi Residence</a></li>
              <li><a href="#">Masvingo</a></li>
              <li><a href="#">MSU</a></li>
            </ul>
          </li>
          <li><a href="contact.php">Contact Us</a></li>
        </ul>
      </nav>

      <ul id="images">
        <li><img src="images/IMG-20170126-WA0002.jpg" width="600" height="300" alt="gallery_buildings_one" /></li>
        <li><img src="images/IMG-20170126-WA0003.jpg" width="600" height="300" alt="gallery_buildings_two" /></li>
        <li><img src="images/IMG-20170126-WA0001.jpg" width="600" height="300" alt="gallery_buildings_three" /></li>
        <li><img src="images/IMG-20170128-WA0002.jpg" width="600" height="300" alt="gallery_buildings_four" /></li>
        <li><img src="images/IMG-20170128-WA0003.jpg" width="600" height="300" alt="gallery_buildings_five" /></li>
        <li><img src="images/IMG-20170128-WA0004.jpg" width="600" height="300" alt="gallery_buildings_six" /></li>
      </ul>	  
	
	</header>

	</div>  
	
	<div id="site_content">
      <div id="sidebar_container">
        <div class="sidebar">
          <h3>Latest News</h3>
          <h4>New Website Launched</h4>
          <h5>January 21st, 2017</h5>
          <p>2017 sees the redesign of our website. Take a look around and let us know what you think.<br /><a href="#">Read more</a></p>
          <h4>20% Discount</h4>
          <h5>December 1st, 2017</h5>
          <p>We are offering a 20% discount to all new customers.<br /><a href="#">Read more</a></p>
        </div>
      </div>
      <div class="content">
        <h1>Welcome to the Student Accommodations</h1>
        <p>This simple, web based online booking system which allows University Students from <strong>Nust</strong>, <strong>MSU</strong> and <strong>Chinhoyi</strong> to book for accommodation. For new users, you can register <a href="UserRegistration.php"><strong>here</strong></a> or if you are already a user you can <a href="Login.php"><strong>login</strong></a> . </p>
        
        
      </div>
    </div>
    <footer>
      <p>Copyright &copy; 2017 | Student Accommodations | <a href="Contactme.php">Designed by Clive M. Shenje</a></p>
    </footer>
  </div>
  <p>&nbsp;</p>
  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript" src="js/jquery.kwicks-1.5.1.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#images').kwicks({
        max : 600,
        spacing : 2
      });
      $('ul.sf-menu').sooperfish();
    });
  </script>
</body>
</html>
