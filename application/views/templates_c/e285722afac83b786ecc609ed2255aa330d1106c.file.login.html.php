<?php /* Smarty version Smarty-3.1.13, created on 2013-09-12 03:28:29
         compiled from "application\views\templates_utf8\login.html" */ ?>
<?php /*%%SmartyHeaderCode:1230052309db6964335-93182471%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e285722afac83b786ecc609ed2255aa330d1106c' => 
    array (
      0 => 'application\\views\\templates_utf8\\login.html',
      1 => 1378927706,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1230052309db6964335-93182471',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52309db6990f51_21839239',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52309db6990f51_21839239')) {function content_52309db6990f51_21839239($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
  <head>
  
	<base href="http://localhost/ifun/" />
	
    <meta charset="utf-8">
    <title>Sign in </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="./assets/css/bootstrap.css" rel="stylesheet">
    <link href="./assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
		<script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

	</head>

	<body>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span">
					<!-- <form class="form-horizontal"> -->
					<form>
						<fieldset>
							<legend>登入</legend>
							<label>使用以下帳號登入</label>
							
							<!-- <input type="text" placeholder="Type something…"> -->
							
							<a class="btn" style="width: 138px;" href="http://localhost/ifun/index.php/auth/google">Sing in with Google</a>
							
							<span class="help-block"></span>
							
							<a class="btn" href="http://localhost/ifun/index.php/auth/facebook">Sing in with Facebook</a>
							
							<!-- <span class="help-block">Example block-level help text here.</span> -->
							<span class="help-block"></span>
							
							
							<!-- <button type="submit" class="btn">Submit</button> -->
						</fieldset>
					</form>
				</div>
			</div>
		</div> <!-- /container -->

		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	</body>
</html>
<?php }} ?>