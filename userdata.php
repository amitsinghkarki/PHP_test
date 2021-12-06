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

    <title>View Users</title>
</head>
<body class="bg-purple-200">
<div class="flex justify-center items-center h-screen w-full bg-blue-400">
    <div class="w-1/2 bg-white rounded shadow-2xl p-8 m-8">
        <h1 class="block w-full text-center text-gray-800 text-2xl font-bold mb-6">Submitted Data</h1>

       <?php $users = getUserById($conn, $_GET['user_id']);
while ($user = mysqli_fetch_array($users)) {
    ?>
                        <div class="flex flex-col md:flex-row  divide-y ">

                <div class="w-full my-2">
                    <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase"> <span> Name : <?=$user["first_name"] . ' ' . $user["last_name"]?> </span> </div>


                </div>
                </div>
                <div class="w-full my-2">
                    <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase"> <span> Address : <?=$user["street"] . ', ' . $user["city"] . ', ' . $user["state"] . '-' . $user["zip"]?> </span> </div>


                </div>
                </div>









        <?php }?>







    </div>
</div>

</body>
</html>

