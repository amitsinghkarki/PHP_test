<?php
ob_start();
require_once 'connection.php';
unset($_SESSION['login']);

if (isset($_POST['login'])) {

     $username = $_POST['username'];
     $password = $_POST['password'];
   
     if ($username == '') {
        $error_message = "Error: Please Enter the username";
    } else if ($password == '') {
        $error_message = "Error: Please Enter the password";
    } else {
            if(loginAdmin($conn,$username,$password))
        {   $_SESSION['login']='admin';
            header("Location: viewdata.php");

        }

      $error_message='Error : Username or Password incorrect';

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
        <h1 class="block w-full text-center text-gray-800 text-2xl font-bold mb-6">Admin Login</h1>
        <form name='login' id='login' action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return validateForm()"  method="post">


        <div class="flex flex-col md:flex-row">
                <div class="w-full mx-2 flex-1">
                    <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase"> User Name</div>
                    <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
                        <input placeholder="username" required class="p-1 px-2  outline-none w-full  text-gray-800 focus:ring focus:border-blue-700" type="text" name="username" id="username"> </div>
                </div>
                
            </div>

            
        <div class="flex flex-col md:flex-row">
                <div class="w-full mx-2 flex-1">
                    <div class="font-bold font-bold text-lg text-gray-900 leading-8 uppercase"> Password</div>
                    <div class="bg-white my-2 p-1 flex border border-gray-200 rounded">
                        <input placeholder="password"  required class="p-1 px-2  outline-none w-full  text-gray-800 focus:ring focus:border-blue-700" type="password" name="password" id="password"> </div>
                </div>
                
            </div>

          



            <button class="block bg-blue-400 hover:bg-blue-600 text-white uppercase text-lg mx-auto p-4 rounded m-6" type="submit" name="login" id="login" value="login">Login</button>




        </form>
    </div>
</div>

</body>
</html>


<script >



function validateForm() {
 

  let username = document.forms["login"]["username"].value;
  if (username=='') {
    alert("Username can't be empty");
    return false;
  }

  let password = document.forms["login"]["password"].value;
  if (password=='') {
    alert("Password can't be empty");
    return false;
  }

return true;
}
</script>
