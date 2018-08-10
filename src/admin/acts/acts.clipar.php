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

			    	$qry_clipar = $conn->query("SELECT id, nome, telefone, img ,cliente_ativo,parceiro_ativo FROM clientes_parceiros WHERE id = $id") or trigger_error("27005 - " . $conn->error);

					if ($qry_clipar && $qry_clipar->num_rows > 0) {
						$dados = "";
		    			while($clientes = $qry_clipar->fetch_object()) {
		    				$dados = '{"id" : "' . $clientes->id . '", "nome" : "' . $clientes->nome . '", "telefone" : "' . $clientes->telefone . '","img" : "'. $consultor->img .'"  ,"cliente_ativo" : "' . $clientes->cliente_ativo . '","parceiro_ativo" : "' . $clientes->parceiro_ativo . '"}';
		    			}

						echo '{"succeed": true, "dados": ' . $dados . '}';
						exit();
		    		}
		    		else {
		    			throw new Exception('Nenhum cliente ou parceiro encontrado com o ID ' . $id . "!");
		    		}
				} catch(Exception $e) {
					echo '{"succeed": false, "errno": 24005, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
					exit();
				}
		        break;

			case 'add':
				try {
					$conn->autocommit(FALSE);

					if(isset($_POST) && !empty($_POST) && $_POST["nome"]) {
						$isValid = true;
						$errMsg = "";

						if(!isset($_POST["nome"]) || empty($_POST["nome"])) {
							$errMsg .= "Nome (Nome do cliente ou parceiro)";
							$isValid = false;
						}
						

						if(!isset($_POST["telefone"]) || empty($_POST["telefone"])) {
							$errMsg .= "telefone do cliente ou parceiro";
							$isValid = false;
						}						

						if(!$isValid) {
							echo '{"succeed": false, "errno": 27006, "title": "Erro em um ou mais campos do formulário!", "erro": "Ocorreram erros nos seguintes campos do formulário: <b>' . $errMsg . '</b>"}';
							$conn->rollback();
							exit();
						}
						else {
							
							if(isset($_FILES['img'])) {

								if($_FILES['img']['type'] != "image/png") {
					        		throw new Exception("Imagem enviada precisa ser tipo PNG!");
								}
							    
							    $imgsize = getimagesize($_FILES['img']['tmp_name']);

							    if($imgsize[0] < 178) {
					        		throw new Exception("Tamanho mínimo da largura da imagem precisa ser 178px! Favor escolher outra imagem e enviar novamente!");
							    }

							    $pathImagem = "../../img/clientes/" . ($_FILES['img']['name']);
							    

							    if(is_uploaded_file($_FILES['img']['tmp_name']) || $_FILES['img']['error'] !== UPLOAD_ERR_OK) {
							        $ratio = $imgsize[0] / $imgsize[1];

								    $width = 178;
								    $height = 178 / $ratio;	

									$src = imagecreatefrompng($_FILES['img']['tmp_name']);
									
									$dst = imagecreatetruecolor($width, $height);
								    imagealphablending($dst, false);
								    imagesavealpha($dst, true);

									imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $imgsize[0], $imgsize[1]);
									imagepng($dst, $pathImagem, 0);
									imagedestroy($dst);
									imagedestroy($src);
							    }							   
							}
							if($_FILES['img'] == ''){
								$imagem = 'no-image.png';
							} else{
							$imagem = $_FILES['img']['name'];	
							}						
							$nome = $_POST["nome"];
							$telefone = $_POST["telefone"];
							$cliente = (isset($_POST["cliente"]) && $_POST["cliente"] == "on" ? "0" : "1");						
							$parceiro = (isset($_POST["parceiro"]) && $_POST["parceiro"] == "on" ? "0" : "1");
							

							$qry_cli_par = "INSERT INTO clientes_parceiros (nome, telefone, img, cliente_ativo ,parceiro_ativo) VALUES ('" . $nome . "','" . $telefone . "', '". $imagem ."' ,'" . $cliente . "','" . $parceiro . "')";

							if ($conn->query($qry_cli_par) === TRUE) {
								$conn->commit();
								echo '{"succeed": true}';
							} else {
						        throw new Exception("Erro ao inserir o evento: " . $qry_cli_par . "<br>" . $conn->error);
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

					if(isset($_POST) && !empty($_POST) && $_POST["nome"]) {
						$isValid = true;
						$errMsg = "";

						if(!isset($_POST["nome"]) || empty($_POST["nome"])) {
							$errMsg .= "Nome (nome do cliente ou parceiro)";
							$isValid = false;
						}					

						if(!isset($_POST["telefone"]) || empty($_POST["telefone"])) {
							$errMsg .= "Telefone do cliente ou parceiro";
							$isValid = false;
						}

						if(!$isValid) {
							echo '{"succeed": false, "errno": 27010, "title": "Erro em um ou mais campos do formulário!", "erro": "Ocorreram erros nos seguintes campos do formulário: <b>' . $errMsg . '</b>"}';
							$conn->rollback();
							exit();
						}
						else {
							if(isset($_FILES['img'])) {

								if($_FILES['img']['type'] != "image/png") {
					        		throw new Exception("Imagem enviada precisa ser tipo PNG!");
								}
							    
							    $imgsize = getimagesize($_FILES['img']['tmp_name']);

							    if($imgsize[0] < 178) {
					        		throw new Exception("Tamanho mínimo da largura da imagem precisa ser 178px! Favor escolher outra imagem e enviar novamente!");
							    }

							    $pathImagem = "../../img/clientes/" . ($_FILES['img']['name']);
							    

							    if(is_uploaded_file($_FILES['img']['tmp_name']) || $_FILES['img']['error'] !== UPLOAD_ERR_OK) {
							        $ratio = $imgsize[0] / $imgsize[1];

								    $width = 178;
								    $height = 178 / $ratio;	

									$src = imagecreatefrompng($_FILES['img']['tmp_name']);
									
									$dst = imagecreatetruecolor($width, $height);
								    imagealphablending($dst, false);
								    imagesavealpha($dst, true);

									imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $imgsize[0], $imgsize[1]);
									imagepng($dst, $pathImagem, 0);
									imagedestroy($dst);
									imagedestroy($src);
							    }							   
							}

							if($_FILES['img'] == ''){
								$imagem = 'no-image.png';
							} else{
							$imagem = $_FILES['img']['name'];	
							}	
							$nome = $_POST["nome"];						
							$telefone = $_POST["telefone"];						
							$cliente = (isset($_POST["cliente"]) && $_POST["cliente"] == "on" ? "0" : "1");
							$parceiro = (isset($_POST["parceiro"]) && $_POST["parceiro"] == "on" ? "0" : "1");
							

							$qry_clipar = "UPDATE clientes_parceiros 
											  SET nome = '" . $nome . "',										      
											      telefone = '" . $telefone . "',
											      img = '". $imagem ."',
											      cliente_ativo = " . $cliente . ",
											      parceiro_ativo = " . $parceiro . "
											WHERE id = $id";
							if ($conn->query($qry_clipar) === TRUE) {
								$conn->commit();
								echo '{"succeed": true}';
							} else {
						        throw new Exception("Erro ao alterar o evento: " . $qry_clipar . "<br>" . $conn->error);
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

				$qrydel_clipar = "DELETE FROM clientes_parceiros WHERE id = $id";
				if ($conn->query($qrydel_clipar) === TRUE) {
				
					$qrydelclipar = "DELETE FROM clientes_parceiros WHERE id = $id";
					if ($conn->query($qrydelclipar) === TRUE) {
						$conn->commit();
						echo '{"succeed": true}';
					} else {
				        throw new Exception("Erro ao remover cliente ou parceiro: " . $qrydelclipar . "<br>" . $conn->error);
					}
				} else {
			        throw new Exception("Erro ao remover cliente ou parceiro: " . $qrydel_clipar . "<br>" . $conn->error);
				}
			} catch(Exception $e) {
				$conn->rollback();

				echo '{"succeed": false, "errno": 27021, "title": "Erro ao salvar os dados!", "erro": "Ocorreu um erro ao salvar os dados: ' . $e->getMessage() . '"}';
			}
	        break;    
		}
	}
?>