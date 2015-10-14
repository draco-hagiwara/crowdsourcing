<?php /* Smarty version 3.1.27, created on 2015-10-12 10:48:37
         compiled from "/home/cs/www/cs.com.dev/application/views/contents/writer/top/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2060096412561b1175720869_01156023%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c6bff29de03074faf78b3ed19501201ba19e6a81' => 
    array (
      0 => '/home/cs/www/cs.com.dev/application/views/contents/writer/top/index.tpl',
      1 => 1444614509,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2060096412561b1175720869_01156023',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_561b117575ce93_59335057',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_561b117575ce93_59335057')) {
function content_561b117575ce93_59335057 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2060096412561b1175720869_01156023';
?>

	<?php echo $_smarty_tpl->getSubTemplate ("../../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('head_index'=>"1"), 0);
?>


<body>







    <nav class="navbar navbar-inverse">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#patern05">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
  			<a href="/" class="navbar-brand">TOP</a>
      </div>

      <div id="patern05" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="">Link1</a></li>
          <li><a href="">Link2</a></li>

		  <form class="navbar-form navbar-left" role="search">
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="Search">
	        </div>
	        <button type="submit" class="btn btn-default">Submit</button>
	      </form>
        </ul>

		<ul class="nav navbar-nav navbar-right">
		  <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Link3<b class="caret"></b></a>
			<ul class="dropdown-menu right">
				<li><a href="#">Link3-1</a></li>
				<li><a href="#">Link3-2</a></li>
				<li><a href="#">Link3-3</a></li>
			</ul>
		  </li>
        </ul>
      </div>
    </nav>



      <!--Body content-->
	  <div id="typo">
	    <div class="inner">Crowd Sourcing</div>
	  </div>



<div class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">ドロップダウンを表示します</a>
    <ul class="dropdown-menu">
        <li><a href="#">Action</a></li>
        <li><a href="#">Another action</a></li>
        <li><a href="#">Something else here</a></li>
        <li class="divider"></li>
        <li><a href="#">Separated link</a></li>
    </ul>
</div>







   <h1>Buttons</h1>

        <div>
		<button type="button" class="btn btn-default">Default</button>
		<button type="button" class="btn btn-primary">Primary</button>
		<button type="button" class="btn btn-success">Success</button>
		<button type="button" class="btn btn-info">Info</button>
		<button type="button" class="btn btn-warning">Warning</button>
		<button type="button" class="btn btn-danger">Danger</button>
		<button type="button" class="btn btn-link">Link</button>
        </div>


        <h1>Buttons Sizes</h1>

        <div>
            <p>
                <button type="button" class="btn btn-primary btn-lg">Large button</button>
                <button type="button" class="btn btn-default btn-lg">Large button</button>
            </p>
            <p>
                <button type="button" class="btn btn-primary">Default button</button>
                <button type="button" class="btn btn-default">Default button</button>
            </p>
            <p>
                <button type="button" class="btn btn-primary btn-sm">Small button</button>
                <button type="button" class="btn btn-default btn-sm">Small button</button>
            </p>
            <p>
                <button type="button" class="btn btn-primary btn-xs">Extra small button</button>
                <button type="button" class="btn btn-default btn-xs">Extra small button</button>
            </p>

        </div>


      <h1>グリッドシステム</h1>
        <div>
	        <section class="container">
	            <!-- TwitterBootstrapのグリッドシステムclass="row"で開始 -->
	            <div class="row">
	                <!-- グリッドシステムとは：合計12分割 -->
	                <div class="col-sm-2 hidden-xs" style="background-color: #269abc;">xs以外で非表示</div>
	                <div class="col-sm-7 hidden-sm" style="background-color: #c7254e;">sm以外で非表示</div>
	                <div class="col-sm-3" style="background-color: #eb9316;">all表示</div>
	            </div>
	        </section>
        </div>


      <h1>Table（table-responsive）</h1>

	    <div  class="container">
	      <div class="table-responsive">
	      <table class="table table-striped table-bordered table-hover table-condensed">
	      <thead>
	        <tr class="active">
	          <th>#</th>
	          <th>First Name</th>
	          <th>Last Name</th>
	          <th>Username</th>
	        </tr>
	      </thead>
	      <tbody>
	        <tr class="success">
	          <td>1</td>
	          <td>Mark</td>
	          <td>Otto</td>
	          <td>@mdo</td>
	        </tr>
	        <tr class="warning">
	          <td>2</td>
	          <td>Jacob</td>
	          <td>Thornton</td>
	          <td>@fat</td>
	        </tr>
	        <tr class="danger">
	          <td>3</td>
	          <td>Larry</td>
	          <td>the Bird</td>
	          <td>@twitter</td>
	        </tr>
	        <tr class="info">
	          <td>3</td>
	          <td>Larry</td>
	          <td>the Bird</td>
	          <td>@twitter@twitter@twitter@twitter@twitter@twitter@twitter</td>

	        </tr>
	      </tbody>
	    </table>
	    </div>
	    </div>


    <h1>Responsive images</h1>

        <div  class="container">
            <img src="./img/html5b.png" class="img-responsive" alt="Responsive image">
        </div>


    <h1>Contextual backgrounds</h1>

        <div>
            <p class="bg-primary">HTML5</p>
            <p class="bg-success">CSS3</p>
            <p class="bg-info">JavaScript</p>
            <p class="bg-warning">jQuery</p>
            <p class="bg-danger">Bootstrap</p>
        </div>



        <div  class="container">

             <!-- Tabs -->
            <section>
                <h1>Tabs</h1>
                <div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Messages</a></li>
                    </ul>
                </div>
            </section>

           <!-- Pills -->
            <section>
                <h1>Pills</h1>
                <div>
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Messages</a></li>
                    </ul>
                </div>
            </section>

            <!-- stacked -->
            <section>
                <h1>stacked</h1>
                <div>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Messages</a></li>
                    </ul>
                </div>
            </section>

            <!-- Justified-tab -->
            <section>
                <h1>Justified-tab</h1>
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Messages</a></li>
                </ul>
            </section>

            <!-- Justified-pills -->
            <section>
                <h1>Justified-pills</h1>
                <ul class="nav nav-pills nav-justified">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Messages</a></li>
                </ul>
            </section>

            <!-- Justified-tab -->
            <section>
                <h1>Justified-tab</h1>
                <ul class="nav nav-pills">
                    <li class=""><a href="#">Ennable link</a></li>
                    <li class="disabled"><a href="#">Disabled link</a></li>
                    <li class=""><a href="#">Ennable link</a></li>
                </ul>
            </section>

        </div>





    <!-- TwitterBootstrapのグリッドシステムclass="row"で終了 -->
    </div>
  </section>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("../../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>



</body>
</html>
<?php }
}
?>