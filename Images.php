<?php
require __DIR__ . '/vendor/autoload.php';
//$upload = new \CoffeeCode\Uploader\Media('storage','medias');
//$upload = new \CoffeeCode\Uploader\File('storage','files');
//$upload = new \CoffeeCode\Uploader\Send('storage','send',['']);

$upload = new \CoffeeCode\Uploader\Image('storage', 'images');
$files = $_FILES;
if (!empty($files['image'])) {
    $file = $files['image'];
    if (empty($file['type']) || !in_array($file['type'], $upload::isAllowed())) {
        echo "<p>Selecione uma imagem valida!!</p>";
    } else {
        $uploaded = $upload->upload($file, pathinfo($file['name'], PATHINFO_FILENAME), '350');
        echo "<img src=" . $uploaded . "/>";
    }
}

?>

<form method="post" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
    <h2>Single Image</h2>
    <input type="file" name="image"/>
    <button>Enviar</button>
</form>

<?php

if (!empty($files['images'])) {
    $vetor = [];
    $images = $files['images'];

    for ($i = 0; $i < count($images['name']); $i++) {
        foreach (array_keys($images) as $item) {
            $imageFiles[$i][$item] = $images[$item][$i];
        }
    }
    foreach ($imageFiles as $file) {
        if (empty($file['type'])) {
            echo "<p>Selecione uma imagem valida!!</p>";
        } elseif (!in_array($file['type'], $upload::isAllowed())) {
            echo "<p>O arquivo {$file['name']} nao é uma imagem valida</p>";
        } else {
            $uploaded = $upload->upload($file, pathinfo($file['name'], PATHINFO_FILENAME), '350');
            echo "<img src=" . $uploaded . "/>";
        }
    }


//    for ($i = 0; $i < count($images); $i++) {
////         var_dump(array_keys($images)[$i],$images[array_keys($images)[$i]]);
//         foreach ($images[array_keys($images)[$i]]  as $indice => $item) {
//            $vetor[$indice][array_keys($images)[$i]] = $item;
//         }
//    }
//    var_dump($vetor);
}
?>
<!--PARANDO NA VALIDAÇAO E ENVIDO DOS FILES-->
<form method="post" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
    <h2>More images</h2>
    <input accept="image/jpeg, image/jpg, image/png" type="file" name="images[]" multiple/>
    <button>Enviar</button>
</form>
