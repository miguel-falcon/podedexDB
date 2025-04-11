document.getElementById('pokemonForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const id = document.getElementById('pokemonId').value;
    const name = document.getElementById('pokemonName').value;
    const type = document.getElementById('pokemonType').value;
    const level = document.getElementById('pokemonLevel').value;

    const action = id ? 'update' : 'create';

    fetch('controllers/PokemonController.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ action, id, name, type, level }),
    }).then(() => {
        loadPokemon();
        document.getElementById('pokemonForm').reset();
    });
});

function loadPokemon() {
    fetch('controllers/PokemonController.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ action: 'read' }),
    })
        .then(res => res.json())
        .then(data => {
            const list = document.getElementById('pokemonList');
            list.innerHTML = '';
            data.forEach(pokemon => {
                const li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between align-items-center';
                li.innerHTML = `
                    ${pokemon.name} (Type: ${pokemon.type}, Level: ${pokemon.level})
                    <div>
                        <button class="btn btn-sm btn-warning" onclick="editPokemon(${pokemon.id}, '${pokemon.name}', '${pokemon.type}', ${pokemon.level})">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deletePokemon(${pokemon.id})">Delete</button>
                    </div>
                `;
                list.appendChild(li);
            });
        });
}

function editPokemon(id, name, type, level) {
    document.getElementById('pokemonId').value = id;
    document.getElementById('pokemonName').value = name;
    document.getElementById('pokemonType').value = type;
    document.getElementById('pokemonLevel').value = level;
}

function deletePokemon(id) {
    fetch('../controllers/PokemonController.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ action: 'delete', id }),
    }).then(() => loadPokemon());
}

loadPokemon();