<?php
	require_once("../../acts/connect.php");
	if (!isset($_SESSION["usu_id"]) || empty($_SESSION["usu_id"]) || 
		!isset($_SESSION['usu_nivel']) || empty($_SESSION["usu_nivel"]) ||
		$_SESSION['usu_nivel'] == "3" || $_SESSION["usu_id"] == "0") die('29001 - Você não tem permissão para acessar essa página!');

	if(isset($_GET['act']) && !empty($_GET['act'])) {
		switch ($_GET['act']) {
			case 'showupd':
				try {
					if(!isset($_GET['id']) || empty($_GET['id'])) {
						echo '{"succeed": false, "errno": 27004, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID do evento não enviado! Favor contatar o administrador mostrando o erro!"}';
						exit();
					}

					$id = $_GET['id']; // $_SESSION["fake_id"];

			    	$qry_treinamentos = $conn->query("SELECT id,descricao, ativo FROM treinamentos WHERE id = $id") or trigger_error("27005 - " . $conn->error);

					if ($qry_treinamentos && $qry_treinamentos->num_rows > 0) {
						$dados = "";
		    			while($treinamento = $qry_treinamentos->fetch_object()) {
		    				$dados = '{"id" : "' . $treinamento->id . '", "descricao" : "' . $treinamento->descricao . '",  "ativo" : "' . $treinamento->ativo . '"}';
		    			}

						echo '{"succeed": true, "dados": ' . $dados . '}';
						exit();
		    		}
		    		else {
		    			throw new Exception('Nenhum evento encontrado com o ID ' . $id . "!");
		    		}
				} catch(Exception $e) {
					echo '{"succeed": false, "errno": 24005, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
					exit();
				}
		        break;

			case 'add':
				try {
					$conn->autocommit(FALSE);

					if(isset($_POST) && !empty($_POST) && $_POST["descricao"]) {
						$isValid = true;
						$errMsg = "";					
						

						if(!isset($_POST["descricao"]) || empty($_POST["descricao"])) {
							$errMsg .= "Descrição do treinamento";
							$isValid = false;
						}

						if(!$isValid) {
							echo '{"succeed": false, "errno": 27006, "title": "Erro em um ou mais campos do formulário!", "erro": "Ocorreram erros nos seguintes campos do formulário: <b>' . $errMsg . '</b>"}';
							$conn->rollback();
							exit();
						}
						else {							
							$descricao = $_POST["descricao"];
							$ativo = (isset($_POST["ativo"]) && $_POST["ativo"] == "on" ? "0" : "1");
							

							$qry_treinamento = "INSERT INTO treinamentos (descricao, ativo) VALUES ('" . $descricao . "', '" . $ativo . "')";

							if ($conn->query($qry_treinamento) === TRUE) {
								$conn->commit();
								echo '{"succeed": true}';
							} else {
						        throw new Exception("Erro ao inserir o evento: " . $qry_treinamento . "<br>" . $conn->error);
							}
						}
					}
					else {
						echo '{"succeed": false, "errno": 27008, "title": "Erro ao enviar o formulário!", "erro": "Ocorreu um erro ao tentar enviar seu formulário, favor recarregar a página e tentar novamente!"}';
						$conn->rollback();
						exit();
					}
				} catch(Exception $e) {
					$conn->rollback();

					echo '{"succeed": false, "errno": 27007, "title": "Erro ao salvar os dados!", "erro": "Ocorreu um erro ao salvar os dados: ' . $e->getMessage() . '"}';
				}
		        break;
	        case 'edit':
				try {
					$conn->autocommit(FALSE);

					if(!isset($_GET['id']) || empty($_GET['id'])) {
						echo '{"succeed": false, "errno": 27014, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID do evento não enviado! Favor contatar o administrador mostrando o erro!"}';
						exit();
					}	

					$id = $_GET['id'];			

					if(isset($_POST) && !empty($_POST) && $_POST["descricao"]) {
						$isValid = true;
						$errMsg = "";
										

						if(!isset($_POST["descricao"]) || empty($_POST["descricao"])) {
							$errMsg .= "Descrição do treinamento";
							$isValid = false;
						}

						if(!$isValid) {
							echo '{"succeed": false, "errno": 27010, "title": "Erro em um ou mais campos do formulário!", "erro": "Ocorreram erros nos seguintes campos do formulário: <b>' . $errMsg . '</b>"}';
							$conn->rollback();
							exit();
						}
						else {												
							$descricao = $_POST["descricao"];
							$ativo = (isset($_POST["ativo"]) && $_POST["ativo"] == "on" ? "0" : "1");
							

							$qry_treinamento = "UPDATE treinamentos 
											  SET descricao = '" . $descricao . "',
											      ativo = " . $ativo . "
											WHERE id = $id";
							if ($conn->query($qry_treinamento) === TRUE) {
								$conn->commit();
								echo '{"succeed": true}';
							} else {
						        throw new Exception("Erro ao alterar o evento: " . $qry_treinamento . "<br>" . $conn->error);
							}
						}
					}
					else {
						echo '{"succeed": false, "errno": 27012, "title": "Erro ao enviar o formulário!", "erro": "Ocorreu um erro ao tentar enviar seu formulário, favor recarregar a página e tentar novamente!"}';
						$conn->rollback();
						exit();
					}
				} catch(Exception $e) {
					$conn->rollback();

					echo '{"succeed": false, "errno": 27013, "title": "Erro ao salvar os dados!", "erro": "Ocorreu um erro ao salvar os dados: ' . $e->getMessage() . '"}';
				}
		        break;
		    case 'del':
			try {
				$conn->autocommit(FALSE);

				if(!isset($_GET['id']) || empty($_GET['id'])) {
					echo '{"succeed": false, "errno": 27020, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID do evento não enviado! Favor contatar o administrador mostrando o erro!"}';
					exit();
				}

				$id = $_GET['id']; // $_SESSION["fake_id"];

				$qrydel_treinamentos = "DELETE FROM treinamentos WHERE id = $id";
				if ($conn->query($qrydel_treinamentos) === TRUE) {
				
					$qrydeltreinamento = "DELETE FROM treinamentos WHERE id = $id";
					if ($conn->query($qrydeltreinamento) === TRUE) {
						$conn->commit();
						echo '{"succeed": true}';
					} else {
				        throw new Exception("Erro ao remover o evento: " . $qrydeltreinamento . "<br>" . $conn->error);
					}
				} else {
			        throw new Exception("Erro ao remover os times do evento: " . $qrydel_treinamentos . "<br>" . $conn->error);
				}
			} catch(Exception $e) {
				$conn->rollback();

				echo '{"succeed": false, "errno": 27021, "title": "Erro ao salvar os dados!", "erro": "Ocorreu um erro ao salvar os dados: ' . $e->getMessage() . '"}';
			}
	        break;    
		}
	}
?>