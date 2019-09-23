<?php
require __DIR__ . '/vendor/autoload.php';

$upload = new \CoffeeCode\Uploader\File('storage', 'files');
$files = $_FILES;

if (!empty($files['file'])) {
    $file = $files['file'];
    if (empty($file['type']) || !in_array($file['type'], $upload::isAllowed())) {
        echo "<p>Selecione um Arquivo valido!!</p>";
    } else {
        $uploaded = $upload->upload($file, pathinfo($file['name'], PATHINFO_FILENAME));
        echo "<a href=".$uploaded.">Acessar arquivo</a>";
    }
//    dump($file);
}

?>
<!--PARANDO NA VALIDAÇAO E ENVIDO DOS FILES-->
<form method="post" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
    <h2>More images</h2>
    <input type="file" name="file"/>
    <button>Enviar</button>
</form>
