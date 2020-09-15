<?php
    $conn =mysqli_connect('localhost','root','','domainproject');
    if(isset($_POST['submit']))
        {
            $user=$_POST['username'];
            $pwd=$_POST['password'];
            $query="SELECT * FROM users WHERE username='$user' && password='$pwd'";
            $data=mysqli_query($conn, $query);
            $total=mysqli_num_rows($data);
            if($total==1)
            {
                header('location:video.html');  
            }
            else
            {
                header('location:error.html');
            }
        }







              if(isset($_POST['singup']))
              {
                  $username=mysqli_real_escape_string($conn, $_POST['userup']);
                  $userid=mysqli_real_escape_string($conn, $_POST['useridup']);
                  $email=mysqli_real_escape_string($conn, $_POST['emailup']);
                  $password=mysqli_real_escape_string($conn, $_POST['passup']);
                  $cpassword=mysqli_real_escape_string($conn, $_POST['cpassup']);

                  $passwd= md5($password);
                  $acpass=md5($cpassword);
                  

                  $emailquery= "SELECT * FROM regd WHERE email='$email' ";
                  $inquery=mysqli_query($conn, $emailquery);
                  $emailcount=mysqli_num_rows($inquery);
                  
                  if($emailcount>0)
                  {
                      ?>
                            <script>
                                alert("Email already exist");
                            </script>
                        <?php
                  }
                  else
                  {
                      if($passwd === $acpass)
                      {
                          $insertquery= " insert into regd (uname,uid,email,pass,cpass) values('$username', '$userid', '$email', '$passwd', '$acpass')";
                          $iquery=mysqli_query($conn,$insertquery);
                          if($iquery)
                            {
                              $from='TeamExploitus@chinmayakumarbiswal.in';
                              $to=$email;
                              $subject='Welcome to exploitus';
                              $message="Thank You: ".$username."  for creating an account and exploit team welcome you "."\n". "\n"."\n". "Thank You" ."\n". "Chinmaya Kumar Biswal";
                              $headers="From: ".$from;
                              mail($to, $subject, $message, $headers);
                                ?>
                                  <script>
                                      alert("Inserted Successful");
                                  </script>
                                <?php
                            }
                            else
                            {
                                ?>
                                  <script>
                                      alert("Connection Faild Error. Please contact us using whatsapp or any social address so we can solve it");
                                  </script>
                                <?php
                            }
                          
                      }
                      else
                      {
                          ?>
                            <script>
                                alert("Password Doesnot Match");
                            </script>
                        <?php
                      }
                  }
              }




    if(isset($_POST['entry']))
    {
        $mail=$_POST['email'];
        $mess=$_POST['message'];
        $query= " insert into userinput (email,message) values('$mail', '$mess')";
        mysqli_query($conn,$query);
        
    }
?>