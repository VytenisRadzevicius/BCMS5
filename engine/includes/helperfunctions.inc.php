<?php

function redirect($url = 'index.php') {
    if (!headers_sent()) {
        header('Location: ' . $url, true, 302);
    } else {
        echo <<<EOL
            <script type="text/javascript">
                window.location.href="$url";
            </script>
            <noscript>
                <meta http-equiv="refresh" content="0;url='$url'" />
            </noscript>
            EOL;
    }
    exit();
}