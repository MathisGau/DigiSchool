<div class="sidebar">
    <div class="menu-item">
        <a href="">User</a>
    </div>
    <div class="menu-item">
        <a href="">Notes</a>
    </div>
    <div class="menu-item">
        <a href="">Statistiques</a>
    </div>
</div>

<style>
    .sidebar {
        width: 20%;
        height: 100vh;
        background-color: grey;
        display: flex;
        flex-direction: column;
    }

    .sidebar .menu-item {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.5s;
    }

    .sidebar .menu-item a {
        text-decoration: none;
        color: white;
        font-family: 'Roboto', sans-serif;
    }

    .sidebar .menu-item:hover {
        background-color: darkgrey;
    }
</style>
