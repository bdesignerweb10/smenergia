		<div id="alert" class="modal" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="alert-title" class="modal-title"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p id="alert-content"></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
					</div>
				</div>
			</div>
		</div>
		<div id="confirm" class="modal" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="confirm-title" class="modal-title">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<div class="modal-body">
					<p id="confirm-content"></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-danger" id="btn-confirm-modal">Continuar</button>
					</div>
				</div>
			</div>
		</div>
		<div id="loading" class="modal" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Aguarde! Processando seus dados...</h5>
					</div>
					<div class="modal-body">
						<p id="alert-content" style="text-align: center;">
						<img src="../img/loading.gif" border="0"><br />
						Sua requisição foi enviada e está sendo processada pelo nosso sistema! Aguarde alguns instantes....
						</p>
					</div>
				</div>
			</div>
		</div>
		
		<script src="../js/main.js"></script>
		<script src="js/app.js"></script>
		<script src="../js/jquery.datetimepicker.js"></script>
		<?php if($conn) $conn->close(); ?>
	</body>
</html>