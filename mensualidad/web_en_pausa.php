




<style>
	.pausa_section{

		position: none; 

		<?php 
			//Variable declarada en mensualidad/verificar_dias.php
			echo $pausa_position_img;

		?>

		z-index: 99999;

		width: 100%;
		height: 100%;

		background-color: black;

		display: flex;
		align-items: center;
		justify-content: center;
	}	

	.pausa_imagen_cont{
		position: relative;
		height: 25%;

		top:-20px;
	}

	.pausa_imagen{
		height: 100%;

		/*background-color: red;*/
	}

	.pausa_txt{
		color: white;
		text-align: center;
	}

</style>









<section class="pausa_section">
	
	<div class="pausa_imagen_cont">
	
		<img class="pausa_imagen" src="./assets/images/LOGO-MODIFICADO2.png" alt="">

		<div class="pausa_txt" >Servidor pausado</div>

	</div>
	
</section>