
const apiUrl = 'http://your-app-url/api';

async function createTask(token, taskData) {
    try {
        const response = await fetch(`${apiUrl}/tasks`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`,
            },
            body: JSON.stringify(taskData),
        });

        if (!response.ok) {
            throw new Error('Failed to create task');
        }

        const data = await response.json();
        console.log('Task created successfully:', data);
        return data;
    } catch (error) {
        console.error('Error creating task:', error.message);
    }
}


async function getUserTasks(token, doneFilter = null) {
    try {
        const url = doneFilter ? `${apiUrl}/tasks?done=${doneFilter}` : `${apiUrl}/tasks`;

        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
            },
        });

        if (!response.ok) {
            throw new Error('Failed to fetch tasks');
        }

        const data = await response.json();
        console.log('Tasks retrieved successfully:', data.tasks);
        return data.tasks; // Return the list of tasks
    } catch (error) {
        console.error('Error fetching tasks:', error.message);
    }
}

// Function to create multiple tasks
async function createMultipleTasks(token, tasksData) {
    try {
        const response = await fetch(`${apiUrl}/tasks/multiple`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`,
            },
            body: JSON.stringify({ tasks: tasksData }), // Send array of tasks
        });

        if (!response.ok) {
            throw new Error('Failed to create multiple tasks');
        }

        const data = await response.json();
        console.log('Multiple tasks created successfully:', data);
        return data.tasks; // Return the created tasks
    } catch (error) {
        console.error('Error creating multiple tasks:', error.message);
    }
}

// Example of how to use the functions

// Create a single task
const taskData = {
    name: 'New Task',
    done: false,
};
createTask(userToken, taskData);

// Get all tasks for the user
getUserTasks(userToken); // Fetch all tasks
getUserTasks(userToken, true); // Fetch only tasks where "done" is true

// Create multiple tasks
const tasksData = [
    { name: 'Task 1', done: false },
    { name: 'Task 2', done: true },
    { name: 'Task 3', done: false },
];
createMultipleTasks(userToken, tasksData);
