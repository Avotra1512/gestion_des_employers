<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Employers</title>
    <!-- FontAwesome JS-->
    <script defer src="{{asset('assets/plugins/fontawesome/js/all.min.js')}}"></script>
      


    <style media="screen">
body{
    background-image: url('{{ asset('assets/images/login.jpg') }}');
    background-size: cover; /* L'image couvre toute la surface */
    background-position: center; /* Centrer l'image */
    background-repeat: no-repeat; /* Empêcher la répétition de l'image */
}
label{
    color: black;
    
}
form{
    height: 475px;
    width: 300px;
    background-color: transparent;
    border: 2px solid #222;
    backdrop-filter: blur(20px);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    color: #fff;
    border-radius: 10px;
    padding: 50px 35px;
    margin-left: 35%;
    margin-top: 30px;
    
}
form h3{
    font-size: 25px;
    text-align: center;
    margin-top: -10px;
    margin-bottom: -10px;
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
    height: 2%;
    margin-top: 20px;
    margin-bottom: 20px;
    background: none;
    outline: none;
    border: none;
    border: 5px solid rgba(255,255,255,.2);
    border-radius: 10px;
    font-size: 16px;
    color: none;
    padding: 10px 45px 10px 10px;
    
}
.input-box input::placeholder{
    color: #222;
}
.input-box .icon {
    position: absolute;
    right: 15px;
    top: 200%;
    transform: translateY(-50%);
    font-size: 20px;
    color: black;
}
.input-box .ycon {
    position: absolute;
    right: 15px;
    top: 550%;
    transform: translateY(-50%);
    font-size: 20px;
    color: black;
}
.input-box .mdp {
    position: absolute;
    right: 15px;
    top: 900%;
    transform: translateY(-50%);
    font-size: 20px;
    color: black;
}
.input-box .cmdp {
    position: absolute;
    right: 15px;
    top: 1250%;
    transform: translateY(-50%);
    font-size: 20px;
    color: black;
}
button{
    width: 100%;
    height: 45px;
    margin-top: 370px;
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
    
    <form method="post" action ="{{route('submiteDefineAccess', $email)}}">

        @csrf 
        @method('POST')

    <div class="wrapper">
        <h3>Définissez vos accès</h3>
        

        <div class="input-box">
        @if (Session::get('error_msg'))
            <center><b style="font-size:15px; color:rgb(185, 81, 81);">{{ Session::get('error_msg') }}</b></center><br>
        @endif

        <div class="forme-groupe">
            <label for="">Email:</label><br>
            <input  type="email" name="email" class="email" placeholder="Email" value="{{ $email }}" readonly>
            <span class="icon"><i class='fa fa-user'></i></span>
        </div>
        <div class="forme-groupe">
            <label for="">Code:</label><br>
            <input  type="text" name="code" class="code" placeholder="Code à 4chiffre" value="{{ old('code') }}">
            <span class="ycon"><i class='fa fa-unlock-alt'></i></span>
         @error('code')
            <span class="text-danger" style="font-size:15px; color:rgb(185, 81, 81);">{{ $message }}</span><br><br>
        @enderror
        </div>
        <div class="forme-groupe">
            <label for="">Mot de passe: </label><br>
            <input type="password" name="password" class="password" placeholder="Password">
            <span class="mdp"><i class='fa fa-lock'></i></span>
        @error('password')
            <span class="text-danger" style="font-size:15px; color:rgb(185, 81, 81);">{{ $message }}</span><br><br>
        @enderror
        </div>
        <div class="forme-groupe">
            <label for="">Mot de passe de confirmation:</label> <br>
            <input type="password" name="confirm_password" class="confirm_password" placeholder="Confirmer Password">
            <span class="cmdp"><i class='fa fa-lock'></i></span>

        </div>
            
            
        </div>
        <button type="submit" class="">Enregistrer</button>
    </div>    
    </form>

     <!-- Javascript -->          
     <script src="{{asset('assets/plugins/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>  
    
</body>
</html> 