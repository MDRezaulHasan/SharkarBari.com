<?php 
session_start();
if (isset($_SESSION['email']) == true) {
    header("Location: index.php");
}elseif (isset($_SESSION['tenant_email']) == TRUE) {
    header("Location: index.php");
}
include 'database/db_connection.php';
include 'helpers/function.php';


if(isset($_POST['signup'])){
    global $con;
    
    $firstName  = validate($_POST['firstname']);
    $lastName = validate($_POST['lastname']);
    $email = validate($_POST['email']);
    $password= validate($_POST['password']);
    $cf_password = validate($_POST['cf_password']);
    $phone = validate($_POST['phone']);
    $address = validate($_POST['address']);
    $zipcode = validate($_POST['zipcode']);
    $nid_number = validate($_POST['nid_number']);
    $code = md5(uniqid(rand()));
    
    $firstName = mysqli_real_escape_string($con,$firstName);
    $lastName = mysqli_real_escape_string($con,$lastName);
    $email = mysqli_real_escape_string($con,$email);
    $password = mysqli_real_escape_string($con,$password);
    $cf_password = mysqli_real_escape_string($con,$cf_password);
    $phone = mysqli_real_escape_string($con,$phone);
    $address = mysqli_real_escape_string($con,$address);
    $zipcode = mysqli_real_escape_string($con,$zipcode);
    $nid_number = mysqli_real_escape_string($con,$nid_number);
    
    /*******NID Image upload code********/
    $permitted    = array('jpg','png','jpeg','gif');
    $file_name    = $_FILES['nid_image']['name'];
    $file_size    = $_FILES['nid_image']['size'];
    $file_temp    = $_FILES['nid_image']['tmp_name'];

    $div          = explode('.', $file_name);
    $file_ext     = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_nid_image = "owners_upload/".$unique_image;
    
    
    $email_nid_query = "SELECT * FROM tbl_owner WHERE email='$email' OR nid_number='$nid_number'";
    $result = mysqli_query($con, $email_nid_query);
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        $msg = " <div class='alert alert-danger'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Sorry !</strong>  Email/NID Number allready exists , Please Try another one
                </div>";
    }elseif(empty($firstName) || empty ($lastName) ||empty ($email) ||empty ($password)||empty ($cf_password)||
       empty ($phone)||empty($address)||empty ($zipcode)||empty ($nid_number)||empty ($file_name))
    {
        
        $msg = "<div class='alert alert-danger'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Warning!</strong> Input Field Must Not Be Empty.
                </div>";
    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $msg = "<div class='alert alert-danger'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Error!</strong> Invalid Email Address.
                </div>";
    }elseif ($password !== $cf_password) {
       $msg = "<div class='alert alert-danger'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Warning!</strong> Password And Confirm Password Not Matched.
                </div>";
    }elseif($file_size > 2048567){
        $msg = "<div class='alert alert-danger'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Warning!</strong> Image Size Must Be Less Then 2MB.
                </div>";
   }elseif(in_array($file_ext, $permitted) === false){
        $msg = "<div class='alert alert-danger'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Warning!</strong> Input Field Must Not Be Empty.".implode(', ',$permitted).
                "</div>";
   }else{
        
        move_uploaded_file($file_temp, $uploaded_nid_image);
        $password = md5($password);

        $query = "INSERT INTO tbl_owner(firstname,lastname,email,password,phone,address,zipcode,nid_number,nid_image,code)
                 VALUES('$firstName','$lastName','$email','$password','$phone','$address','$zipcode','$nid_number','$uploaded_nid_image','$code')";

        $insert_data = mysqli_query($con,$query);
        if ($insert_data) {
             $message = "					
                         Hello $firstName,
                         <br /><br />
                         Welcome to Sarkar Bari!<br/>
                         To complete your registration  please , just click following link<br/>
                         <br /><br />
                         <a href='http://localhost/sharkarbari.com/verify.php?email=$email&&code=$code'>Click HERE to Activate :)</a>
                         <br /><br />
                         Thanks,";

             $subject = "Confirm Registration";

             send_mail($email,$message,$subject);	
             $msg = "<div class='alert alert-success'>
                         <button class='close' data-dismiss='alert'>&times;</button>
                         <strong>Success!</strong>  We've sent an email to $email.
                         Please click on the confirmation link in the email to create your account.  
                     </div>
                     ";

        } else {
            $msg = "<div class='alert alert-danger'>
                         <button class='close' data-dismiss='alert'>&times;</button>
                         <strong>Warning!</strong> Sign Up Failed
                     </div>";
        }
 
   }  
    
}

