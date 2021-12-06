<?php
require_once 'connection.php';
require_once 'validateuser.php';
echo '<a class="float-right mx-0 bg-red-400 hover:bg-red-600 text-white uppercase" href="adminlogin.php"> Logout </a>';

if (!isset($_GET['user_id'])) {
    header("Location: viewdata.php");

} else {

    $users = getUserById($conn, $_GET['user_id']);
    $user = mysqli_fetch_array($users);
    $user_skills = getSkillsOfUser($conn, $_GET['user_id']);
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>

    <title>View Users</title>
</head>
<body class="bg-purple-200">
<div class="flex justify-center items-center h-screen w-full bg-blue-400">
    <div class="w-1/2 bg-white rounded shadow-2xl p-8 m-8">
        <h1 class="block w-full text-center text-gray-800 text-2xl font-bold mb-6">Submitted Data for <?=$user["first_name"] . ' ' . $user["last_name"]?></h1>


                        <div class="grid grid-cols-5 gap-3">
                        <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase col-span-2">  Name   </div>
                        <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase col-span-3"> <?=$user["first_name"] . ' ' . $user["last_name"]?>  </div>



                </div>
                <div class="grid grid-cols-5 gap-3">
                        <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase col-span-2"> Address  </div>
                        <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase col-span-3"> <?=$user["street"] . ', ' . $user["city"] . ', ' . $user["state"] . '-' . $user["zip"]?>  </div>


                </div>

                <div class="grid grid-cols-5 gap-3">
                        <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase col-span-2"> Mobile  </div> <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase col-span-3"> <?=$user["phone"]?>


                </div>
                </div>

                <div class="grid grid-cols-5 gap-3">
                        <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase col-span-2"> E-Mail  </div> <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase col-span-3"> <?=$user["email"]?>

                </div>
                </div>

      <?php
while ($skills = mysqli_fetch_array($user_skills)) {
        ?>

                        <div class="grid grid-cols-5 gap-3">
                    <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase col-span-2">  <?=$skills["category_name"]?> </div>

                    <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase col-span-1">

                    <?=$skills["skill_name"]?>
</div>
<div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase col-span-2">
                        <?php for ($i = 1; $i <= $skills["rating"]; $i++) {
            echo ' ★ ';
        }
        for ($i = 1; $i <= (5 - $skills["rating"]); $i++) {
            echo ' ☆ ';
        }
        ?>






                </div>
                </div>




        <?php }?>

        <ul class="flex justify-center">
  <li>
    <i class="fas fa-star fa-sm text-yellow-500 mr-1"></i>
  </li>
  <li>
    <i class="fas fa-star fa-sm text-yellow-500 mr-1"></i>
  </li>
  <li>
    <i class="fas fa-star fa-sm text-yellow-500 mr-1"></i>
  </li>
  <li>
    <i class="far fa-star fa-sm text-yellow-500 mr-1"></i>
  </li>
  <li>
    <i class="far fa-star fa-sm text-yellow-500 mr-1"></i>
  </li>
</ul>

                </div>
















    </div>
</div>

</body>
</html>

<?php }