<?php
use Intervention\Image\ImageManagerStatic as Image;

$btnIsClicked = isset($_REQUEST['submitIsClicked']);

if ($btnIsClicked) {
    if (!empty($_FILES['attachment']['tmp_name'])) {
        $uploadImage['file_name'] = $_FILES['attachment']['name'];
        $uploadImage['file'] = $_FILES['attachment']['tmp_name'];

        if (in_array(mime_content_type($uploadImage['file']), IMAGE_TYPES)) {
            $source = $uploadImage['file'];
            $result = "../images/" . $uploadImage['file_name'];
            $image = Image::make($source)
                ->resize(200, null, function ($image) {
                    $image->aspectRatio();
                })
                ->insert("../images/vk-32.png", "bottom-right")
                ->save($result, 90);

            $imgbinary = fread(fopen($result, "r"), filesize($result));

        } else {
            echo "Загруженный файл не является картинкой.";
        }
    } else {
        echo '<a href="image">Назад</a><br><br>Файл для загрузки не выбран.';
        die;
    }
}
?>

<p>
    <a href="index.php">Назад</a>
</p>
<h3>Задание</h3>
<ol>
    <li>
        Возьмите любую картинку. Нанесите ватермарк на изображение. Измените размер до ширины 200 с сохранением пропорций изображения.
    </li>
</ol>
<br>
<br>
<form enctype="multipart/form-data" action="image" method="post">
    Загрузить картинку:
    <input type="file" name="attachment" /><br><br>
    <input type="submit" name="submitIsClicked" value="Отправить">
</form>
<br><br>

<?php if ($btnIsClicked): ?>
<img src="<?= 'data:image/' . 'png' . ';base64,' . base64_encode($imgbinary); ?>"/><br>
    <?= $uploadImage['file_name'] ?>
<?php else: ?>
Здесь будет отображаться загруженная картинка<br>
<img src="images/image-placeholder-transparent.jpg"/>
<?php endif ?>