<p>
    <a href="index.php">Назад</a>
</p>
<h3>Задание</h3>
<ol>
    <li>
Зарегистрируйте почтовый ящик на яндексе или ином почтовом сервисе.
    </li>
    <li>
Отправьте письмо с помощью SwiftMailer через SMTP.
    </li>
</ol>
<br>
<br>
<br>
<form enctype="multipart/form-data" action="send-mail" method="post">
    Отправить почтовое сообщение:
<br>
<br>
    <fieldset style="display: inline-block">
        <table>
            <tr>
                <td>
                    <label for="sender">Отправитель:</label>
                </td>
                <td>
                    <input type="email" disabled id="sender" name="sender" value="<?=ADMIN_EMAIL?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="recipient">Получатель:</label>
                </td>
                <td>
                    <input type="email" autofocus placeholder="email получателя" id="recipient" name="recipient">
                </td>
            </tr>
        </table><br>
        <label for="theme">Тема сообщения:</label>
        <input type="text" style="width: 470px;" id="theme" name="theme">
        <br><br>
        Текст сообщения:<br>
        <textarea style="width: 610px; height: 160px; min-width: 300px; min-height: 60px;" name="message" ></textarea>
        <br><br>
        Прикрепить вложение:
        <input type="file" name="attachment" /><br><br>
    </fieldset>
    <p><input type="submit" value="Отправить"></p>
</form>