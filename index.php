<?php
require 'logic.php';

?>


<!DOCTYPE html>
<html lang='en'>
<head>

    <title>Name Generator</title>
    <meta charset='utf-8'>

    <link href='/css/app.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
<script>
$(document).ready(function(){
    $(".dropdown-menu li a").click(function(){
    $("#options").text($(this).text());
    });
});
</script>
</head>
<body class="text-center">


<section id='main'>
    <h1>Name Generator</h1>

    <p >Name Generator will generate an English name for you based on your personality, birthday and sex.</p>

    <form method='GET' action='search.php'>
        <fieldset>
        <!-- Birthdate -->
            <span>Enter your birth year:</span> <label><input type=text name='bday' value='<?= $bday??''?>' ></label><br>
        <!-- Personality -->
            <span>Personality </span>
            <select name="personality" single> 
                <option value=1 <?php if($personality=="1") { echo "selected"; } ?>>ambitious</option>
                <option value=2 <?php if($personality=="2") { echo "selected"; } ?>>compassionate</option>
                <option value=3 <?php if($personality=="3") { echo "selected"; } ?>>diligent</option>
                <option value=4 <?php if($personality=="4") { echo "selected"; } ?>>persistent</option>
                <option value=5 <?php if($personality=="5") { echo "selected"; } ?>>unassuming</option>
                <option value=6 <?php if($personality=="6") { echo "selected"; } ?>>reliable</option>
            </select><br>
        <!-- Sex -->
            <span>Sex:</span>
            <label class="radio-inline"><input type='radio'name='sex' value ="male" <?php if($sex=="male") { echo "checked"; } ?>> male</label>
            <label class="radio-inline"><input type='radio'name='sex' value ="female"<?php if($sex=="female") { echo "checked"; } ?>> female</label>
        </fieldset>
        <!-- Submit Button -->
        <input type='submit' value='Generate' class='btn btn-primary'>


        <?php if ($hasErrors): ?>
            <div class='errors alert alert-danger'>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif ?>
    </form>


    <div id='results'>
     <!-- if no errors, show results -->
        <?php if (!$hasErrors): ?>
            <div id='results'>
                    <?php if (!empty($bday) and !empty($sex) and !empty(personality)): ?>
                        <div class='alert alert-primary' role='alert'>
                            Your birthday is in year <em><?= $bday ?></em><br>
                            You are a <em><?= $sex?></em><br>
                            Thus, here are our suggestions for your English Name: 
                        </div>
                    <?php endif; ?>
            </div>
        <?php endif; ?>

     <!-- If there are no suggested name in the database, show the message -->
        <?php if (isset($nameCount) and $nameCount == 0): ?>
                <div class='alert alert-warning' role='alert'>
                    We will expand our database later!
                </div>
        <?php endif; ?>


     <!-- show result -->
        <div class="row">
            <div class="mx-auto">
                <?php if (isset($names)): ?>
                    <ul class='nameslist'>
                        <?php foreach ($names as $name): ?>
                            <li class='namelist'>
                                <div><?= $name?></div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>
        </div>
    
</section>

<footer>
</footer>

</body>
</html>

