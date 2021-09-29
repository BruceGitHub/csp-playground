<?php
if (isset($_POST['header'])) {
    $valHeaders = str_replace(PHP_EOL, '', $_POST['header']);
    $valHeaders = str_replace(PHP_EOL, '', $valHeaders);
    $vals2 = explode("\n", str_replace(["\r\n", "\n\r", "\r"], "\n", $valHeaders));

    $vals = [];
    $vals[] = 'Content-Security-Policy-Report-Only: ';
    $vals[] = "report-uri http://0.0.0.0:8080/report.php;";
    $csp = '';

    foreach ($vals as $v) {
        $csp .= $v;
    }

    foreach ($vals2 as $v) {
        $csp .= $v;
    }


    header($csp);
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php if (isset($_POST['head'])) echo ($_POST['head']); ?>
</head>

<body>
    <form method="POST" id="form">
        <h3>Header (es: script-src 'none';) </h3>
        <textarea rows="10" cols="88" name='header'><?php if (isset($_POST['header'])) echo ($_POST['header']); ?></textarea>

        <h3>Tag Head (es: &lt;script nonce='AABBCCDD'&gt;foo(); &lt;/script&gt;)</h3>
        <textarea rows="10" cols="88" name='head'><?php if (isset($_POST['head'])) echo ($_POST['head']); ?></textarea>

        <h3>Tag Body (Some html tag)</h3>
        <textarea rows="10" cols="88" name='body'><?php if (isset($_POST['body'])) echo ($_POST['body']); ?></textarea>
        <br>
        <?php if (isset($_POST['body'])) echo ($_POST['body']); ?>
    </form>
</body>

</html>
