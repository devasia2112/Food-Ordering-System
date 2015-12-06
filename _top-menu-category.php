<!-- top header : categories menu -->
<div style="height:0px; overflow:hidden;"></div>

<table width="999" border="0" cellpadding="0" cellspacing="0" align="center" id="table990" class="table bg">
	<tr>
		<td width="638" id="left_column" valign="top">

			<div style="line-height:20px;">

			<!-- start main categories -->

				<script>
				function aa() {
					$(".menu_bar:first").each(function() {
					//$(this).effect('bounce', {}, Math.random(400,600));
					});
				}
				setTimeout("aa();", 200);
				</script>


				<?php
				// Pendencia :: o numero de categorias deve vir da query count(*) categories
				for ($i=0; $i<=$total_categ; $i++)
				{
					$id         = $array_categories[$i]['id'];
					$name       = $array_categories[$i]['name'];
					$color      = $array_categories[$i]['color'];
					$font_color = $array_categories[$i]['font_color'];

                    // Encode ID (URL)
                    $id = Url::urlEnc( $id );

					if ( !isset( $_GET['category_id'] ) and empty( $_GET['category_id'] ))
					{
						unset( $_SESSION['category_name'] );
            unset( $_SESSION['category_color'] );
            unset( $_SESSION['category_font_color'] );
						session_start();
						if (empty($_SESSION['category_name']))
						{
							$_SESSION['category_name']          = "Sawadee Krap!";
							$_SESSION['category_color']         = $color;
              $_SESSION['category_font_color']    = $font_color;
							$_SESSION['category_id']            = null;
						}
					}

					# Save in session the category if is the same of get
					if ( $_GET['category_id'] == $id )
					{
						unset( $_SESSION['category_name'] );
            unset( $_SESSION['category_color'] );
            unset( $_SESSION['category_font_color'] );
						session_start();
						if (empty($_SESSION['category_name']))
						{
							$_SESSION['category_name']          = $name;
							$_SESSION['category_color']         = $color;
              $_SESSION['category_font_color']    = $font_color;
							$_SESSION['category_id']            = $id;
						}
					}

				 ?>

					<div class="menu_order">
						<div class="menu_bar" style="background-color:#<?=$color;?>; padding-left:10px; padding-right:10px; padding-top:8px; padding-bottom:8px; min-width:222px;" align="center" onclick="$(this).parent().effect('bounce', {}, 250);">
							<a style="font-size:14px; font-weight:bold; color:#<?=$font_color;?>;" href="?category_id=<?=$id;?>"> <?=$name;?> </a>
						</div>
					</div>

		  <?php	} ?>


				<div style="height:0px; overflow:hidden; clear:both;"> </div>

			<!-- end main categories -->


			<!-- menu categories radius border -->
				<script>
				$(function() {
					settings2 = {
						tl: { radius: 10 },
						tr: { radius: 10 },
						bl: { radius: 0 },
						br: { radius: 0 },
						antiAlias: true,
						autoPad: true
					}
				/*	$(".menu_bar")
					.css("padding-top", "7px")
					.css("padding-bottom", "7px")
					.css("padding-left", "5px")
					.css("padding-right", "5px"); */
					max_w = 0;
					$(".menu_bar").each(function() {
						if ($(this).width() > max_w) max_w = $(this).width();
					});
					$(".menu_bar").each(function() {
						$(this).width(max_w);
					});
					$(".menu_bar")
					.corner(settings2);
				});
				</script>
				<!-- menu categories redius border -->

			</div>

<!-- top header : categories menu -->

	</td>
  </tr>
</table>
