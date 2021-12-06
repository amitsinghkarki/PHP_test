<?php
ob_start();

require_once 'connection.php';

if (isset($_POST['save'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $state = $_POST['state'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $categories = $_POST['category'];
    $rating_error = false;
    for ($i = 0; $i < count($categories); $i++) {
        if ($categories[$i] != 0) {
            $rating[$i] = $_POST["rating_" . ($i + 1) . ""];
            if ($rating[$i] == 0) {
                $rating_error = true;
            }
        }
    }
    $existing_email=getUserByEmail($conn,$email);
    $email_count=mysqli_num_rows($existing_email);
    if ($email_count>0) {
        $error_message = "Error: Email Already Exist.";
    }else if ($first_name == '') {
        $error_message = "Error: Please Enter the First Name";
    } else if ($last_name == '') {
        $error_message = "Error: Please Enter the Last Name";
    } else if ($street == '') {
        $error_message = "Error: Please Enter the street";
    } else if ($city == '') {
        $error_message = "Error: Please Enter the city";
    } else if ($zip == '') {
        $error_message = "Error: Please Enter the zip";
    } else if ($state == '') {
        $error_message = "Error: Please Enter the state";
    } else if ($phone == "" && !ctype_digit($phone) && $phone < 10) {
        $error_message = "Error: Please Enter the phone Numbers";
    } else if ($email == '') {
        $error_message = "Error: Please Enter the email";
    } else if (array_sum($categories) == 0) {
        $error_message = "Error: Please Select at Least 1 Category";
    } else if ($rating_error) {
        $error_message = 'Error: Please Select rating for selected Categories';
    } else {
        $prepared = $conn->prepare("INSERT INTO `user_data` ( `first_name` , `last_name` ,`street` , `city` ,`zip` , `state` ,`phone` , `email`  ) VALUES ( ? , ? , ? , ? , ? , ? ,? , ?  ) ; ");

        $result = $prepared->bind_param("ssssssss", $first_name, $last_name, $street, $city, $zip, $state, $phone, $email);

        $result = $prepared->execute();
        if ($result == false) {
            die("An Error occurred While Saving data");
        }
        $user_id = mysqli_insert_id($conn);

        $prepared->close();

        //Insert Skills for users
        for ($i = 0; $i < count($categories); $i++) {
            if ($categories[$i] != 0) {
                $category = $categories[$i];
                $user_skill = $conn->prepare("INSERT INTO `user_skills` ( `user_id` , `skill_id` ,`rating` ) VALUES ( ? , ? , ?) ; ");

                $result = $user_skill->bind_param("sss", $user_id, $category, $_POST["rating_" . ($i + 1) . ""]);
                // echo '<pre>';
                // print_r($category);
                // echo '</pre>';
                // die();
                $result = $user_skill->execute();
                if ($result == false) {
                    die("An Error occurred While Saving data");
                }

                $user_skill->close();

            }
        }


        require_once "Mail.php";
           $keyid=encode5t($cand_rollno);
           $from = "Dummy <dummy@test.in>";
           $to =$email;
           $subject = "Form Submit Confirmation";
           $body .= "Dear ".$firstname.",\n\n";
           $body .= "Your Form submission has been received \n\n";
       
    
            $username = "dummy";
            $password = "dummypass";
 
                $host = "dummyrealy.test.in";   
                $port=25;
                $headers = array ('From' => $from,'To' => $to,'Subject' => $subject);
             
                $smtp = Mail::factory('smtp',array ('host' => $host,'port' => $port,'auth' => false));
                $mail = $smtp->send($to, $headers, $body);
            if (PEAR::isError($mail)){
              echo("<p>" . $mail->getMessage() . "</p>");
            }
            else{
           $sucess_message='Data Saved Sucessfully. A confirmation mail has been sent to email address <font color=#0000999>'.$email.'</font>. ';
            }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>

    <title>User</title>
</head>
<body class="bg-purple-200">

<?php if(isset($error_message))
{
    ?>
    <div role="alert">
  <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
  <p><?=$error_message?></p>
  </div>
 
</div>
<?}?>

<?php if(isset($sucess_message))
{
    ?>
    <div role="alert">
  <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2">
    Success :   <p><?=$sucess_message?></p>

  </div>

</div>
<?}?>
<div class="flex justify-center items-center h-screen w-full bg-blue-400">
    <div class="w-1/2 bg-white rounded shadow-2xl p-8 m-8">
        <h1 class="block w-full text-center text-gray-800 text-2xl font-bold mb-6">User Section</h1>
        <form name='userForm' id='userForm' action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return validateForm()"  method="post">


        <div class="flex flex-col md:flex-row">
                <div class="w-full mx-2 flex-1">
                    <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase"> First Name</div>
                    <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
                        <input placeholder="first name" required class="p-1 px-2  outline-none w-full  text-gray-800 focus:ring focus:border-blue-700" type="text" name="first_name" id="first_name"> </div>
                </div>
                <div class="w-full mx-2 flex-1">
                    <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase"> Last Name</div>
                    <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
                        <input placeholder="last name" required class="p-1 px-2  outline-none w-full  text-gray-800 focus:ring focus:border-blue-700" type="text" name="last_name" id="last_name"> </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row">
                <div class="w-full mx-2 flex-1">
                    <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase"> street</div>
                    <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
                        <input placeholder="street name" required class="p-1 px-2  outline-none w-full  text-gray-800 focus:ring focus:border-blue-700" type="text" name="street" id="street"> </div>
                </div>
                <div class="w-full mx-2 flex-1">
                    <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase"> City</div>
                    <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
                        <input placeholder="City name" required class="p-1 px-2  outline-none w-full  text-gray-800 focus:ring focus:border-blue-700" type="text" name="city" id="city"> </div>
                </div>
            </div><div class="flex flex-col md:flex-row">
                <div class="w-full mx-2 flex-1">
                    <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase"> Zip</div>
                    <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
                        <input placeholder="zip code" maxlength="6" required class="p-1 px-2  outline-none w-full  text-gray-800 focus:ring focus:border-blue-700" type="text" name="zip" id="zip"> </div>
                </div>
                <div class="w-full mx-2 flex-1">
                    <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase"> state</div>
                    <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
                        <input placeholder="state name"  required class="p-1 px-2  outline-none w-full  text-gray-800 focus:ring focus:border-blue-700" type="text" name="state" id="state"> </div>
                </div>
            </div><div class="flex flex-col md:flex-row">
                <div class="w-full mx-2 flex-1">
                    <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase"> phone</div>
                    <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
                        <input placeholder="phone number" maxlength="12" required class="p-1 px-2  outline-none w-full  text-gray-800 focus:ring focus:border-blue-700" type="text" name="phone" id="phone"> </div>
                </div>
                <div class="w-full mx-2 flex-1">
                    <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase"> E-mail</div>
                    <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
                        <input placeholder="E-mail id" required class="p-1 px-2  outline-none w-full  text-gray-800 focus:ring focus:border-blue-700" type="text" name="email" id="email" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}"> </div>
                </div>
            </div>
            <h1 class="block w-full text-center text-gray-800 text-2xl font-bold m-6">User Skills</h1>


            <?php
$categories = getCategories($conn);
while ($category = mysqli_fetch_array($categories)) {

    ?>
                    <div class="flex flex-col md:flex-row">
                    <div class="w-full mx-2 flex-1">
                        <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase"> <?=$category["category_name"]?></div>
                        <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
                            <select class="p-1 px-2  outline-none w-full  text-gray-800 focus:ring focus:border-blue-700"  name="category[]" id="<?=$category["id"]?>">
                            <option   value="0">
                            Please choose  </option>

<?php
$skills = getSkills($conn, $category["id"]);
    while ($skill = mysqli_fetch_array($skills)) {
        ?>


                            <option   value="<?=$skill["skill_id"]?>">
                            <?=$skill["skill_name"]?>
    </option>

        <?php }?>
    </select>
                    </div>
                    </div>
                    <div class="w-full mx-2 flex-1">
                        <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase"> Rating</div>
                        <div class="bg-white my-2 p-1 outline-none flex border border-gray-200 rounded">

                        <select class="p-1 px-2  w-full outline-none w-full text-gray-800 focus:ring focus:border-blue-700" name="rating_<?=$category["id"]?>" id="rating_<?=$category["id"]?>">
                        <option   value="0" default>Please choose rating</option>
                        <option   value="1" >1</option>

                        <option   value="2" >2</option>
                        <option   value="3" >3</option>
                        <option   value="4" >4</option>
                        <option   value="5" >5</option>

    </select>
                             </div>
                    </div>
                </div>

                <?php

}

?>






            <button class="block bg-blue-400 hover:bg-blue-600 text-white uppercase text-lg mx-auto p-4 rounded m-6" type="submit" name="save" id="save" value="Save">Submit Response</button>




        </form>
    </div>
</div>

</body>
</html>


<script >


    $('#zip').keypress(function(e) {
      var letters=/^[0-9]/g; //g means global
      if(!(e.key).match(letters)) e.preventDefault();
    });

    $('#mobile').keypress(function(e) {
      var letters=/^[0-9]/g; //g means global
      if(!(e.key).match(letters)) e.preventDefault();
    });



function validateForm() {
  let zip = document.forms["userForm"]["zip"].value;
  if (zip.length <6) {
    alert("Zip code need to be 6 digits");
    return false;
  }

  let phone = document.forms["userForm"]["phone"].value;
  if (phone.length <10) {
    alert("Phone number need to be at least 10 digits");
    return false;
  }

  let category_flag=false;
  let categories = document.getElementsByName('category[]');
  for (var i = 0; i <categories.length; i++) {
    var category=categories[i];
    if(category.value!=0)
    {   category_flag=true;
        let category_rating = document.getElementById("rating_"+category.id);
        if(category_rating.value==0)
        {
        alert("Rating need to be filled for selected skill");
        category_rating.focus();
        return false;
        }
    }
}
if(category_flag==false)
{
    alert("Need to select at least one skill");
    return false;
}
return true;
}
</script>
