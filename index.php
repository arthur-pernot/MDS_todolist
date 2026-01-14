<?php
/**
 * Task List Parser and Viewer
 */

function parseTasksFile(string $filename): array {
    $tasks = [];

    if (!file_exists($filename)) {
        return $tasks;
    }

    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $parts = explode('|', $line);

        if (count($parts) !== 5) {
            continue;
        }

        $id = $parts[0];
        $title = $parts[1];
        $desc = $parts[2];
        $state = $parts[3];
        $date = $parts[4];

        array_push($tasks, [
            'id' => $id,
            'title' => $title,
            'desc' => $desc,
            'state' => $state,
            'date' => $date
        ]);
    }

    return $tasks;
}

$tasks = parseTasksFile('tasks.txt');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <style>
        body {
            font-family: system-ui, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 1rem;
            background: #f5f5f5;
        }

        h1 {
            margin-bottom: 1.5rem;
        }

        .task {
            background: white;
            border: 1px solid #ddd;
            border-left: 4px solid #666;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .task.completed { border-left-color: #28a745; }
        .task.pending { border-left-color: #6c757d; }

        .task-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .task-title {
            font-weight: bold;
            font-size: 1.1rem;
        }

        .task-id {
            color: #888;
            font-size: 0.9rem;
        }

        .task-desc {
            color: #555;
            margin-bottom: 0.75rem;
        }

        .task-footer {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
        }

        .badge {
            padding: 0.2rem 0.6rem;
            border-radius: 3px;
            font-size: 0.75rem;
            text-transform: uppercase;
        }

        .badge.completed { background: #d4edda; color: #155724; }
        .badge.pending { background: #e9ecef; color: #495057; }

        .task-date {
            color: #666;
        }

        .empty {
            text-align: center;
            color: #888;
            padding: 2rem;
        }
    </style>
</head>
<body>
    <h1>Task Manager</h1>
    <p><?= count($tasks) ?> tasks</p>

    <?php if (empty($tasks)): ?>
        <div class="empty">No tasks found in tasks.txt</div>
    <?php endif; ?>


    <?php foreach ($tasks as $task): ?>
        <div class="task <?= $task['state'] ?>">
            <div class="task-header">
                <span class="task-title"><?= $task['title'] ?></span>
                <span class="task-id">#<?= $task['id'] ?></span>
            </div>
            <div class="task-desc"><?= $task['desc'] ?></div>
            <div class="task-footer">
                <span class="badge <?= $task['state'] ?>">
                    <?= $task['state'] ?>
                </span>
                <span class="task-date"><?= $task['date'] ?></span>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
