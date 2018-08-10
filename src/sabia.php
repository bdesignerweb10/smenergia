<?php
	require_once('header.php');

	$sabia = $conn->query("select * from vw_sabia") or trigger_error($conn->error);		
?>	
	</div><!-- container -->
	<div class="container-fluid">
		<div class="row quem-somos">
		<?php if ($sabia && $sabia->num_rows > 0) {
			while($vcsabia = $sabia->fetch_object()) {
		?>	
			<div class="col-sm-10">
				<h3 class="title"><?php echo $vcsabia->pergunta ?></h3>
				<p class="text-sobre"> <?php echo $vcsabia->resposta; ?></p>
			</div>
			<?php } ?>
		<?php } ?>
		</div><!-- row -->
	</div><!-- container -->
<?php
	require_once('footer.php');
?>	