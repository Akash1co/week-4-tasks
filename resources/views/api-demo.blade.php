<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Integration Demo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-8 bg-gray-100">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">API Tasks Consumer</h1>
        <div class="flex gap-2 mb-4">
            <input type="text" id="taskTitle" placeholder="New Task Title" class="border p-2 flex-1 rounded">
            <button onclick="createTask()" class="bg-blue-600 text-white px-4 py-2 rounded">Add Task</button>
        </div>
        <ul id="taskList" class="divide-y"></ul>
    </div>

    <script>
        const apiBase = '/api/tasks';

        async function fetchTasks() {
            const res = await fetch(apiBase);
            const json = await res.json();
            const list = document.getElementById('taskList');
            list.innerHTML = json.data.map(item => `
                <li class="py-2 flex justify-between items-center">
                    <span>${item.title}</span>
                    <button onclick="deleteTask(${item.id})" class="text-red-500 font-bold">Delete</button>
                </li>
            `).join('');
        }

        async function createTask() {
            const title = document.getElementById('taskTitle').value;
            if(!title) return;
            await fetch(apiBase, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ title: title, content: 'Created via Fetch API' })
            });
            document.getElementById('taskTitle').value = '';
            fetchTasks();
        }

        async function deleteTask(id) {
            await fetch(`${apiBase}/${id}`, { method: 'DELETE' });
            fetchTasks();
        }

        fetchTasks();
    </script>
</body>
</html>