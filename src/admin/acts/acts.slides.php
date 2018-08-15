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

			    	$qry_slides = $conn->query("SELECT id, nome, img, link ,ativo FROM banner WHERE id = $id") or trigger_error("27005 - " . $conn->error);

					if ($qry_slides && $qry_slides->num_rows > 0) {
						$dados = "";
		    			while($slides = $qry_slides->fetch_object()) {
		    				$dados = '{"id" : "' . $slides->id . '", "nome" : "' . $slides->nome . '", "img" : "'. $slides->img .'"  ,"link" : "' . $slides->link . '","ativo" : "' . $slides->ativo . '"}';
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

					if(isset($_POST) && !empty($_POST) && $_POST["nome"]) {
						$isValid = true;
						$errMsg = "";

						if(!isset($_POST["nome"]) || empty($_POST["nome"])) {
							$errMsg .= "Titulo do Slide";
							$isValid = false;
						}
						

						if(!isset($_POST["link"]) || empty($_POST["link"])) {
							$errMsg .= "link do slide";
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

							    $pathImagem = "../../img/slides/" . ($_FILES['img']['name']);
							    

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

							$imagem = $_FILES['img']['name'];							
							$nome = $_POST["nome"];
							$link = $_POST["link"];
							$ativo = (isset($_POST["ativo"]) && $_POST["ativo"] == "on" ? "0" : "1");	
							

							$qry_slides = "INSERT INTO banner (nome, img, link ,ativo) VALUES ('" . $nome . "','" . $imagem . "', '". $link ."' ,'" . $ativo . "')";

							if ($conn->query($qry_slides) === TRUE) {
								$conn->commit();
								echo '{"succeed": true}';
							} else {
						        throw new Exception("Erro ao inserir o evento: " . $qry_slides . "<br>" . $conn->error);
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
							$errMsg .= "Titulo do Slide";
							$isValid = false;
						}					

						if(!isset($_POST["link"]) || empty($_POST["link"])) {
							$errMsg .= "Link do slide";
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

							    $pathImagem = "../../img/slides/" . ($_FILES['img']['name']);
							    

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

							$imagem = $_FILES['img']['name'];
							$nome = $_POST["nome"];						
							$link = $_POST["link"];
							$img = $_FILES["img"];
							$ativo = (isset($_POST["ativo"]) && $_POST["ativo"] == "on" ? "0" : "1");
							

							$qry_slides = "UPDATE banner 
											  SET nome = '" . $nome . "',
											      img = '". $imagem ."',
											      link = '" . $link . "',
											      ativo = " . $ativo . "
											WHERE id = $id";
							if ($conn->query($qry_slides) === TRUE) {
								$conn->commit();
								echo '{"succeed": true}';
							} else {
						        throw new Exception("Erro ao alterar o evento: " . $qry_slides . "<br>" . $conn->error);
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

				$qrydel_slides = "DELETE FROM banner WHERE id = $id";
				if ($conn->query($qrydel_slides) === TRUE) {
				
					$qrydelslides = "DELETE FROM banner WHERE id = $id";
					if ($conn->query($qrydelslides) === TRUE) {
						$conn->commit();
						echo '{"succeed": true}';
					} else {
				        throw new Exception("Erro ao remover o evento: " . $qrydelslides . "<br>" . $conn->error);
					}
				} else {
			        throw new Exception("Erro ao remover os times do evento: " . $qrydel_slides . "<br>" . $conn->error);
				}
			} catch(Exception $e) {
				$conn->rollback();

				echo '{"succeed": false, "errno": 27021, "title": "Erro ao salvar os dados!", "erro": "Ocorreu um erro ao salvar os dados: ' . $e->getMessage() . '"}';
			}
	        break;    
		}
	}
?>