include'include/header.php';
?>

    <script type='text/javascript'>
        function preview_image(event)
        {
            var reader = new FileReader();
            reader.onload = function()
            {
                var output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <!-- banner -->
    <div class="inside-banner">
        <div class="container"> 
            <span class="pull-right"><a href="#">Home</a> / Sign Up</span>
            <h2>Sign Up</h2>
        </div>
    </div>
    <!-- banner -->


    <section class="container-fluid owner-registration-form-section">
        <div class="container">
            <div class="row">

                <form class="form-horizontal" id="defaultForm" action="" method="POST" enctype="multipart/form-data">
                    <?php
                    if(isset($msg))
                    {
                        echo $msg;               
                    }
                    ?>

                    <!-- Form Name -->
                    <h2>Owner Sign Up</h2>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="fn">First name</label>  
                        <div class="col-md-4">
                           <input id="fn" name="firstname" type="text" class="form-control input-md" >
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="ln">Last name</label>  
                        <div class="col-md-4">
                            <input id="ln" name="lastname" type="text" class="form-control input-md" >
                        </div>
                    </div>               


                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="email">Email</label>  
                        <div class="col-md-4">
                            <input id="email" name="email" type="email" class="form-control input-md" >
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="password">Password</label>  
                        <div class="col-md-4">
                            <input id="password" name="password" type="password"  class="form-control input-md" >
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="cfpassword">Confirm Password</label>  
                        <div class="col-md-4">
                            <input id="cfpassword" name="cf_password" type="password" class="form-control input-md" >
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="phone">Phone No.</label>  
                        <div class="col-md-4">
                            <input id="phone" name="phone" type="tel" class="form-control input-md" >
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="add1">Address</label>  
                        <div class="col-md-4">
                            <textarea name="address" class="form-control"></textarea>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="zip">Area Zip Code</label>  
                        <div class="col-md-4">
                            <input id="zip" name="zipcode" type="text" class="form-control input-md" >
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="nidnum">National Identity  Number(NID)</label>  
                        <div class="col-md-4">
                            <input id="nidnum" name="nid_number" type="number"  class="form-control input-md" >
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label" for="nidimage">Upload Your NID Photo</label>  
                        <div class="col-md-4">
                            <input id="nidimage" name="nid_image" type="file" accept="image/*" onchange="preview_image(event)"  class="form-control input-md" >                   
                        </div>               
                    </div>
                    <div  class="form-group">
                        <label class="col-md-3 control-label"></label> 
                        <div class="col-md-4" id="nid-photo">
                            <img src="images/" id="output_image"/>                     
                        </div>
                    </div> 

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="submit"></label>
                        <div class="col-md-4">
                            <button id="submit" name="signup" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

<!--<script type="text/javascript">
        $(document).ready(function() {
            $('#defaultForm').formValidation({
                message: 'This value is not valid',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },              
                fields: {
                    firstname: {
                        validators: {
                            notEmpty: {
                                message: 'The firstname is required'
                            }
                        }
                    },
                    lastname: {
                        validators: {
                            notEmpty: {
                                message: 'The lastname is required'
                            }
                        }
                    },
                    email: {
                        verbose: false,
                        validators: {
                            notEmpty: {
                                message: 'The email address is required and can\'t be empty'
                            },
                            emailAddress: {
                                message: 'The input is not a valid email address'
                            },
                            stringLength: {
                                max: 512,
                                message: 'Cannot exceed 512 characters'
                            },
                            remote: {
                                type: 'GET',
                                url: 'https://api.mailgun.net/v2/address/validate?callback=?',
                                crossDomain: true,
                                name: 'address',
                                data: {
                                    // Registry a Mailgun account and get a free API key
                                    // at https://mailgun.com/signup
                                    api_key: 'pubkey-83a6-sl6j2m3daneyobi87b3-ksx3q29'
                                },
                                dataType: 'jsonp',
                                validKey: 'is_valid',
                                message: 'The email is not valid'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            }
                        }
                    },
                    cf_password: {
                        validators: {
                            notEmpty: {},
                            identical: {
                                field: 'password'
                            }
                        }
                    },
                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'The phone number is required'
                            },
                            digits: {},
                            phone: {
                                country: 'BD'
                            }
                        }
                    },
                    address: {
                        validators: {
                            notEmpty: {
                                message: 'The address is required'
                            }
                        }
                    },
                    zipcode: {
                        validators: {
                            notEmpty: {
                                message: 'The zipcode is required'
                            }
                        }
                    },
                    nid_number: {
                        validators: {
                            notEmpty: {
                                message: 'The NID number is required'
                            }
                        }
                    },
                    nid_image: {
                        validators: {
                            notEmpty: {
                                message: 'The NID photo is required'
                            }
                        }
                    }
                    
                }
            });
             
        });
    </script>-->
<?php include'include/footer.php';?>