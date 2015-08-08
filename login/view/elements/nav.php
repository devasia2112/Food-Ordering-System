<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <link href="view/elements/Menu/css/helper.css" media="screen" rel="stylesheet" type="text/css" /> -->
<!-- Beginning of compulsory code below -->
<link href="view/elements/Menu/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="view/elements/Menu/css/dropdown/themes/nvidia.com/default.advanced.css" media="screen" rel="stylesheet" type="text/css" />
<!-- <link href="view/elements/Menu/css/horizontal-centering.css" media="all" rel="stylesheet" type="text/css" /> -->
<!-- / END -->

<?php
if( isset( $_SESSION['user'] ) and !empty( $_SESSION['user'] ))
{
    $top_message = LBL_WELCOME . '<b>, ' . $user->username . '</b>, ' . LBL_TODAY_IS . ' ' . date('d-m-Y');
    ?>


    <div id="member-menu"><?php echo $top_message; ?></div>

    <body class="nvidia-com">

        <!-- Beginning of compulsory code below -->

        <div class="horizontal-centering"><div><div>

	        <ul class="dropdown dropdown-horizontal">
		        <li><a href="#" class="dir">Home</a>
			        <ul>
				        <li><a href="#">Sub Menu 1 + </a>
                            <ul>
                                <li> <a href="#">Sub Menu 1.1</a> </li>
                            </ul>
                        </li>
				        <li><a href="#">Sub Menu 2</a></li>
				        <li><a href="#">Sub Menu 3</a></li>
			        </ul>
		        </li>
		        <li><a href="#" class="dir"><?php echo LBL_PRODUCTS; ?></a>
			        <ul>
				        <li><a href="#">Sub Menu 1</a></li>
				        <li><a href="#">Sub Menu 2</a></li>
			        </ul>
		        </li>
		        <li><a href="#" class="dir"><?php echo LBL_EMAIL; ?></a>
			        <ul>
				        <li><a href="#">Sub Menu 1</a></li>
				        <li><a href="#">Sub Menu 2</a></li>
			        </ul>
		        </li>
		        <li><a href="#" class="dir"><?php echo LBL_REPORTS; ?></a>
			        <ul>
				        <li><a href="#">Analítico</a></li>
				        <li><a href="#">Sintético</a></li>
			        </ul>
		        </li>
		        <li><a href="#" class="dir"><?php echo LBL_ACCOUNT; ?></a>
			        <ul>
				        <li><a href="#">Sub Menu 1</a></li>
				        <li><a href="#">Sub Menu 2</a></li>
			        </ul>
		        </li>
		        <li><a href="#" class="dir"><?php echo LBL_REGISTER; ?></a>
			        <ul>
				        <li><a href="#">Sub Menu 1</a></li>
				        <li><a href="#">Sub Menu 2</a></li>
			        </ul>
		        </li>
		        <li><a href="#">Suporte</a></li>
		        <li><a href="logout.php">Sair</a></li>
	        </ul>

        </div></div></div>

        <!-- / END -->

    </body>

<?php
}
else
{
    if( $_SERVER['REQUEST_METHOD'] == "GET" ) 
        General::Redirect( $sec=0, $file="/Office/" );
    else if( $_SERVER['REQUEST_METHOD'] == "POST" ) 
        General::Redirect( $sec=0, $file="/Office/" );
    else if( $_SERVER['REQUEST_METHOD'] == "HEAD" ) 
        General::Redirect( $sec=0, $file="/Office/" );
    else if( $_SERVER['REQUEST_METHOD'] == "PUT" ) 
        General::Redirect( $sec=0, $file="/Office/" );
    else
    {
        echo 'METHOD: ' . $_SERVER['REQUEST_METHOD'];
        General::Redirect( $sec=0, $file="/Office/" );
        die();
    }
}

?>
