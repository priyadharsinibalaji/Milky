<?php
// Database connection
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "milky";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data safely
$name    = $conn->real_escape_string($_POST['name']);
$email   = $conn->real_escape_string($_POST['email']);
$subject = $conn->real_escape_string($_POST['subject']);
$message = isset($_POST['message']) ? $_POST['message'] : '';

// Insert query
$sql = "INSERT INTO messages (name, email, subject, message) 
        VALUES ('$name', '$email', '$subject', '$message')";

if ($conn->query($sql) === TRUE) {
    // Success page design
    echo '
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Message Sent — Milky</title>

  <!-- AOS CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    body{
      margin:0;
      font-family:"Orbitron",Arial, sans-serif;
      height:100vh;
      display:flex;
      justify-content:center;
      align-items:center;
      background:url("Images/dark-bg.jpg") no-repeat center center/cover;
      position:relative;
      color:#fff;
    }
    /* Neon glow overlay */
    body::before{
      content:"";
      position:absolute;
      top:0; left:0; right:0; bottom:0;
      background:rgba(0,0,0,0.65);
      z-index:0;
    }
    .card{
      background:rgba(0,0,0,0.3);
      padding:50px 40px;
      border-radius:20px;
      text-align:center;
      max-width:420px;
      width:90%;
      z-index:1;
      border:2px solid #3b9400;
      box-shadow:0 0 30px #1a9b01, 0 0 60px #48fa02;
    }
    .icon{
      width:100px;
      height:100px;
      border-radius:50%;
      background:#52df00;
      display:flex;
      justify-content:center;
      align-items:center;
      color:#0f172a;
      font-size:46px;
      margin:0 auto 20px;
      box-shadow:0 0 20px #01b91a, 0 0 40px #5af301;
      animation: pulse 1s ease infinite;
    }
    @keyframes pulse{
      0%,100%{transform:scale(1);}
      50%{transform:scale(1.15);}
    }
    h1{
      margin:15px 0;
      font-size:28px;
      font-weight:700;
      color:#ffffff;
      text-shadow:0 0 10px #73b805, 0 0 20px #1caa00;
    }
    p{
      color:#e0f2fe;
      margin-bottom:30px;
      line-height:1.6;
    }
    .btn{
      background:transparent;
      border:2px solid #4ce903;
      padding:12px 28px;
      border-radius:12px;
      color:#ffffff;
      font-weight:600;
      text-decoration:none;
      display:inline-block;
      transition: all 0.3s ease;
      box-shadow:0 0 15px #10c400, 0 0 30px #2bd401;
    }
    .btn:hover{
      background:#1de902;
      color:#0f172a;
      transform:scale(1.05);
      box-shadow:0 0 25px #22ce00, 0 0 50px #13cc02;
    }
  </style>
</head>
<body>
  <div class="card" data-aos="fade-up" data-aos-duration="1000">
    <div class="icon" data-aos="zoom-in" data-aos-delay="300">✓</div>
    <h1 data-aos="fade-up" data-aos-delay="500">Message Sent!</h1>
    <p data-aos="fade-up" data-aos-delay="700">Your message has been received. We’ll contact you shortly.</p>
    <a href="index.html" class="btn" data-aos="fade-up" data-aos-delay="900">Return to Home</a>
  </div>

  <!-- AOS JS -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>
    ';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
