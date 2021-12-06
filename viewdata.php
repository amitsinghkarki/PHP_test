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

        <div class=" divide-y ">
       <?php $users = getUsersData($conn);
while ($user = mysqli_fetch_array($users)) {
    ?>
                        <div class="flex flex-col md:flex-row  divide-y ">

                <div class="w-full my-2">
                    <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase"> <span> <?=$user["first_name"] . ' ' . $user["last_name"]?> </span> <a href='userdata.php?user_id=<?=$user["user_id"]?>'class="float-right mx-0 bg-blue-400 hover:bg-blue-600 text-white uppercase text-lg  p-2 rounded " type="submit" name="save" id="save" value="Save">View Data</a></div>


                </div>
                </div>


        <?php }?>
</div>

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





            <button class="block bg-blue-400 hover:bg-blue-600 text-white uppercase text-lg mx-auto p-4 rounded m-6" type="submit" name="save" id="save" value="Save">Submit Response</button>




        </form>
    </div>
</div>

</body>
</html>

