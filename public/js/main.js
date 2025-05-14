document.getElementById('add-task').addEventListener('click', function(e) {
    e.preventDefault();

    const title = document.getElementById('title-input').value;
    const task = document.getElementById('task-input').value;
    const deadline = document.getElementById('date-input').value;

    if (title && task && deadline) {
        fetch('../includes/add_task.php', {
            method: 'POST',
            body: new URLSearchParams({
                'title': title,
                'task': task,
                'deadline': deadline
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Tambahkan task baru ke list tanpa reload
                const taskContainer = document.querySelector('.task-container');
                const newTask = document.createElement('div');
                newTask.classList.add('task-box');
                newTask.innerHTML = `
                    <h4>${data.title}</h4>
                    <p>${data.task}</p>
                    <small>Due: ${data.deadline}</small>
                `;
                taskContainer.appendChild(newTask);

                // Kosongkan input setelah submit
                document.getElementById('title-input').value = '';
                document.getElementById('task-input').value = '';
                document.getElementById('date-input').value = '';
            }
        });
    }
});