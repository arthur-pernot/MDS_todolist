<?php
/**
 * Task List Parser and Viewer
 */

// Handle POST request to delete a task
// Check if this is a POST request AND has a delete_id field
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    // Get the ID of the task to delete from the form
    $deleteId = $_POST['delete_id'];

    // Read all lines from the tasks file
    $lines = file('tasks.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Filter out the line with the matching ID
    $newLines = [];
    foreach ($lines as $line) {
        $parts = explode('|', $line);
        if ($parts[0] !== $deleteId) {
            $newLines[] = $line;  // Keep lines that don't match
        }
    }

    // Write the remaining lines back to the file
    file_put_contents('tasks.txt', implode("\n", $newLines) . "\n");

    // Redirect back to this same page (Post/Redirect/Get pattern)
    // This sends an HTTP 302 redirect header to the browser, telling it
    // to make a new GET request to the same URL. This prevents the browser
    // from re-submitting the form if the user refreshes the page.
    // Preserve query string (e.g. ?hide_completed=1) so filters stay active
    $query = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
    header('Location: ' . $_SERVER['PHP_SELF'] . $query);
    exit;  // Stop script execution - the browser will reload the page
}

// Handle POST request to add a task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['title'])) {
    // Read existing tasks to find the highest ID
    $tasks = file('tasks.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $lastId = 0;
    foreach ($tasks as $line) {
        $parts = explode('|', $line);
        if (!empty($parts[0]) && is_numeric($parts[0])) {
            $lastId = max($lastId, (int)$parts[0]);
        }
    }

    // Generate new ID
    $newId = $lastId + 1;

    // Sanitize input: replace pipe characters to avoid breaking the format
    $title = str_replace('|', '-', $_POST['title']);
    $desc = str_replace('|', '-', $_POST['desc'] ?? '');

    // Set today's date
    $date = date('Y-m-d');

    // Format: id|title|desc|state|date|priority
    $newLine = "$newId|$title|$desc|pending|$date|1\n";

    // Append the new task to the file
    file_put_contents('tasks.txt', $newLine, FILE_APPEND);

    // Redirect to prevent form resubmission on refresh
    // Preserve query string so filters stay active
    $query = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
    header('Location: ' . $_SERVER['PHP_SELF'] . $query);
    exit;
}

function parseTasksFile(string $filename): array {
    $tasks = [];

    if (!file_exists($filename)) {
        return $tasks;
    }

    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $parts = explode('|', $line);

        if (count($parts) !== 6) {
            continue;
        }

        $id = $parts[0];
        $title = $parts[1];
        $desc = $parts[2];
        $state = $parts[3];
        $date = $parts[4];
        $priority = (int)$parts[5];

        array_push($tasks, [
            'id' => $id,
            'title' => $title,
            'desc' => $desc,
            'state' => $state,
            'date' => $date,
            'priority' => $priority
        ]);
    }

    return $tasks;
}

$tasks = parseTasksFile('tasks.txt');

// Check if "hide completed" filter is active (from URL parameter)
// When the checkbox is checked, the form submits ?hide_completed=1
$hideCompleted = isset($_GET['hide_completed']) && $_GET['hide_completed'] === '1';

// Filter tasks if "hide completed" is enabled
if ($hideCompleted) {
    // Keep only tasks where state is NOT "completed"
    $tasks = array_filter($tasks, function($task) {
        return $task['state'] !== 'completed';
    });
}
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

        .task.priority-3 { border-left-color: #ef4444; }
        .task.priority-2 { border-left-color: #f59e0b; }
        .task.priority-1 { border-left-color: #3b82f6; }
        .task.priority-0 { border-left-color: #9ca3af; }

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

        .delete-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 0.2rem 0.5rem;
            cursor: pointer;
            font-size: 0.75rem;
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

    <!-- Form to add a new task -->
    <form method="POST" style="background: white; padding: 1rem; margin-bottom: 1.5rem; border: 1px solid #ddd;">
        <input type="text" name="title" placeholder="Task title" required style="padding: 0.5rem; width: 200px;">
        <input type="text" name="desc" placeholder="Description" style="padding: 0.5rem; width: 300px;">
        <button type="submit" style="padding: 0.5rem 1rem; cursor: pointer;">Add Task</button>
    </form>

    <!-- Filter: checkbox to hide completed tasks -->
    <!-- Uses GET method so the filter state is preserved in the URL -->
    <form method="GET" style="margin-bottom: 1rem;">
        <label style="cursor: pointer;">
            <input
                type="checkbox"
                name="hide_completed"
                value="1"
                <?= $hideCompleted ? 'checked' : '' ?>
                onchange="this.form.submit()"
            >
            Hide completed tasks
        </label>
    </form>

    <p><?= count($tasks) ?> task<?= count($tasks) !== 1 ? 's' : '' ?></p>

    <?php if (empty($tasks)): ?>
        <div class="empty">No tasks found in tasks.txt</div>
    <?php endif; ?>


    <?php foreach ($tasks as $task): ?>
        <div class="task priority-<?= $task['priority'] ?>">
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
                <form method="POST" style="margin:0;">
                    <input type="hidden" name="delete_id" value="<?= $task['id'] ?>">
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
