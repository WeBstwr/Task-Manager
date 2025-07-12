// Vanilla JavaScript for Task Manager

// DOM Content Loaded Event
document.addEventListener('DOMContentLoaded', function() {
    console.log('Task Manager loaded successfully');
    
    // Initialize the application
    initApp();
});

// Initialize the application
function initApp() {
    // Add event listeners
    addEventListeners();
    
    // Load initial data
    loadTasks();
}

// Add event listeners
function addEventListeners() {
    // Task form submission
    const taskForm = document.getElementById('task-form');
    if (taskForm) {
        taskForm.addEventListener('submit', handleTaskSubmit);
    }
    
    // Task deletion
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-task')) {
            handleTaskDelete(e);
        }
    });
    
    // Task completion toggle
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('task-complete')) {
            handleTaskToggle(e);
        }
    });
}

// Handle task form submission
function handleTaskSubmit(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const taskData = {
        title: formData.get('title'),
        description: formData.get('description'),
        priority: formData.get('priority'),
        due_date: formData.get('due_date')
    };
    
    // Here you would typically send to server
    console.log('Task data:', taskData);
    
    // For now, just add to local storage
    addTaskToStorage(taskData);
    
    // Reset form
    e.target.reset();
    
    // Reload tasks
    loadTasks();
}

// Handle task deletion
function handleTaskDelete(e) {
    const taskId = e.target.dataset.taskId;
    
    if (confirm('Are you sure you want to delete this task?')) {
        // Remove from storage
        removeTaskFromStorage(taskId);
        
        // Reload tasks
        loadTasks();
    }
}

// Handle task completion toggle
function handleTaskToggle(e) {
    const taskId = e.target.dataset.taskId;
    const isCompleted = e.target.checked;
    
    // Update task status in storage
    updateTaskStatus(taskId, isCompleted);
}

// Add task to local storage
function addTaskToStorage(taskData) {
    const tasks = getTasksFromStorage();
    const newTask = {
        id: Date.now(),
        ...taskData,
        completed: false,
        created_at: new Date().toISOString()
    };
    
    tasks.push(newTask);
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

// Get tasks from local storage
function getTasksFromStorage() {
    const tasks = localStorage.getItem('tasks');
    return tasks ? JSON.parse(tasks) : [];
}

// Remove task from storage
function removeTaskFromStorage(taskId) {
    const tasks = getTasksFromStorage();
    const filteredTasks = tasks.filter(task => task.id != taskId);
    localStorage.setItem('tasks', JSON.stringify(filteredTasks));
}

// Update task status
function updateTaskStatus(taskId, completed) {
    const tasks = getTasksFromStorage();
    const updatedTasks = tasks.map(task => {
        if (task.id == taskId) {
            task.completed = completed;
        }
        return task;
    });
    localStorage.setItem('tasks', JSON.stringify(updatedTasks));
}

// Load and display tasks
function loadTasks() {
    const tasks = getTasksFromStorage();
    const taskList = document.getElementById('task-list');
    
    if (!taskList) return;
    
    taskList.innerHTML = '';
    
    tasks.forEach(task => {
        const taskElement = createTaskElement(task);
        taskList.appendChild(taskElement);
    });
}

// Create task element
function createTaskElement(task) {
    const taskDiv = document.createElement('div');
    taskDiv.className = 'task-item card';
    taskDiv.innerHTML = `
        <div class="task-header">
            <input type="checkbox" class="task-complete" data-task-id="${task.id}" ${task.completed ? 'checked' : ''}>
            <h3 class="task-title ${task.completed ? 'completed' : ''}">${task.title}</h3>
            <button class="btn delete-task" data-task-id="${task.id}">Delete</button>
        </div>
        <p class="task-description">${task.description}</p>
        <div class="task-meta">
            <span class="priority priority-${task.priority}">${task.priority}</span>
            <span class="due-date">${task.due_date}</span>
        </div>
    `;
    
    return taskDiv;
}

// Utility function to show notifications
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
} 