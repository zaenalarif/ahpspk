<?php
include('config.php');

function login($nama, $pass){
	require('config.php');

    $query2          = "SELECT nama FROM user WHERE nama='$nama'";
    $query          = "SELECT password FROM user WHERE nama='$nama'";
    $result         = mysqli_query($koneksi,$query);
    $password       = mysqli_fetch_assoc($result)['password'];
    $result2        = mysqli_query($koneksi,$query2);
    $nama2          = mysqli_fetch_assoc($result2)['nama'];
    
	if($nama === $nama2 && $pass === $password){
		return true;
	}else{
        return false;
    }
}
session_start();
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(!empty($username) && !empty($password)){
        if(login($username, $password)){
            $_SESSION['username'] = $username;
            header('Location: index.php');
        }else{
            die('nama asalah');
        }
    }else{
        echo 'inputan kosong';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/bulma.min.css">
    <title>Login</title>
</head>
<body>
    
    <section class="section">
        <div class="columns is-centered">
            <div class="column is-6 ">
                <div class="box">
                    <h1 class="title "> Login </h1>
                    <form action="" method="post">
                        <div class="field">
                            <label class="label">Username</label>
                            <div class="control">
                                <input class="input" type="text" placeholder="username...." name="username">
                            </div>
                            </div>

                            <div class="field">
                            <label class="label">Password</label>
                            <div class="control">
                                <input class="input" type="password" placeholder="" name="password">
                            </div>
                            <br>
                            <div class="field">
                                <button type="submit" class="button is-success" name="submit">Login</button>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>

