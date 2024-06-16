<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $lnameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $lname = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
  if (empty($_POST["name"])) {
    $nameErr = "İsim gerekli";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Yalnızca harflere ve boşluklara izin verilir.";
    }
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["lname"])) {
      $lnameErr = "Soyisim gerekli";
    } else {
      $lname = test_input($_POST["name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
        $lnameErr = "Yalnızca harflere ve boşluklara izin verilir.";
      }
    }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email gerekli";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Email formantında değil.";
    }
  }

    
  if (empty($_POST["website"])) {
    $websiteErr = "*Şifre gerekli";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Şifre formantında değil.";
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Cinsiyet gerekli.";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

if(isset($_POST['kullanici']) && isset($_POST['sifre'])) {
  $kullanici = $_POST['kullanici'];
  $sifre = $_POST['sifre'];

  if(empty($kullanici) || empty($sifre)) {
     echo 'Lütfen boş bırakmayın';
  } else {
     echo 'Girilen kullanıcı adı: ' . $kullanici . ' şifre: ' . $sifre;
  }
} else {
  echo 'Lütfen formu kullanın';
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Form</h2>
<p><span class="error"></span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  İsim: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Soyisim: <input type="text" name="name" value="<?php echo $lname;?>">
  <span class="error">* <?php echo $lnameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Şifre: 
  <input type="password" name="password"/> 
  <span style="color:red;">*</span>             
  <br><br>
  Doğum Tarihi: <input type = "comment" name="comment" ><?php echo $comment;?>
  <br><br>
  Cinsiyet:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Kadın
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Erkek
  
   
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Gönder">  
</form>

<?php
echo "<h2>Girişiniz:</h2>";
echo $name;
echo "<br>";
echo $lname;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>

</body>
</html>