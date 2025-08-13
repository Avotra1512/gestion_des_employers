<!DOCTYPE html>
<html lang="en">
<head>

    <title>Gestion Employers</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- FontAwesome JS-->
    <script defer src="{{asset('assets/plugins/fontawesome/js/all.min.js')}}"></script>



    <style media="screen">
body{
    background-image: url(assets/images/login.jpg);
    background-size: cover; /* L'image couvre toute la surface */
    background-repeat: no-repeat; /* Empêcher la répétition de l'image */
}
.wrapper{

}
form{
    height: 270px;
    width: 280px;
    background-color: transparent;
    border: 2px solid #222;
    backdrop-filter: blur(20px);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    border-radius: 10px;
    padding: 50px 35px;
    margin-left: 35%;
    margin-top: 70px;

}
form h3{
    font-size: 25px;
    text-align: center;
    margin-top: -10px;
    margin-bottom: -20px;
    color: #222;
}
form .input-box{
    width: 100%;
    height: 30px;
    margin: 30px 0;
    position: relative;
}
.input-box input{
    width: 80%;
    height: 5%;
    margin-top: 30px;
    background: none;
    outline: none;
    border: none;
    border: 5px solid rgba(255,255,255,.2);
    border-radius: 40px;
    font-size: 16px;
    color: none;
    padding: 20px 45px 20px 20px;

}
.input-box input::placeholder{
    color: #222;
}
.input-box .icon {
    position: absolute;
    right: 5px;
    top: 180%;
    transform: translateY(-50%);
    font-size: 20px;
    color: black;
}
.input-box .ycon {
    position: absolute;
    right: 5px;
    top: 450%;
    transform: translateY(-50%);
    font-size: 20px;
    color: black;
}
button{
    width: 100%;
    height: 45px;
    margin-top: 150px;
    background: #B6DBDF;
    color: #333;
    border: none;
    outline: none;
    font-size: 16px;
    font-weight: 600;
    border-radius: 40px;
    cursor: pointer;
    font-weight: 600;
    box-shadow: 0 0 10px rgba(0,0,0,.1);

}

    </style>
</head>
<body>

    <form method="post" action ="{{route('handleLogin')}}">

        @csrf
        @method('POST')

    <div class="wrapper">
        <h3>Espace de Connexion</h3>


        <div class="input-box">
        @if (Session::get('success_message'))
            <center><b style="font-size:15px; color:#2F7693;">{{ Session::get('success_message') }}</b></center>
        @endif
        @if (Session::get('error_msg'))
            <center><b style="font-size:15px; color:rgb(185, 81, 81);">{{ Session::get('error_msg') }}</b></center>
        @endif

    <!--{{ Hash::make('azerty') }}-->
            <input  type="email" name="email" class="email" placeholder="Email" required>
            <span class="icon"><i class='fa fa-user'></i></span>

            <input type="password" name="password" class="password" placeholder="Password" required>
            <span class="ycon"><i class='fa fa-lock'></i></span>
        </div>
        <button type="submit" class="">Connexion</button>
    </div>
    </form>

    <!-- Javascript -->
    <script src="{{asset('assets/plugins/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

</body>
</html>
