<x-my>
    <h1 class="text-2xl font-bold">Your tasks:</h1>
    <button id="new">New task</button>
    <div id="tasks"></div>

    <script>
        async function init() {
            await read();
            const elNew = document.getElementById('new');
            elNew.addEventListener('click', create);
        }

        window.addEventListener('load', init);

        async function read() {
            const tasks = await POST('tasks/read');
            console.log(tasks);
            const cont = document.getElementById('tasks');
            cont.innerHTML = '';
            tasks.forEach(task => render(task));
        }


        async function create() {
            const task = await POST('tasks/create');
            render(task);
        }

        async function save(id, text) {
            await POST('tasks/save', {
                id: id,
                text: text,
            });
        }

        async function remove(id, el) {
            await POST('tasks/delete', {
                id: id
            });

            el.remove();
        }

        function render(task) {
            const cont = document.getElementById('tasks');

            const elTask = document.createElement('div');
            cont.appendChild(elTask);
            elTask.className = "task";

            const elText = document.createElement('input');
            elTask.appendChild(elText);
            elText.className = "text";
            elText.value = task.text;

            const elSave = document.createElement('button');
            elTask.appendChild(elSave);
            elSave.className = "save";
            elSave.innerText = "save";

            function saved() {
                elSave.disabled = true;
            }

            saved();

            function not_saved() {
                elSave.disabled = false;
            }


            elText.addEventListener('input', () => {
                not_saved();
            });

            elText.focus();

            let id = task.id;

            elSave.addEventListener('click', () => {
                saved();
                save(id, elText.value);
            });

            const elDelete = document.createElement('button');
            elTask.appendChild(elDelete);
            elDelete.className = "delete";
            elDelete.innerText = "delete";
            elDelete.addEventListener('click', () => {
                remove(id, elTask);
            });
        }

        async function POST(url, body) {
            const request = {
                method: 'POST',
                body: body ? JSON.stringify(body) : undefined,
                headers: {
                    'Content-type': 'application/json; charset=UTF-8',
                    'X-CSRF-Token': document.querySelector('input[name="_token"]').value
                }
            }

            const response = await fetch(url, request);
            const data = await response.json();

            return data;
        }

    </script>
</x-my>
