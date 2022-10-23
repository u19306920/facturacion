<?php
session_start();
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/
if(isset($_POST['Login'])){
  require('config/config.php');
  require('modulos/configuracion/class/usuarios.php');
  $objUsuarios = new Usuarios();
  $login=$objUsuarios->usuarioLogin($_POST['usuario'],$_POST['password']);
/*
  echo "<pre>";
  print_r($login);
  //print_r($_SESSION);
  echo "</pre>";
*/
  if($login[0]['usuario']==$_POST['usuario'] and $login[0]['password']==$_POST['password']){
    //echo "ok<br>";
    $_SESSION["idusuarios"]=$login[0]['idusuarios'];
    $_SESSION["dni"]=$login[0]['dni'];
    $_SESSION["empleado"]=$login[0]['nombres'].' '.$login[0]['apellidos'];
    $_SESSION["token"]=$login[0]['token'];
    $_SESSION["telefono"]=$login[0]['telefono'];
    $_SESSION["idempresas"]=$login[0]['idempresas'];
    $_SESSION["sesion"]=1;
    $_SESSION["url"]=$url;
    $_SESSION["token"]=$login[0]['token'];
	
  	//print_r($_SESSION);
    header('Location: index.php');
  }
  else{
    echo "Usuario o Clave Erronea. Intente otra vez.";
  }
}
elseif(isset($_SESSION['sesion'])){
  header('Location: index.php');
}
else{
?>

<!DOCTYPE html>
<html>
<head>
  <title>::EMPRESA:.</title>
  <link rel="icon" type="image/png" href="views/favicon.png">
  <style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,700);
    @import url(//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css);

    body, html {
      height: 100%;
    }
    body {
      font-family: 'Open Sans';
      font-weight: 100;
      display: flex;
      overflow: hidden;
    }
    input {
      -webkit-input-placeholder {
         color: rgba(255,255,255,0.7);
      }
      -moz-placeholder {
         color: rgba(255,255,255,0.7);  
      }
      -ms-input-placeholder {  
         color: rgba(255,255,255,0.7);  
      }
      &:focus {
        outline: 0 transparent solid;
        -webkit-input-placeholder {
         color: rgba(0,0,0,0.7);
        }
        -moz-placeholder {
           color: rgba(0,0,0,0.7);  
        }
        -ms-input-placeholder {  
           color: rgba(0,0,0,0.7);  
        }
      }
    }

    .login-form {
      background: #111;
      box-shadow: 0 0 1rem rgba(0,0,0,0.3);
      min-height: 10rem;
      margin: auto;
      max-width: 50%;
      padding: .5rem;
      border-radius: 20px;
    }
    .login-text {
      //background: hsl(40,30,60);
      //border-bottom: .5rem solid white;
      color: white;
      font-size: 1.5rem;
      margin: 0 auto;
      max-width: 50%;
      padding: .5rem;
      text-align: center;
      //text-shadow: 1px -1px 0 rgba(0,0,0,0.3);
      
    }
    .fa-stack-1x {
        color: black;
      }

    .login-username, .login-password {
      background: transparent;
      border: 0 solid;
      border-bottom: 1px solid rgba(white, .5);
      color: white;
      display: block;
      margin: 1rem;
      padding: .5rem;
      transition: 250ms background ease-in;
      width: calc(100% - 3rem);
      &:focus {
        background: white;
        color: black;
        transition: 250ms background ease-in;
      }
    }

    .login-forgot-pass {
      //border-bottom: 1px solid white;
      bottom: 0;
      color: white;
      cursor: pointer;
      display: block;
      font-size: 75%;
      left: 0;
      opacity: 0.6;
      padding: .5rem;
      position: absolute;
      text-align: center;
      //text-decoration: none;
      width: 100%;
      &:hover {
        opacity: 1;
      }
    }
    .login-submit {
      border: 1px solid white;
      background: transparent;
      color: white;
      display: block;
      margin: 1rem auto;
      min-width: 1px;
      padding: .25rem;
      transition: 250ms background ease-in;
      &:hover, &:focus {
        background: white;
        color: black;
        transition: 250ms background ease-in;
      }
    }


    [class*=underlay] {
      left: 0;
      min-height: 100%;
      min-width: 100%;
      position: fixed;
      top: 0;
    }
    .underlay-photo {
      animation: hue-rotate 6s infinite;
      background: url('assets/images/fondo02.jpg');
      background-size: cover;
      -webkit-filter: grayscale(30%);
      z-index: -1;
    }
    .underlay-black {
      background: rgba(0,0,0,0.4);
      z-index: -1;
    }

    @keyframes hue-rotate {
      from {
        -webkit-filter: grayscale(30%) hue-rotate(0deg);
      }
      to {
        -webkit-filter: grayscale(30%) hue-rotate(360deg);
      }
    }
  </style>
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico" />
  <script type='text/javascript'>
      santyLibBgAleat=function(){
        this.v="1.0";
        this.imagenes=function(){
          var x=arguments,img=this.a(x);
          this.s(img)};
          this.a=function(r){
            var a=Math.random()*r.length;
            a=Math.floor(a);
            return(r[a])
          };
          this.c=function(b){
            head=document.getElementsByTagName("head")[0];
            if(!head)
              return;
            var s=document.createElement("style");
            s.type='text/css';
            s.innerHTML=b;
            head.appendChild(s)};
            this.s=function(b){
              var o=undefined;
              b.css=(b.css!==o)?b.css:"";
              b.url=(b.url!==o)?b.url:"";
              this.c("body{background:url('"+b.url+"') "+b.css+"; background-position: center; background-repeat: no-repeat;}")
            }
          };
          $santyBA=new santyLibBgAleat();
          $santyBA.imagenes(
            {url:"assets/images/fondo01.jpg"},
            {url:"assets/images/fondo02.jpg"},
            {url:"assets/images/fondo03.jpg"},
            {url:"assets/images/fondo04.jpg"},
            {url:"assets/images/fondo05.jpg"}
    );
    </script>
</head>
<body>
  <form class="login-form" method="POST" action="">
    <p class="login-text">Facturación<br>Electrónica
      <span class="fa-stack fa-lg">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-lock fa-stack-1x"></i>
      </span>
    </p>
    <input type="text" name="usuario" class="login-username" autofocus="true" required="true" placeholder="Usuario" />
    <input type="password" name="password" class="login-password" required="true" placeholder="Contraseña" />
    <input type="submit" name="Login" value="Entrar" class="login-submit" />
  </form>
<a href="#" class="login-forgot-pass">¿Oldivaste tu contraseña?</a>
<div class="underlay-photo"></div>
<div class="underlay-black"></div> 
</body>
</html>
<?php
}
?>