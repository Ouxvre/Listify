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
                const taskContainer = document.querySelector('.task-container');
                const newTask = document.createElement('div');
                newTask.classList.add('task-box');

                // Default warna bar (kuning, karena belum tahu deadline vs sekarang)
                newTask.innerHTML = `
                    <div class="task-bar yellow"></div>
                    <div class="task-content">
                        <h4>${data.title}</h4>
                        <p>${data.task}</p>
                        <small>${data.deadline}</small>
                    </div>
                    <div class="task-actions">
                        <button class='star-btn'>☆</button>

                        <form method='POST' action='includes/completed.php' style='display:inline;'>
                            <input type='hidden' name='task_id' value='${data.id}'>
                            <input type='checkbox' name='complete_task' onchange='this.form.submit()'>
                        </form>

                        <form method='POST' action='includes/delete.php' style='display:inline;'>
                            <input type='hidden' name='task_id' value='${data.id}'>
                            <button type='button' class='delete-btn' data-id='${data.id}'>❌</button>
                        </form>
                    </div>
                `;

                taskContainer.appendChild(newTask);

                // Kosongkan input setelah submit
                document.getElementById('title-input').value = '';
                document.getElementById('task-input').value = '';
                document.getElementById('date-input').value = '';
            } else {
                alert("Gagal menambahkan task.");
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});


// Delegasi event supaya juga bekerja untuk elemen yang ditambahkan via JS
document.querySelector('.task-container').addEventListener('click', function (e) {
    if (e.target.classList.contains('delete-btn')) {
        e.preventDefault();
        const taskBox = e.target.closest('.task-box');
        const taskId = e.target.dataset.id;

        if (confirm("Yakin ingin menghapus task ini?")) {
            fetch('../includes/delete.php', {
                method: 'POST',
                body: new URLSearchParams({
                    'task_id': taskId,
                    'delete_task': true
                })
            })
            .then(response => response.text())
            .then(data => {
                // Hapus task dari tampilan
                taskBox.remove();
            })
            .catch(err => console.error("Gagal hapus:", err));
        }
    }
});
