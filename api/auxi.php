<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST;
    $input_json = json_encode($input);

    $descriptorspec = [
        0 => ["pipe", "r"],
        1 => ["pipe", "w"],
        2 => ["pipe", "w"]
    ];
    $python_path = "C:\\Users\\diego\\AppData\\Local\\Programs\\Python\\Python313\\python.exe";
    $process = proc_open("$python_path " . __DIR__ . "/predict.py", $descriptorspec, $pipes);

    if (is_resource($process)) {
        fwrite($pipes[0], $input_json);
        fclose($pipes[0]);

        $output = stream_get_contents($pipes[1]);
        fclose($pipes[1]);

        $error = stream_get_contents($pipes[2]);
        fclose($pipes[2]);

        proc_close($process);

        header('Content-Type: application/json');
        if ($output) {
            echo $output;
        } else {
            echo json_encode([
                "error" => "Python no devolvió salida",
                "stderr" => $error,
                "input" => $input
            ]);
        }
    }
}
?>