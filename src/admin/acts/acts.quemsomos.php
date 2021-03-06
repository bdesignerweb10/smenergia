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

			    	$qry_quemsomos = $conn->query("SELECT id, titulo, descricao, ativo FROM quem_somos WHERE id = $id") or trigger_error("27005 - " . $conn->error);

					if ($qry_quemsomos && $qry_quemsomos->num_rows > 0) {
						$dados = "";
		    			while($quemsomos = $qry_quemsomos->fetch_object()) {
		    				$dados = '{"id" : "' . $quemsomos->id . '", "titulo" : "' . $quemsomos->titulo . '", "descricao" : "' . $quemsomos->descricao . '",  "ativo" : "' . $quemsomos->ativo . '"}';
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

					if(isset($_POST) && !empty($_POST) && $_POST["titulo"]) {
						$isValid = true;
						$errMsg = "";

						if(!isset($_POST["titulo"]) || empty($_POST["titulo"])) {
							$errMsg .= "Título (Titulo do quem somos)";
							$isValid = false;
						}
						

						if(!isset($_POST["descricao"]) || empty($_POST["descricao"])) {
							$errMsg .= "Descrição do quem somos";
							$isValid = false;
						}

						if(!$isValid) {
							echo '{"succeed": false, "errno": 27006, "title": "Erro em um ou mais campos do formulário!", "erro": "Ocorreram erros nos seguintes campos do formulário: <b>' . $errMsg . '</b>"}';
							$conn->rollback();
							exit();
						}
						else {
							$titulo = $_POST["titulo"];
							$descricao = $_POST["descricao"];
							$ativo = (isset($_POST["ativo"]) && $_POST["ativo"] == "on" ? "0" : "1");
							

							$qry_evento = "INSERT INTO quem_somos (titulo, descricao, ativo) VALUES ('" . $titulo . "','" . $descricao . "', '" . $ativo . "')";

							if ($conn->query($qry_evento) === TRUE) {
								$conn->commit();
								echo '{"succeed": true}';
							} else {
						        throw new Exception("Erro ao inserir o evento: " . $qry_evento . "<br>" . $conn->error);
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

					if(isset($_POST) && !empty($_POST) && $_POST["titulo"]) {
						$isValid = true;
						$errMsg = "";

						if(!isset($_POST["titulo"]) || empty($_POST["titulo"])) {
							$errMsg .= "Título (nome do quem somos)";
							$isValid = false;
						}					

						if(!isset($_POST["descricao"]) || empty($_POST["descricao"])) {
							$errMsg .= "Descrição do quem somos";
							$isValid = false;
						}

						if(!$isValid) {
							echo '{"succeed": false, "errno": 27010, "title": "Erro em um ou mais campos do formulário!", "erro": "Ocorreram erros nos seguintes campos do formulário: <b>' . $errMsg . '</b>"}';
							$conn->rollback();
							exit();
						}
						else {
							$titulo = $_POST["titulo"];						
							$descricao = $_POST["descricao"];
							$ativo = (isset($_POST["ativo"]) && $_POST["ativo"] == "on" ? "0" : "1");
							

							$qry_quemsomos = "UPDATE quem_somos 
											  SET titulo = '" . $titulo . "',										      
											      descricao = '" . $descricao . "',
											      ativo = " . $ativo . "
											WHERE id = $id";
							if ($conn->query($qry_quemsomos) === TRUE) {
								$conn->commit();
								echo '{"succeed": true}';
							} else {
						        throw new Exception("Erro ao alterar o evento: " . $qry_quemsomos . "<br>" . $conn->error);
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

				$qrydel_quemsomos = "DELETE FROM quem_somos WHERE id = $id";
				if ($conn->query($qrydel_quemsomos) === TRUE) {
				
					$qrydelquemsomos = "DELETE FROM quem_somos WHERE id = $id";
					if ($conn->query($qrydelquemsomos) === TRUE) {
						$conn->commit();
						echo '{"succeed": true}';
					} else {
				        throw new Exception("Erro ao remover o evento: " . $qrydelquemsomos . "<br>" . $conn->error);
					}
				} else {
			        throw new Exception("Erro ao remover os times do evento: " . $qrydel_quemsomos . "<br>" . $conn->error);
				}
			} catch(Exception $e) {
				$conn->rollback();

				echo '{"succeed": false, "errno": 27021, "title": "Erro ao salvar os dados!", "erro": "Ocorreu um erro ao salvar os dados: ' . $e->getMessage() . '"}';
			}
	        break;    
		}
	}
?>