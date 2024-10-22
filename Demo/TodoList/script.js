const taskInput = document.getElementById('taskInput');
const addTaskBtn = document.getElementById('addTask');
const taskList = document.getElementById('taskList');
let tasks = JSON.parse(localStorage.getItem('tasks')) || [];

function renderTasks() {
    taskList.innerHTML = '';
    tasks.forEach((task, index) => {
        const li = document.createElement('li');
        li.innerHTML = `
            <div class="task-checkbox ${task.completed ? 'checked' : ''}" onclick="toggleTask(${index})">${task.completed ? '✓' : ''}</div>
            <span class="task-text ${task.completed ? 'completed' : ''}">${task.text}</span>
            <button class="edit-btn" onclick="editTask(${index})">✏️</button>
            <button class="delete-btn" onclick="deleteTask(${index})">×</button>
        `;
        taskList.appendChild(li);
    });
    saveTasks();
}

function addTask() {
    const taskText = taskInput.value.trim();
    if (taskText) {
        tasks.push({ text: taskText, completed: false });
        taskInput.value = '';
        renderTasks();
    }
}

function toggleTask(index) {
    tasks[index].completed = !tasks[index].completed;
    renderTasks();
}

function editTask(index) {
    const newText = prompt("Edit task:", tasks[index].text);
    if (newText !== null) {
        tasks[index].text = newText.trim();
        renderTasks();
    }
}

function deleteTask(index) {
    tasks.splice(index, 1);
    renderTasks();
}

function saveTasks() {
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

addTaskBtn.addEventListener('click', addTask);

taskInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') addTask();
});

renderTasks();