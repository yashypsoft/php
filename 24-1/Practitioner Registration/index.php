<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practitioner Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <?php require_once "formPost.php" ?>

    </div>
    <div class="conatiner">
        <h2>Practitioner Registration Form</h2>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div>
                <p>YOUR ACCOUNT DETAILS</p>

                <div>
                    <label for="prefix">Prefix</label>
                    <select name="account[prefix]" id="prefix">
                        <?php $prefixData = ['Prefix','Mr', 'Miss', 'Mrs', 'Dr']; ?>
                        <?php foreach ($prefixData as $prefix) : ?>
                            <?php
                            $selected = (getData('account', 'prefix') == $prefix)
                                ? "selected"
                                : ""
                            ?>
                            <option value="<?= $prefix  ?>" <?= $selected ?>>
                                <?php echo $prefix ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="err">
                        <?php echo (ValidateData('account', 'prefix'))
                             ? "Enter valid prfix"
                             : ""?>
                    </span>
                </div>
                <div>
                    <label for="firstName">First Name</label>
                    <input type="text" name="account[firstName]" 
                    value="<?= getData('account', 'firstName') ?>">
                    <?php echo (ValidateData('account', 'firstName'))
                                ? "<span>Enter valid First Name<span>"
                                : ""?>
                </div>
                <div>
                    <label for="lastName">Last Name</label>
                    <input type="text" name="account[lastName]" 
                    value="<?= getData('account', 'lastName') ?>">
                    <?php echo (ValidateData('account', 'lastName'))
                            ? "<span>Enter valid Lastname</span>"
                            : ""?>
                </div>
            </div>
            <br>
            <div>
                <label for="dob">Date of Birth : </label>
                <input type="date" name="account[dob]" id="dob"
                 value="<?= getData('account', 'dob') ?>">
                <?php echo (ValidateData('account', 'dob'))
                        ? "<span>Enter valid Dob</span>"
                        : ""?>
            </div>
            <div>
                <label for="phoneNo">Phone No : </label>
                <input type="number" name="account[phoneNo]" id="phoneNo" 
                value="<?= getData('account', 'phoneNo') ?>">
                <?php echo (ValidateData('account', 'phoneNo'))
                        ? "<span>Enter Phone no<span>"
                        : ""?>
            </div>
            <div>
                <label for="email">Email Id : </label>
                <input type="email" name="account[email]" id="email" 
                value="<?= getData('account', 'email') ?>">
                <?php echo (ValidateData('account', 'email'))
                        ? "<span>Enter valid Email Id</span>"
                        : ""?>
            </div>
            <div>
                <label for="password"> Password : </label>
                <input type="password" name="account[password]" id="password"
                 value="<?= getData('account', 'password') ?>">  
                <?php echo (ValidateData('account', 'password'))
                        ? "<span>Enter valid Password</span>"
                        : ""?>
                
            </div>
            <div>
                <label for="confirmPassword"> Confirm Password : </label>
                <input type="password" name="confirmPassword" id="confirmPassword" 
                value="<?= getData('account', 'password') ?>">
            </div>

            <p>ADDRESS INFORMATION</p>
            <div>
                <label for="address1"> Address Line 1 : </label>
                <textarea name="address[address1]" id="address1"
                 cols="30" rows="2"><?= getData('address', 'address1') ?></textarea>
                <?php echo (ValidateData('address', 'address1'))
                        ? "<span>Enter valid Address line 1</span>"
                        : ""?>
            </div>
            <div>
                <label for="address2"> Address Line 2 : </label>
                <textarea name="address[address2]" id="address2" 
                cols="30" rows="2"><?= getData('address', 'address2') ?></textarea>
                <?php echo (ValidateData('address', 'address2'))
                        ? "<span>Enter valid Address line 2</span>"
                        : ""?>
            </div>
            <div>
                <label for="company"> Company : </label>
                <input type="text" name="address[company]" id="company"
                 value="<?= getData('address', 'company') ?>">
                 <?php echo (ValidateData('address', 'company'))
                        ? "<span>Enter valid Company Name</span>"
                        : ""?>
            </div>
            <div>
                <label for="city"> City : </label>
                <input type="text" name="address[city]" id="city" 
                value="<?= getData('address', 'city') ?>">
                <?php echo (ValidateData('address', 'city'))
                        ? "<span>Enter valid city Name</span>"
                        : ""?>
            </div>
            <div>
                <label for="state"> State : </label>
                <input type="text" name="address[state]" id="state" 
                value="<?= getData('address', 'state') ?>">
                <?php echo (ValidateData('address', 'state'))
                        ? "<span>Enter valid state Name</span>"
                        : ""?>
            </div>
            <div>
                <label for="contry">Contry</label>
                <select name="address[contry]" id="contry">
                    <?php $countryData = ['Contry','India', 'Nepal', 'Canada', 'Austarlia', 'America']; ?>
                    <?php foreach ($countryData as $country) : ?>
                        <?php $selected = (getData('address', 'contry') == $country)
                            ? "selected"
                            : ""
                        ?>
                        <option value="<?= $country ?>" <?= $selected ?>><?= $country ?></option>
                    <?php endforeach; ?>
                </select>
                <?php echo (ValidateData('address', 'contry'))
                        ? "<span>Enter valid contry Name</span>"
                        : ""?>
            </div>
            <div>
                <label for="postalCode"> Postal Code : </label>
                <input type="text" name="address[postalCode]" id="postalCode" 
                value="<?= getData('address', 'postalCode') ?>">
                <?php echo (ValidateData('address', 'postalCode'))
                        ? "<span>Enter valid postalCode</span>"
                        : ""?>
            </div>

            <div>

                <input type="checkbox" id="displayinfo">
                <label for="displayinfo">Show Other Information</label>

            </div>
            <br>
            <div id="otherInfo">
                <p>OTHER INFORMATION</p>
                <div>
                    <label for="describeYourself">Describe Yourself</label>
                    <textarea name="other[describeYourself]" id="describeYourself" 
                    cols="30" rows="2"><?= getData('other', 'describeYourself') ?></textarea>
                    <?php echo (ValidateData('other', 'describeYourself'))
                        ? "<span>Enter in describe Yourself</span>"
                        : ""?>
                </div>
                <div>
                    <label for="profileImage">Profile Image :</label>
                    <input type="file" name="other[profileImage]" id="profileImage">
                </div>
                <div>
                    <label for="certificate">Certificate Upload :</label>
                    <input type="file" name="other[certificate]" id="certificate">
                </div>
                <div>
                    <p>How long have you been in business?</p>
                    <?php
                    $busineessYearData = [
                        'UNDER 1 YEAR', '1-2 YEARS', '2-5 YEARS',
                        '5-10 YEARS', 'OVER 10 YEARS'
                    ];
                    ?>
                    <?php foreach ($busineessYearData as $busineessYear) : ?>
                        <?php
                        $checked = (getData('other', 'businessYear') == $busineessYear)
                            ? "checked"
                            : ""; ?>
                        <input type="radio" name="other[businessYear]" value="<?= $busineessYear ?>"
                         <?= $checked ?>>
                        <?= $busineessYear ?>
                        <br>
                    <?php endforeach; ?>
                    <?php echo (ValidateData('other', 'businessYear'))
                        ? "<span>Please select bussness year</span>"
                        : ""?>
                </div>
                <div>
                    <p>Number of unique clients you see each week?</p>
                    <select name="other[numberClient]" id="numberClient">
                        <?php $numberClients = ['Client-Week','1-5', '6-10', '11-15', '15+']; ?>
                        <?php foreach ($numberClients as $numberClient) : ?>
                            <option value="<?= $numberClient ?>"><?= $numberClient ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo (ValidateData('other', 'numberClient'))
                        ? "<span>Please select Client week</span>"
                        : ""?>
                </div>
                <div>
                    <p>How do you like us to get in touch with you?</p>
                    <?php $getInTouchData = ['Post', 'Email', 'SMS', 'Phone']; ?>
                    <?php foreach ($getInTouchData as $getInTouch) : ?>
                        <?php
                        $checked = 
                            (in_array( $getInTouch,getData('other', 'getintouch',[])))
                            ? "checked"
                            : "";
                        ?>

                        <input type="checkbox" name="other[getintouch]['<?= $getInTouch ?>']"
                         value="<?= $getInTouch ?>" <?= $checked ?>><?= $getInTouch ?><br>
                    <?php endforeach; ?>
                    <?php echo (ValidateData('other', 'getintouch'))
                        ? "<span>Please select one checkbox</span>"
                        : ""?>
                </div>
                <div>
                    <label for="hobbies">Hobbies :</label>
                    <select name="other[hobbies][]" multiple>
                        <?php $hobbiesData = ['Listening to Music', 'Art', 'Sports', 'Blogging',                            'Travelling']; ?>
                        <?php foreach ($hobbiesData as $hobbie) : ?>
                            <?php
                            $selected = (in_array($hobbie, getData('other', 'hobbies')))
                                ? "selected='selected'"
                                : ""
                            ?>
                            <option value="<?= $hobbie; ?>" <?= $selected ?>><?= $hobbie; ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo (ValidateData('other', 'getintouch'))
                        ? "<span>Please select one </span>"
                        : ""?>
                </div>
            </div>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>

    <script src="script.js"></script>
</body>

</html>