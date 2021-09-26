<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    <div class="bg-success p-2 text-dark bg-opacity-25">
        <h1>Csp Playground</h1>
        <input class="btn btn-primary" type="submit" name="submit" value="TEST" onclick="javascript:doTest()" />
        <br>
        <br>

        <a href='https://report-uri.com/home/generate' target='_blank'>To build CSP directive with UI</a>
        <script>
            function sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            }

            async function reload() {
                await sleep(1000);
                clickTagInIframe("violationframe", "reload")
            }

            function clickTagInIframe(iframeRef, tagRef) {
                var frame = document.getElementById(iframeRef);
                var MyIFrameDoc = (frame.contentWindow || frame.contentDocument);
                if (MyIFrameDoc.document) MyIFrameDoc = MyIFrameDoc.document;

                MyIFrameDoc.getElementById(tagRef).click();
            }

            function submitFormInFrame(iframeRef, tagForm) {
                var frame = document.getElementById(iframeRef);
                var MyIFrameDoc = (frame.contentWindow || frame.contentDocument);
                if (MyIFrameDoc.document) MyIFrameDoc = MyIFrameDoc.document;

                MyIFrameDoc.getElementById(tagForm).submit();
            }

            function doTest() {
                submitFormInFrame("testframe", "form")
                reload();
            }
        </script>
    </div>
    <div class="container  m-0">
        <div class="row">
            <div class="col-7 p-0 m-0">
                <iframe style='height:700px;width:100%' id="testframe" src="http://0.0.0.0:8080/test.php"></iframe>
            </div>
            <div class="col-5 p-0 m-0">
                <iframe style='height:700px;width:100%' id="violationframe" src="http://0.0.0.0:8080/getViolations.php"></iframe>
            </div>
        </div>
    </div>
</body>

</html>