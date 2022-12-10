		<div class="dt-login--container dt-forgot-password">

			<!-- Login Content -->
			<div class="dt-login__content-wrapper">
		
				<!-- Login Content Inner -->
				<div class="dt-login__content-inner">

				  <!-- Brand logo -->
				  <span class="dt-login__logo">

					</span>
				  <!-- /brand logo -->
				  
				  <h2 class="mb-2">Cambiar contraseña</h2>
				  <p class="mb-5">Ingrese una nueva contraseña para su cuenta</p>
				<script type="text/javascript">

				  document.addEventListener("DOMContentLoaded", function() {

				    // JavaScript form validation

				    var checkPassword = function(str)
				    {
				      var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
				      return re.test(str);
				    };

				    var checkForm = function(e)
				    {
				      if(this.username.value == "") {
				        alert("Error: Username cannot be blank!");
				        this.username.focus();
				        e.preventDefault(); // equivalent to return false
				        return;
				      }
				      re = /^\w+$/;
				      if(!re.test(this.username.value)) {
				        alert("Error: Username must contain only letters, numbers and underscores!");
				        this.username.focus();
				        e.preventDefault();
				        return;
				      }
				      if(this.pwd1.value != "" && this.pwd1.value == this.pwd2.value) {
				        if(!checkPassword(this.pwd1.value)) {
				          alert("The password you have entered is not valid!");
				          this.pwd1.focus();
				          e.preventDefault();
				          return;
				        }
				      } else {
				        alert("Error: Please check that you've entered and confirmed your password!");
				        this.pwd1.focus();
				        e.preventDefault();
				        return;
				      }
				      alert("Both username and password are VALID!");
				    };

				    var myForm = document.getElementById("myForm");
				    myForm.addEventListener("submit", checkForm, true);

				    // HTML5 form validation

				    var supports_input_validity = function()
				    {
				      var i = document.createElement("input");
				      return "setCustomValidity" in i;
				    }

				    if(supports_input_validity()) {
				      var usernameInput = document.getElementById("field_username");
				      usernameInput.setCustomValidity(usernameInput.title);

				      var pwd1Input = document.getElementById("field_pwd1");
				      pwd1Input.setCustomValidity(pwd1Input.title);

				      var pwd2Input = document.getElementById("field_pwd2");

				      // input key handlers

				      usernameInput.addEventListener("keyup", function(e) {
				        usernameInput.setCustomValidity(this.validity.patternMismatch ? usernameInput.title : "");
				      }, false);

				      pwd1Input.addEventListener("keyup", function(e) {
				        this.setCustomValidity(this.validity.patternMismatch ? pwd1Input.title : "");
				        if(this.checkValidity()) {
				          pwd2Input.pattern = RegExp.escape(this.value);
				          pwd2Input.setCustomValidity(pwd2Input.title);
				        } else {
				          pwd2Input.pattern = this.pattern;
				          pwd2Input.setCustomValidity("");
				        }
				      }, false);

				      pwd2Input.addEventListener("keyup", function(e) {
				        this.setCustomValidity(this.validity.patternMismatch ? pwd2Input.title : "");
				      }, false);

				    }

				  }, false);

				</script>
				  <!-- Form -->
				  <form id="myForm" name="form" method="POST" action="modulos/configuracion/cambiar_guardar.php" onsubmit="checkForm(this); return false;">
		
					<!-- Form Group -->
					<div class="form-group">
					  <label class="sr-only" for="password-0">Contraseña actual</label>
					  <input type="password" name="pwa" class="form-control" id="field_username" placeholder="Contraseña actual">
					</div>
					<!-- /form group -->

					<!-- Form Group -->
					<div class="form-group">
					  <label class="sr-only" for="password-1">Nueva contraseña</label>
					  <input type="password" name="pwd1" class="form-control" id="field_pwd1" aria-describedby="password-1" placeholder="Nueva contraseña" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
					</div>
					<!-- /form group -->
					
					<!-- Form Group -->
					<div class="form-group">
					  <label class="sr-only" for="password-2">Reingrese la nueva contraseña</label>
					  <input type="password" name="pwd2" class="form-control" id="field_pwd2" aria-describedby="password-2" placeholder="Reingrese nueva contraseña" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
					</div>
					<!-- /form group -->
					<div id="pswd_info">
					  <h4>La contraseña debe cumplir los siguientes requerimientos:</h4>
					  <ul>
					    <li id="letter" class="invalid">Al menos <strong>una letra</strong></li>
					    <li id="capital" class="invalid">Al menos <strong>una letra mayúscula</strong></li>
					    <li id="number" class="invalid">Al menos <strong>un número</strong></li>
					    <li id="length" class="invalid">Al menos <strong>8 carácteres</strong></li>
					    <li id="null" class="invalid">Debe <strong>confirmar la contraseña</strong></li>
					    <li id="match" class="invalid">Las contraseñas <strong>deben cohincidir</strong></li>
					    <li id="blank" class="invalid">Las contraseñas <strong>no deben tener espacios</strong></li>
					  </ul>
					</div>
					<!-- Form Group -->
					<div class="form-group">
					  <input type="submit" name="">
					</div>
					<!-- /form group -->
		
				  </form>
				  <!-- /form -->
		
				</div>
				<!-- /login content inner -->
		
			</div>
			<!-- /login content -->
			
		
		</div>