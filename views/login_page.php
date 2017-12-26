<h1 class="text-left pb-3 pt-3">Página de Login</h1>
<div class="container">
	<div class="row">		
		<div class="col-md-6"><!-- FORM SINGIN -->	

		  <div class="alert alert-warning alert-dismissable" ng-hide="userDialog.passwordMatch">
		    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong>Senhas não combinam!</strong> As duas senhas digitadas não combinam, digite novamente.
		  </div>

		  <div class="alert alert-warning alert-dismissable" ng-hide="userDialog.userNotMatch">
		    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong>Usuário já existe!</strong> Tente com outro nome.
		  </div>

		  <div class="alert alert-success alert-dismissable" ng-hide="userDialog.userRegistred">
		    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong>Usuário registrado!</strong> Tente efetuar Login.
		  </div>

			<form class="form-horizontal" id="form-singin" ng-submit="singinCheck()">
				<label for="form"><strong>REGISTRAR: </strong></label>

			<!-- USER INPUT-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="userSingin.username">Usuário: </label>  
			  <div class="col-md-7">
			  <input id="userSingin.username" ng-model="userSingin.username" type="text" placeholder="Digite nome de usuário" class="form-control input-md" required="" maxlength="30">			  
			  <small class="form-text text-muted">Ex.: lucas_silva, araujo_lima, pedro354</small>
			  </div>

			</div>

			<!-- PASSWORD INPUT-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="userSingin.password">Senha: </label>
			  <div class="col-md-7">
			    <input id="userSingin.password" ng-model="userSingin.password" type="password" placeholder="Digite a senha" class="form-control input-md" required="" maxlength="16">			    
			  </div>
			</div>

			<!-- PASSWORD CHECK INPUT-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="userSingin.password2">Confirmar Senha: </label>
			  <div class="col-md-7">
			    <input id="userSingin.password2" ng-model="userSingin.password2" type="password" placeholder="Confirme senha" class="form-control input-md" required="" maxlength="16">			    
			  </div>
			</div>

			<!-- BOTÃO FORM FORM-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="btn_form"></label>
			  <div class="col-md-4">	
			  	<button id="btn_register" name="btn_register" class="btn btn-primary" type="submit">Cadastrar</button>			  	
			  </div>
			</div>	

			</fieldset>
			</form>
		</div>

		<div class="col-md-6" style="border-left: groove"><!-- FORM LOGIN -->			
			<form class="form-horizontal" id="form-login" ng-submit="loginCheck()">

			<label for="form"><strong>ENTRAR: </strong></label>
			<!-- USER INPUT-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="userLogin.username">Usuário: </label>  
			  <div class="col-md-7">
			  <input id="userLogin.username" ng-model="userLogin.username" type="text" placeholder="Digite nome de usuário" class="form-control input-md" required="" maxlength="30">			  
			  <small class="form-text text-muted">Ex.: lucas_silva, araujo_lima, pedro354</small>
			  </div>

			</div>

			<!-- PASSWORD INPUT-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="userLogin.password">Senha: </label>
			  <div class="col-md-7">
			    <input id="userLogin.password" ng-model="userLogin.password" type="password" placeholder="Digite a senha" class="form-control input-md" required="" maxlength="16">			    
			  </div>
			</div>

			<!-- BOTÃO FORM FORM-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="btn_form"></label>
			  <div class="col-md-4">	
			  	<button id="btn_login" name="btn_login" class="btn btn-success mb-1" type="submit">Entrar</button>		    			    
			  </div>
			</div>	

			</fieldset>
			</form>
		</div>	
	</div>
</div>
<!-- END CONTAINER -->

<script>
	
</script>
