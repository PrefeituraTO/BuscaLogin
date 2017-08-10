<?php
	if(isset($_POST['company'])) $CPF=$_POST['company'];
	else $CPF='';

	$LDAPFilter = '(&(objectClass=user)(company='.$CPF.'))';
?>
<html>
 <head>
  <title>Acesso Usuario</title>
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
  <link href="/css/sb-admin-2.css" rel="stylesheet">
  <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <script src="/js/funcoes_cpf.js"></script>
 </head>
 <body>
  <div id="wrapper">
   <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
     <a class="navbar-brand" href="/">Prefeitura Municipal de Teofilo Otoni</a>
    </div>
    <div class="navbar-default sidebar" role="navigation">
     <div class="sidebar-nav navbar-collapse">
      <ul class="nav" id="side-menu">
       <li><a href="http://csti.teofilootoni.mg.gov.br/"><i class="fa fa-dashboard fa-fw"></i>GLPI</a></li>
       <li><a href="http://teofilootoni.mg.gov.br/"><i class="fa fa-hospital-o fa-fw"></i>Site Prefeitura</a></li>
       <li><a href="http://senha.teofilootoni.mg.gov.br/"><i class="fa fa-unlock fa-fw"></i>Altere sua senha</a></li>
      </ul>
     </div>
    </div>
   </nav>
   <div id="page-wrapper">
    <div class="container-fluid">
     <div class="row">
      <div class="col-lg-12">
       <h1 class="page-header">Buscar Usuário</h1>
        <form class="form-signin" action="http://login.teofilootoni.mg.gov.br/" name="form1" method="POST">
         <div class="form-group">
          <label for="login" class="sr-only">Login : </label>
          <input type="text" name="company" id="company" value="" class="form-control" minlength="11" maxlength="11" onblur="return verificarCPF(this.value)" placeholder="Insira os n&uacute;meros do seu CPF" required autofocus>
         </div>
         <button class="btn btn-lg btn-primary btn-block" type="submit">Buscar</button>
        </form>
       </div>
      </div>
<?php
	if(($connect=@ldap_connect(getEnv(LDAPServer)))){
		if(($bind=@ldap_bind($connect, getEnv(LDAPUser), getEnv(LDAPPass)))){
			if(($search=@ldap_search($connect, getEnv(LDAPBaseDN), $LDAPFilter))){
				$number_returned = ldap_count_entries($connect,$search);
				$info = ldap_get_entries($connect, $search);
				for ($i=0; $i < $info["count"]; $i++){
					echo "<table class='table table-striped table-bordered table-hover'>";
					echo "<tr>";
					echo "<td><b><font face=\"verdana\">Nome</font></td>";
					echo "<td>".$info[$i]["displayname"][0]."</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td><b><font face=\"verdana\">E-Mail</font></td>";
					echo "<td>".$info[$i]["mail"][0]."</td>";
					echo "</tr>";
					echo "</tr>";
					echo "<td><b><i><font face=\"verdana\" size=\"4\">Login</font></td>";
					echo "<td><b><font face=\"verdana\"><i>".$info[$i]["samaccountname"][0]."</font></td>";
					echo "</tr>";
					echo "</table>";
				}
				if ($number_returned == 0 ){
					echo "<div class='col-lg-14'>";
					echo "<div class='panel panel-primary'>";
					echo"<div class='panel-heading'>CPD</div>";
					echo"<div class='panel-body'>";
					echo"<p>"."Caro Colaborador, se ainda n&atildeo &eacute cadastrado, gentileza dirij&aacute-se ao CPD, para realizar o cadastro do GLPI. "."</p>";
					echo"</div></div></div>";
				}
        		} else echo "Problema na pesquisa";
		} else echo "Problema na autenticação";
	} else echo "Problema na conexão";
	ldap_close($connect);
?>
    </div>
   </div>
  </div>
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="/vendor/metisMenu/metisMenu.min.js"></script>
  <script src="/js/sb-admin-2.js"></script>    
 </body>
</html>
