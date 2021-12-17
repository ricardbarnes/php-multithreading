<?php

$tasks = [
    function () {
        echo 'This is closure 1' . PHP_EOL;
    },
    function () {
        echo 'This is closure 2' . PHP_EOL;
    },
    function () {
        echo 'This is closure 3' . PHP_EOL;
    }
];

foreach ($tasks as $task) {
    $pid = pcntl_fork();

    if ($pid == -1) {
        exit("Error forking...\n");
    } else if ($pid == 0) {
        $task();
        exit();
    }
}

// This while loop holds the parent process until all the child threads are complete,
// at which point the script continues to execute.
while (pcntl_waitpid(0, $status) != -1) {
    echo 'Do something after all the parallel tasks are complete' . PHP_EOL;
}
