<x-app-layout>

    <div class="flex justify-center p-6 text-zinc-900 dark:text-white">

        <div x-data="{ list: [], newTask: '' }"
            class="w-full max-w-lg p-6 transition-all bg-white rounded-lg shadow-md dark:bg-zinc-800">

            <h1 class="mb-2 text-2xl font-bold">Hello {{ Auth::user()->name }}! 👋</h1>
            <h6 class="mb-4 font-extralight text-md">Here's your Todo List</h6>

            <!-- Input Field -->
            <div class="flex items-center space-x-2">
                <input type="text" x-model="newTask" placeholder="Type what you need to do..."
                    class="w-full p-2 bg-white border rounded-lg text-zinc-900 border-zinc-300 focus:outline-none focus:ring focus:ring-purple-300 dark:bg-zinc-700 dark:text-white dark:border-zinc-600"
                    @keyup.enter="if(newTask.trim()) { list.push(newTask); newTask = '' }">
                <button type="button"
                    class="px-4 py-2 text-white transition bg-purple-600 rounded-lg hover:bg-purple-700"
                    @click="if(newTask.trim()) { list.push(newTask); newTask = '' }">
                    ➕
                </button>
            </div>

            <!-- Task List -->
            <ul class="mt-4 space-y-2">
                <template x-for="(task, index) in list" :key="index" x-transition>
                    <li class="flex items-center justify-between p-2 rounded-lg text-zinc-900 bg-zinc-100 dark:bg-zinc-700 dark:text-white"
                        x-data="{ done: false }">
                        <span x-text="task"
                            :class="done ? 'line-through opacity-50' :
                                ''"></span>
                        <div>
                            <button class="mr-2 text-red-500 hover:text-red-700" @click="done = !done">✔</button>
                            <button class="text-red-500 hover:text-red-700" @click="list.splice(index, 1)">✖</button>
                        </div>

                    </li>
                </template>
            </ul>

        </div>

    </div>
</x-app-layout>
