<?php header('Content-type: text/css'); ?>

	/* Helpers */
	
	.cf:before,
	.cf:after {
	    content: " "; /* 1 */
	    display: table; /* 2 */
	}
	
	.cf:after {
	    clear: both;
	}
	
	.cf {
	    *zoom: 1;
	}

	/* Global QV */
	
	button.mfp-arrow,
	button.mfp-arrow:hover,
	.mfp-close-btn-in button.mfp-close,
	.mfp-close-btn-in button.mfp-close:hover {
		background: none;
		font-weight: normal;
	}
	
	#jckqv {
		background: #fff;
		padding: 40px 40px 30px;
		max-width: 800px;
		text-align: left;
		margin: 30px auto;
		position: relative;
		font-family: "Helvetica Neue", Arial, Helvetica, sans-serif;
	}
	
	@media (max-width: 1020px){
		#jckqv {
			max-width: 500px;
			padding: 0;
		}
	}
	
		#jckqv * {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
	        box-sizing: border-box;
	        -webkit-font-smoothing: antialiased;
			-moz-font-smoothing: antialiased;
			-o-font-smoothing: antialiased;
			font-smoothing: antialiased;
		}
		
	/* QV Button */
	
	.jckqvBtn {
		<?php 
		$btnDisplay = 'table';
		if($theSettings['trigger_position_align'] == 'none') $btnDisplay = 'block';
		?>
		display: <?php echo $btnDisplay; ?>;
		<?php if($theSettings['trigger_styling_autohide']){ ?>
			-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
			filter: alpha(opacity=0);
			-moz-opacity: 0;
			-khtml-opacity: 0;
			opacity: 0;
			visibility: hidden;
		<?php } ?>
		z-index: 100;
		cursor: pointer;
		position: relative;
		width: auto;
		float: <?php echo ($theSettings['trigger_position_align'] == 'left' || $theSettings['trigger_position_align'] == 'right') ? $theSettings['trigger_position_align'] : "none"; ?>;
		<?php $margins = array($theSettings['trigger_position_margins'][0].'px', $theSettings['trigger_position_margins'][1].'px', $theSettings['trigger_position_margins'][2].'px', $theSettings['trigger_position_margins'][3].'px'); ?>
		margin: <?php echo implode(' ', $margins); ?>;
		<?php $padding = array($theSettings['trigger_styling_padding'][0].'px', $theSettings['trigger_styling_padding'][1].'px', $theSettings['trigger_styling_padding'][2].'px', $theSettings['trigger_styling_padding'][3].'px'); ?>
		padding: <?php echo implode(' ', $padding); ?>;
		<?php if($theSettings['trigger_position_align'] == 'center') { ?>
		margin-left: auto;
		margin-right: auto;
		<?php } ?>
		<?php if($theSettings['trigger_styling_btnstyle'] != 'none') { ?>
			<?php if($theSettings['trigger_styling_btnstyle'] == 'flat') { ?>
				background: <?php echo $theSettings['trigger_styling_btncolour']; ?>;
			<?php } else { ?>
				border: 1px solid #fff;
				border-color: <?php echo $theSettings['trigger_styling_btncolour']; ?>;
			<?php } ?>
			color: <?php echo $theSettings['trigger_styling_btntextcolour']; ?>;
		<?php } ?>
		-moz-border-radius-topleft: <?php echo $theSettings['trigger_styling_borderradius'][0]; ?>px;
		-webkit-border-top-left-radius: <?php echo $theSettings['trigger_styling_borderradius'][0]; ?>px;
		 border-top-left-radius: <?php echo $theSettings['trigger_styling_borderradius'][0]; ?>px;
		-moz-border-radius-topright: <?php echo $theSettings['trigger_styling_borderradius'][1]; ?>px;
		-webkit-border-top-right-radius: <?php echo $theSettings['trigger_styling_borderradius'][1]; ?>px;
		border-top-right-radius: <?php echo $theSettings['trigger_styling_borderradius'][1]; ?>px;
		-moz-border-radius-bottomright: <?php echo $theSettings['trigger_styling_borderradius'][2]; ?>px;
		-webkit-border-bottom-right-radius: <?php echo $theSettings['trigger_styling_borderradius'][2]; ?>px;
		border-bottom-right-radius: <?php echo $theSettings['trigger_styling_borderradius'][2]; ?>px;
		-moz-border-radius-bottomleft: <?php echo $theSettings['trigger_styling_borderradius'][3]; ?>px;
		-webkit-border-bottom-left-radius: <?php echo $theSettings['trigger_styling_borderradius'][3]; ?>px;
		border-bottom-left-radius: <?php echo $theSettings['trigger_styling_borderradius'][3]; ?>px;
	}
	
	.jckqvBtn:hover {
		<?php if($theSettings['trigger_styling_btnstyle'] != 'none') { ?>
			<?php if($theSettings['trigger_styling_btnstyle'] == 'flat') { ?>
				background: <?php echo $theSettings['trigger_styling_btnhovcolour']; ?>;
			<?php } else { ?>
				border-color: <?php echo $theSettings['trigger_styling_btnhovcolour']; ?>;
			<?php } ?>
			color: <?php echo $theSettings['trigger_styling_btntexthovcolour']; ?>;
		<?php } ?>		
	}
	
	/* Magnific Specific */
	
	.mfp-bg {
		background: <?php echo $theSettings['popup_general_overlaycolour']; ?>;
		-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo $theSettings['popup_general_overlayopacity']*10; ?>)";
		filter: alpha(opacity=<?php echo $theSettings['popup_general_overlayopacity']*10; ?>);
		-moz-opacity: <?php echo $theSettings['popup_general_overlayopacity']; ?>;
		-khtml-opacity: <?php echo $theSettings['popup_general_overlayopacity']; ?>;
		opacity: <?php echo $theSettings['popup_general_overlayopacity']; ?>;
	}
	
	/* Qv Typography */
		
		#jckqv h1,
		#jckqv p {
			font-family: "Helvetica Neue", Arial, Helvetica, sans-serif;
			margin: 0;
			font-style: normal;
		}
		
		#jckqv h1 {
			font-size: 28px;
			font-weight: bold;
			color: #333;
			margin: 0 0 15px;
			line-height: 1.2;
		}
		
		#jckqv p {
			font-size: 14px;
			color: #666;
			font-weight: normal;
			margin: 0 0 25px;
			line-height: 1.6;
		}
		
	/* Images */
	
	#jckqv_images_wrap {
		width: 65%;
		float: left;
		display: inline;
		margin: -40px 0 -30px -40px;
	}
	
	@media (max-width: 1020px){
		#jckqv_images_wrap {
			width: 100%;
			float: none;
			display: block;
			margin: 0;
			padding-bottom: 150px; /* thumbnail Height */
		}
	}
		
		#jckqv_images {
			width: 100%;
		}
		
			#jckqv .rsMinW .rsThumbsHor {
				height: <?php echo $imgsizes['thumbnail']['height']; ?>px; /* thumbnail Height */
			}
				#jckqv .rsMinW, 
				#jckqv .rsMinW .rsOverflow, 
				#jckqv .rsMinW .rsSlide, 
				#jckqv .rsMinW .rsVideoFrameHolder, 
				#jckqv .rsMinW .rsThumbs {
					background: <?php echo $theSettings['popup_imagery_bgcolour']; ?>; /* Slide BG Colour */
				}
				#jckqv .rsMinW .rsThumb {
					width: <?php echo $imgsizes['thumbnail']['width']; ?>px; /* thumbnail Width */
					height: <?php echo $imgsizes['thumbnail']['height']; ?>px; /* thumbnail Height */
				}
	
	#jckqv .rsNavItem {
		-webkit-box-sizing: content-box;
		-moz-box-sizing: content-box;
		box-sizing: content-box;
		cursor: pointer;
	}
	
	/* Summary */
	
	#jckqv_summary {
		float: right;
		width: 35%;
		display: inline;
	}
	
	@media (max-width: 1020px){
		#jckqv_summary {
			width: 100%;
			float: none;
			display: block;
			padding: 40px 40px 30px;
		}
	}
	
	/* Rating */
	
	#jckqv .woocommerce-product-rating {
		margin: -15px 0 20px;
		height: 22px;
		line-height: 22px;
		overflow: hidden;
	}
		#jckqv .woocommerce-product-rating .star-rating {
			margin: 4px 0;
			float: left;
			display: inline;
			font-size: 14px;
		}
			#jckqv .woocommerce-product-rating .star-rating:before {
				color: #eeeeee;
			}
				#jckqv .woocommerce-product-rating .star-rating span:before {
					color: #84d6ad;
				}
			
		#jckqv .woocommerce-product-rating .text-rating {
			float: left;
			margin: 0 0 0 10px;
			display: inline;
			width: auto;
			height: 22px;
			line-height: 22px;
			font-size: 14px;
			color: #aaa;
		}
	
	/* Price */
	
	#jckqv .price {
		font-size: 24px;
		line-height: 38px;
		overflow: hidden;
		display: block;
		color: #333;
		font-weight: bold;
	}
		#jckqv .price ins {
			font-size: 24px;
			color: #333;
			float: left;
			line-height: 38px;
			height: 38px;
			width: auto;
			display: inline;
			text-decoration: none;
			font-weight: bold;
			background: none;
			margin: 0;
		}
		#jckqv .price del {
			font-size: 18px;
			font-weight: normal;
			float: left;
			line-height: 40px;
			height: 38px;
			width: auto;
			display: inline;
			-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
			filter: alpha(opacity=50);
			-moz-opacity: 0.5;
			-khtml-opacity: 0.5;
			opacity: 0.5;
			background: none;
			margin: 0 10px 0 0;
			
		}
		
	#jckqv span.price {
		font-size: 20px;
	}
		#jckqv span.price ins {
			font-size: 20px;
		}
		#jckqv span.price del {
			font-size: 14px;
		}
	
	/* Description */
	
	#jckqv #jckqv_desc {
		
	}
	
	/* Sale */
	
	#jckqv .onsale {
		position: absolute;
		top: -15px;
		right: auto;
		left: -15px;
		background: #66cc99;
		color: #fff;
		font-weight: bold;
		letter-spacing: 0;
		padding: 0 .857em;
		line-height: 4.236em;
		-webkit-border-radius: 100%;
		-moz-border-radius: 100%;
		border-radius: 100%;
		-moz-background-clip: padding;
		text-transform: uppercase;
		text-decoration: none;
		font-size: 14px;
		-webkit-box-shadow: none;
		-moz-box-shadow: none;
		box-shadow: none;
		text-shadow: none;
	}
		
	/* Variations */
	
	#jckqv table.variations {
		background: #eee;
		margin: 0 0 35px;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
		width: 100%;
		border: none;
	}
	
		#jckqv table.variations th, 
		#jckqv table.variations td {
			padding: 8px 10px;
			border: none;
			border-bottom: 1px solid #e4e4e4;
			font-size: 14px;
			line-height: 1.6;
			color: #666;
		}
		
		#jckqv table.variations tr:last-child td, 
		#jckqv table.variations tr:last-child th {
			border-bottom: none;
		}
		
		#jckqv table.variations td select {
			width: 100%;
		}
		
		#jckqv table.variations td label {
			font-size: 14px;
		}
		
		#jckqv table.variations .reset_variations {
			display: none !important;
		}
		
	#jckqv .single_variation_wrap {
		overflow: hidden;
		margin: 35px 0 0;
	}
		#jckqv .variations_button {
			overflow: hidden;
		}
	
	/* Add to Cart */
	
	#jckqv .cart {
		overflow: hidden;
		margin: 35px 0;
	}
		
		#jckqv .quantity {
			float: left;
			display: <?php echo ($theSettings['popup_content_showqty'] == 1) ? 'inline' : 'none !important'; ?>;
			width: auto;
			border: none;
			padding: 0;
			margin: 0;
		}
			#jckqv .quantity .qty {
				height: 35px;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
				box-shadow: none;
				background: #f7f7f7;
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				border-radius: 3px;
				color: #888;
				border: 1px solid #bbb;
				margin: 0 10px 0 0;
				font-size: 14px;
				line-height: 1.6;
				font-family: inherit;
				outline: none;
				-webkit-appearance: none;
				-moz-appearance: none;
				padding: .236em .5em;
				-moz-background-clip: padding;
				-webkit-background-clip: padding-box;
				background-clip: padding-box;
				font-weight: normal;
			}
			
			#jckqv input::-webkit-outer-spin-button,
			#jckqv input::-webkit-inner-spin-button {
			    /* display: none; <- Crashes Chrome on hover */
			    -webkit-appearance: none;
			    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
			}
			
			#jckqv .quantity .minus,
			#jckqv .quantity .plus {
				display: none;
			}
		
		<?php if($theSettings['popup_content_themebtn'] != 1){ ?>	
		
			#jckqv .button {
				border: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
				box-shadow: none;
				height: 35px;
				padding: 0 15px;
				font-weight: bold;
				text-shadow: none;
				background: <?php echo $theSettings['popup_content_btncolour']; ?>;
				color: <?php echo $theSettings['popup_content_btntextcolour']; ?>;
				text-shadow: none;
				text-transform: uppercase;
				letter-spacing: 0;
				margin: 0;
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				border-radius: 3px;
				float: left;
				display: inline;
				width: auto;
				font-size: 14px;
				text-decoration: none;
			}
				#jckqv .button:focus {
					outline: none;
				}
				#jckqv .button:hover {
					background: <?php echo $theSettings['popup_content_btnhovcolour']; ?>;
					color: <?php echo $theSettings['popup_content_btntexthovcolour']; ?>;
					text-shadow: none;
					text-decoration: none;
				}
		
		<?php } ?>
			
	/* Product Meta */
	
	#jckqv .product_meta {
		display: block;
		margin: 0 0 25px;
		background: #f7f7f7;
		padding: 0;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
		font-size: 12px;
	}
		#jckqv .product_meta > span {
			display: block;
			padding: 8px 10px;
			border-bottom: 1px solid #eeeeee;
		}
		#jckqv .product_meta > span:last-child {
			border: none;
		}
		
	/* Adding to Cart */
	
	#jckqv #addingToCart {
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: #fff;
		z-index: 100;
		text-align: center;
		display: none;
	}
		#jckqv #addingToCart div {
			position: absolute;
			top: 50%;
			left: 50%;
			height: 100px;
			width: 150px;
			margin: -50px 0 0 -75px;
			font-style: italic;
			font-weight: normal;
			font-size: 14px;
			color: #666;
		}
			#jckqv #addingToCart div i {
				display: block;
				width: 45px;
				margin: 0 52px 0;
				font-size: 30px;
			}