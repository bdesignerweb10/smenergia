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

			    	$qry_missao = $conn->query("SELECT id, texto_missao, texto_visao, texto_valores ,ativo FROM missao WHERE id = $id") or trigger_error("27005 - " . $conn->error);

					if ($qry_missao && $qry_missao->num_rows > 0) {
						$dados = "";
		    			while($missao = $qry_missao->fetch_object()) {
		    				$dados = '{"id" : "' . $missao->id . '", "texto_missao" : "' . $missao->texto_missao . '", "texto_visao" : "' . $missao->texto_visao . '", "texto_valores" : "'. $missao->texto_valores .'" ,"ativo" : "' . $missao->ativo . '"}';
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

					if(isset($_POST) && !empty($_POST) && $_POST["texto_missao"]) {
						$isValid = true;
						$errMsg = "";

						if(!isset($_POST["texto_missao"]) || empty($_POST["texto_missao"])) {
							$errMsg .= "missao";
							$isValid = false;
						}

						if(!isset($_POST["texto_visao"]) || empty($_POST["texto_visao"])) {
							$errMsg .= "Visão";
							$isValid = false;
						}
						

						if(!isset($_POST["texto_valores"]) || empty($_POST["texto_valores"])) {
							$errMsg .= "Valores";
							$isValid = false;
						}

						if(!$isValid) {
							echo '{"succeed": false, "errno": 27006, "title": "Erro em um ou mais campos do formulário!", "erro": "Ocorreram erros nos seguintes campos do formulário: <b>' . $errMsg . '</b>"}';
							$conn->rollback();
							exit();
						}
						else {
							$missao = $_POST["texto_missao"];
							$visao = $_POST["texto_visao"];
							$valores = $_POST["texto_valores"];
							$ativo = (isset($_POST["ativo"]) && $_POST["ativo"] == "on" ? "0" : "1");
							

							$qry_missao = "INSERT INTO missao (texto_missao, texto_visao, texto_valores, ativo) VALUES ('" . $missao . "','" . $visao . "', '". $valores ."' ,'" . $ativo . "')";

							if ($conn->query($qry_missao) === TRUE) {
								$conn->commit();
								echo '{"succeed": true}';
							} else {
						        throw new Exception("Erro ao inserir o evento: " . $qry_missao . "<br>" . $conn->error);
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

					if(isset($_POST) && !empty($_POST) && $_POST["texto_missao"]) {
						$isValid = true;
						$errMsg = "";

						if(!isset($_POST["texto_visao"]) || empty($_POST["texto_visao"])) {
							$errMsg .= "Visão";
							$isValid = false;
						}					

						if(!isset($_POST["texto_valores"]) || empty($_POST["texto_valores"])) {
							$errMsg .= "valores";
							$isValid = false;
						}

						if(!$isValid) {
							echo '{"succeed": false, "errno": 27010, "title": "Erro em um ou mais campos do formulário!", "erro": "Ocorreram erros nos seguintes campos do formulário: <b>' . $errMsg . '</b>"}';
							$conn->rollback();
							exit();
						}
						else {
							$missao = $_POST["texto_missao"];						
							$visao = $_POST["texto_visao"];
							$valores = $_POST["texto_valores"];
							$ativo = (isset($_POST["ativo"]) && $_POST["ativo"] == "on" ? "0" : "1");
							

							$qry_missao = "UPDATE missao 
											  SET texto_missao = '" . $missao . "',										      
											      texto_visao = '" . $visao . "',
											      texto_valores = '" . $valores . "',
											      ativo = " . $ativo . "
											WHERE id = $id";
							if ($conn->query($qry_missao) === TRUE) {
								$conn->commit();
								echo '{"succeed": true}';
							} else {
						        throw new Exception("Erro ao alterar o evento: " . $qry_missao . "<br>" . $conn->error);
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
					echo '{"succeed": false, "errno": 27020, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID do servico não enviado! Favor contatar o administrador mostrando o erro!"}';
					exit();
				}

				$id = $_GET['id']; // $_SESSION["fake_id"];

				$qrydel_missao = "DELETE FROM missao WHERE id = $id";
				if ($conn->query($qrydel_missao) === TRUE) {
				
					$qrydelmissao = "DELETE FROM missao WHERE id = $id";
					if ($conn->query($qrydelmissao) === TRUE) {
						$conn->commit();
						echo '{"succeed": true}';
					} else {
				        throw new Exception("Erro ao remover missao visao e valores: " . $qrydelmissao . "<br>" . $conn->error);
					}
				} else {
			        throw new Exception("Erro ao remover missao visao e valore: " . $qrydel_missao . "<br>" . $conn->error);
				}
			} catch(Exception $e) {
				$conn->rollback();

				echo '{"succeed": false, "errno": 27021, "title": "Erro ao salvar os dados!", "erro": "Ocorreu um erro ao salvar os dados: ' . $e->getMessage() . '"}';
			}
	        break;    
		}
	}
?>