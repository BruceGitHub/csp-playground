<?php
$log_file = dirname(__FILE__) . '/csp-violations.log';

if (isset($_GET['p']) && $_GET['p'] === 'del') {
    file_put_contents($log_file, '');
}

$violations = \file_get_contents($log_file);
$violations = str_replace('##', ',', $violations);
$start = '{"Last validations": "' . date('d-m-y h:m:s') . '","Violations number":"0"}';
$violationsJson = "[$violations $start]";
$violationsSlot = json_decode($violationsJson);
$violationsSlot = array_reverse($violationsSlot);
$violationsSlot[0]->{"Violations number"} = \count($violationsSlot) - 1;
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
<script>
    function emptyHandler() {
        fetch('http://0.0.0.0:8080/getViolations.php?p=del')
        reloadHandler()
    }

    function reloadHandler() {
        self.location.reload();
    }
</script>
<div class="container m-0">
    <div class="row">
        <div class="col">
            <hr class="my-2"/>
            <input class="btn btn-outline-primary" type='button' value="Reload" id="reload"
                   onclick="javascript:reloadHandler()"/>
            <input class="btn btn-outline-primary" type='button' value="Empty log" id="empty"
                   onclick="javascript:emptyHandler()"/>
            <hr class="my-2"/>
            <?php
            foreach ($violationsSlot as $v) {
                echo '<div class="card  text-white bg-danger mb-3""><div class="card-body">';
                foreach ($v as $k => $val) {
                    echo "<span style='font-weight: bold'>$k: </span> $val<br> ";
                }
                echo "</div></div><br>";
            }
            ?>
        </div>
    </div>
</div>
</body>

</html>
