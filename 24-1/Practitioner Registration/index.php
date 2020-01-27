<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practitioner Registration Form</title>
    <style>
        .conatiner {
            width: 430px;
            margin: auto;
        }

        label {
            width: 130px;
            display: inline-block;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div>

        <?php
        if (isset($_POST['submit'])) {            
            $prefix = $_POST['prefix'];
            //validation
            if (preg_match('/[a-zA-Z]{1,10}/', $_POST['firstName'])) {
                $_SESSION['firstName'] = $_POST['firstName'];
            } else {
                echo "enter valid firstname <br>";
            }
            if (preg_match('/[a-zA-Z]{1,10}/', $_POST['lastName'])) {
                $_SESSION['lastName'] = $_POST['lastName'];
            } else {
                echo "enter valid firstname <br>";
            }
            if (strlen(($_POST['phoneNo'])) == 10) {
                $_SESSION['phoneNo'] = $_POST['phoneNo'];
            } else {
                echo "enter valid phone number <br>";
            }
            if (!empty($_POST['dob'])) {
                $_SESSION['dob'] = $_POST['dob'];
            } else {
                echo "enter valid dob <br>";
            }
            if (preg_match('/^[\\w\\-]+(\\.[\\w\\-]+)*@([A-Za-z0-9-]+\\.)+[A-Za-z]{2,4}$/', $_POST['email']) && isset($_POST['email'])) {
                $_SESSION['email'] = $_POST['email'];
            } else {
                echo "enter valid email <br>";
            }
            if (!empty($_POST['password']) && ($_POST['password'] == $_POST['confirmPassword'])) {
                $_SESSION['password'] = $_POST['password'];
            } else {
                echo "enter valid password  <br>";
            }
            if (!empty($_POST['address1']) && !empty($_POST['address2'])) {
                $_SESSION['address1'] = $_POST['address1'];
                $_SESSION['address2'] = $_POST['address2'];
            } else {
                echo "enter in address line 1 and 2 <br>";
            }
            if (!empty($_POST['contry'])) {
                $_SESSION['contry'] = $_POST['contry'];
            } else {
                echo "enter a contry name <br>";
            }
            if (!empty($_POST['describeYourself'])) {
                $_SESSION['describeYourself'] = $_POST['describeYourself'];
            } else {
                echo "please enter in describe field <br>";
            }
            if (isset($_POST['businessYear'])) {
                $_SESSION['businessYear'] = $_POST['businessYear'];
            } else {
                echo "select one range year please<br>";
            }
            $hobbies = [];
            if (!empty($_POST['hobbies'])) {
                $hobbies = $_POST['hobbies'];
            } else {
                echo "select one Hobbie please<br>";
            }

            if (
                !empty($_POST['company']) && !empty($_POST['city']) && !empty($_POST['state']) &&
                !empty($_POST['numberClient']) &&  !empty($_POST['postalCode'])
            ) {
                $_SESSION['company'] = $_POST['company'];
                $_SESSION['city'] = $_POST['city'];
                $_SESSION['state'] = $_POST['state'];
                $_SESSION['postalCode'] = $_POST['postalCode'];
                $_SESSION['numberClient'] = $_POST['numberClient'];
            } else {
                echo "Enter all field <br>";
            }

            $getInTouch = ['post', 'emailCheckbox', 'sms', 'phone'];

            foreach ($getInTouch as $item) {
                if (isset($_POST["$item"])) {
                    $_SESSION["$item"] = $item;
                }
            }

            //profile 
            $profileImage = $_FILES['profileImage']['name'];
            $extensionProfile = substr($profileImage, strpos($profileImage, '.') + 1);
            $typeProfile = $_FILES['profileImage']['type'];
            $tempProfile = $_FILES['profileImage']['tmp_name'];

            if (isset($profileImage)) {
                if (!empty($profileImage)) {
                    if ($extensionProfile == 'jpg' || $extensionProfile == "jpeg" && $typeProfile == "image/jpeg") {
                        $location = 'upload/';
                        if (move_uploaded_file($tempProfile, $location . $profileImage)) {
                            echo "uploaded image successfully  <br>";
                        } else {
                            echo "Error in upload <br>";
                        }
                    } else {
                        echo "please upload only  jpeg file <br>";
                    }
                } else {
                    echo "please choose a profile <br>";
                }
            }

            //certificate 
            $certificate = $_FILES['certificate']['name'];
            $extensionCertificate = substr($certificate, strpos($certificate, '.') + 1);
            $typeCertificate = $_FILES['certificate']['type'];
            $tempCertificate = $_FILES['certificate']['tmp_name'];

            if (isset($certificate)) {
                if (!empty($certificate)) {
                    if ($extensionCertificate == 'pdf' || $extensionCertificate == "pdf" && $typeCertificate == "application/pdf") {
                        $location = 'upload/';
                        if (move_uploaded_file($tempCertificate, $location . $certificate)) {
                            echo "uploaded pdf successfully<br> ";
                        } else {
                            echo "Error in upload <br>";
                        }
                    } else {
                        echo "please upload only  pdf file <br>";
                    }
                } else {
                    echo "please choose a Document file <br>";
                }
            }
        }

        ?>
    </div>
    <div class="conatiner">
        <h2>Practitioner Registration Form</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <p>YOUR ACCOUNT DETAILS</p>
                <select name="prefix" id="prefix">
                    <option value="Mr.">Mr.</option>
                    <option value="Miss.">Miss.</option>
                    <option value="Ms.">Ms.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Dr.">Dr.</option>
                </select>
                <input type="text" name="firstName" id="firstName" value="<?php echo isset($_SESSION['firstName']) ? $_SESSION['firstName'] : ""; ?>" placeholder=" First Name">
                <input type="text" name="lastName" id="lastName" value="<?php echo isset($_SESSION['lastName']) ? $_SESSION['lastName'] : ""; ?>" placeholder=" Last Name">
            </div>
            <br>
            <div>
                <label for="dob">Date of Birth : </label>
                <input type="date" name="dob" value="<?php echo isset($_SESSION['dob']) ? $_SESSION['dob'] : ""; ?> id=" dob">
            </div>
            <div>
                <label for="phoneNo">Phone No : </label>
                <input type="number" name="phoneNo" value="<?php echo isset($_SESSION['phoneNo']) ? $_SESSION['phoneNo'] : ""; ?>" id="phoneNo">
            </div>
            <div>
                <label for="email">Email Id : </label>
                <input type="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ""; ?>" id="email">
            </div>
            <div>
                <label for="password"> Password : </label>
                <input type="password" name="password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ""; ?>" id="password">
            </div>
            <div>
                <label for="confirmPassword"> Confirm Password : </label>
                <input type="password" name="confirmPassword" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ""; ?>" id="confirmPassword">
            </div>

            <p>ADDRESS INFORMATION</p>
            <div>
                <label for="address1"> Address Line 1 : </label>
                <textarea name="address1" id="address1" cols="30" rows="2"><?php echo isset($_SESSION['address1']) ? $_SESSION['address1'] : ""; ?></textarea>
            </div>
            <div>
                <label for="address2"> Address Line 2 : </label>
                <textarea name="address2" id="address2" cols="30" rows="2"><?php echo isset($_SESSION['address2']) ? $_SESSION['address2'] : ""; ?></textarea>
            </div>
            <div>
                <label for="company"> Company : </label>
                <input type="text" name="company" value="<?php echo isset($_SESSION['company']) ? $_SESSION['company'] : ""; ?>" id="company">
            </div>
            <div>
                <label for="city"> City : </label>
                <input type="text" name="city" value="<?php echo isset($_SESSION['city']) ? $_SESSION['city'] : ""; ?>" id="city">
            </div>
            <div>
                <label for="state"> State : </label>
                <input type="text" name="state" value="<?php echo isset($_SESSION['state']) ? $_SESSION['state'] : ""; ?>" id="state">
            </div>
            <div>
                <label for="contry">Contry</label>
                <select name="contry" id="contry">
                    <option value="India">India</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Canada">Canada</option>
                    <option value="Australia">Australia</option>
                    <option value="America">America</option>
                </select>
            </div>
            <div>
                <label for="postalCode"> Postal Code : </label>
                <input type="text" name="postalCode" value="<?php echo isset($_SESSION['postalCode']) ? $_SESSION['postalCode'] : ""; ?>" id="postalCode">
            </div>

            <div><input type="checkbox" name="displayinfo" id="displayinfo">Show Other Information</div>
            <div id="otherInfo">
                <p>OTHER INFORMATION</p>
                <div>
                    <label for="describeYourself">Describe Yourself</label>
                    <textarea name="describeYourself" id="describeYourself" cols="30" rows="2"><?php echo isset($_SESSION['describeYourself']) ? $_SESSION['describeYourself'] : ""; ?></textarea>
                </div>
                <div>
                    <label for="profileImage">Profile Image :</label>
                    <input type="file" name="profileImage" id="profileImage">
                </div>
                <div>
                    <label for="certificate">Certificate Upload :</label>
                    <input type="file" name="certificate" id="certificate">
                </div>
                <div>
                    <p>How long have you been in business?</p>
                    <input type="radio" name="businessYear" id="businessYear" value="UNDER 1 YEAR" <?php if (isset($_SESSION['businessYear'])  && $_SESSION['businessYear'] == "UNDER 1 YEAR") {
                                                                                                        echo "checked";
                                                                                                    } else {
                                                                                                        "";
                                                                                                    } ?>>UNDER 1 YEAR<br>
                    <input type="radio" name="businessYear" id="businessYear" value="1-2 YEARS" <?php if (isset($_SESSION['businessYear'])  && $_SESSION['businessYear'] == "1-2 YEARS") {
                                                                                                    echo "checked";
                                                                                                } else {
                                                                                                    "";
                                                                                                } ?>>1-2 YEARS<br>
                    <input type="radio" name="businessYear" id="businessYear" value="2-5 YEARS" <?php if (isset($_SESSION['businessYear']) && $_SESSION['businessYear'] == "2-5 YEARS") {
                                                                                                    echo "checked";
                                                                                                } else {
                                                                                                    "";
                                                                                                } ?>>2-5 YEARS<br>
                    <input type="radio" name="businessYear" id="businessYear" value="5-10 YEARS" <?php if (isset($_SESSION['businessYear']) && $_SESSION['businessYear'] == "5-10 YEARS") {
                                                                                                        echo "checked";
                                                                                                    } else {
                                                                                                        "";
                                                                                                    } ?>>5-10 YEARS<br>
                    <input type="radio" name="businessYear" id="businessYear" value="OVER 10 YEARS" <?php if (isset($_SESSION['businessYear']) && $_SESSION['businessYear'] == "OVER 10 YEARS") {
                                                                                                        echo "checked";
                                                                                                    }  ?>>OVER 10 YEARS<br>
                </div>
                <div>
                    <p>Number of unique clients you see each week?</p>
                    <select name="numberClient" id="numberClient">
                        <option value="1-5">1-5</option>
                        <option value="6-10">6-10</option>
                        <option value="11-15">11-15</option>
                        <option value="15+">15+</option>
                    </select>
                </div>
                <div>
                    <p>How do you like us to get in touch with you?</p>
                    <input type="checkbox" name="post" value="Post" <?php if (isset($_SESSION['post'])) {
                                                                        echo 'checked';
                                                                    } ?>>Post<br>
                    <input type="checkbox" name="emailCheckbox" value="Email" <?php if (isset($_SESSION['emailCheckbox'])) {
                                                                                    echo 'checked';
                                                                                } ?>>Email<br>
                    <input type="checkbox" name="sms" value="SMS" <?php if (isset($_SESSION['sms'])) {
                                                                        echo 'checked';
                                                                    } ?>>SMS<br>
                    <input type="checkbox" name="phone" value="Phone" <?php if (isset($_SESSION['phone'])) {
                                                                            echo 'checked';
                                                                        } ?>>Phone<br>
                </div>
                <div>
                    <label for="hobbies">Hobbies :</label>
                    <select name="hobbies[]" multiple>
                        <option value="Listening to Music">Listening to Music</option>
                        <option value="Art">Art</option>
                        <option value="Sports">Sports</option>
                        <option value="Blogging">Blogging</option>
                        <option value="Travelling">Travelling</option>
                    </select>
                </div>
            </div>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <script>
        if (document.getElementById("displayinfo").checked) {
            document.getElementById("otherInfo").style.display = 'block';
        }
        document.getElementById("otherInfo").style.display = 'none';

        document.getElementById("displayinfo").addEventListener("click", () => {
            if (document.getElementById("displayinfo").checked) {
                document.getElementById("otherInfo").style.display = 'block';
            } else {
                document.getElementById("otherInfo").style.display = 'none';

            }
        });
    </script>

</body>

</html>