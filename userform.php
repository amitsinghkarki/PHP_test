<?php
require_once 'connection.php';
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
<div class="flex justify-center items-center h-screen w-full bg-blue-400">
    <div class="w-1/2 bg-white rounded shadow-2xl p-8 m-8">
        <h1 class="block w-full text-center text-gray-800 text-2xl font-bold mb-6">User Section</h1>
        <form name='userform' id='userform' action="submitform.php" onsubmit="return validateForm()"  method="post">


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


            <?php
$categoryies = getCategories($conn);
while ($category = mysqli_fetch_array($categoryies)) {

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
                        <div class="bg-white my-2 p-1 outline-noneflex border border-gray-200 rounded">

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






            <button class="block bg-blue-400 hover:bg-blue-600 text-white uppercase text-lg mx-auto p-4 rounded" type="submit">Submit Response</button>




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

    $('#onlyalpha').keypress(function(e) {
      var letters=/^[a-z]/gi; //i means ignorecase
      if(!(e.key).match(letters)) e.preventDefault();
    });

    $('#speclchar').keypress(function(e) {
      var letters=/^[0-9a-z]/gi;
      if((e.key).match(letters)) e.preventDefault();
    });

function validateForm() {
  let zip = document.forms["userform"]["zip"].value;
  if (zip.length <6) {
    alert("Zip code need to be 6 digits");
    return false;
  }

  let phone = document.forms["userform"]["phone"].value;
  if (phone.length <10) {
    alert("Phone number need to be at least 10 digits");
    return false;
  }


  let categories = document.getElementsByName('category[]');
  for (var i = 0; i <categories.length; i++) {
    var category=categories[i];
    if(category.value!=0)
    {
        let category_rating = document.getElementById("rating_"+category.id);
        if(category_rating.value==0)
        {
        alert("Rating need to be filled for selected skill");
        category_rating.classList.add("border-red-700");
        category_rating.focus();
        return false;
        }
    }
}
return true;
}
</script>
