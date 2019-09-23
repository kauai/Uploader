<?php
require __DIR__ . '/vendor/autoload.php';

$upload = new \CoffeeCode\Uploader\Media('storage', 'files');
$files = $_FILES;

//No meu caso precisei sobrecrever a classe
//adicionando "application/x-zip-compressed" mime-types

if (!empty($files['file'])) {
    $file = $files['file'];
    if (empty($file['type']) || !in_array($file['type'], $upload::isAllowed())) {
        echo "<p>Selecione um Arquivo valido!!</p>";
    } else {
        $uploaded = $upload->upload($file, pathinfo($file['name'], PATHINFO_FILENAME));
        echo "<a href=".$uploaded.">Acessar arquivo</a>";
    }

}

//VALIDANDO TAMANHO DA MEDIA!! ESTOURANDO O PHP
$sended = filter_input(INPUT_GET,'sended',FILTER_VALIDATE_BOOLEAN);
if($sended && empty($files['file'])){
   echo "Selecione uma media de até 10mega";
}

?>

<form method="post" action="<?= $_SERVER['PHP_SELF'] ?>?sended=true" enctype="multipart/form-data">
    <h2>More images</h2>
    <input type="file" name="file"/>
    <button>Enviar</button>
</form>
