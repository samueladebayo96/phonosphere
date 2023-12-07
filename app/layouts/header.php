<nav
    class="flex flex-col items-center p-6 mb-8 bg-secondary md:flex-row md:justify-between md:px-6 md:py-6 md:mb-0 md:sticky md:top-0 md:w-full">
    <div class="flex items-center text-center gap-2 mb-6 md:mb-0">
        <a href="./"><img src="../assets/img/logo.svg" alt="logo" class="max-w-logo min-w-logo"></a>
        <div class="text-center">
            <h1 class="text-2xl font-bold">Phonosphere</h1>
        </div>
    </div>
    <ul class="text-center font-semibold md:flex md:flex-row md:gap-8">
        <?php if(!isset($_SESSION["user_id"])): ?>
            <li class="mb-2 md:mb-0"><a href="./home">Accueil</a></li>
            <li class="mb-2 md:mb-0"><a href="./login">Connexion</a></li>
        <?php else: ?>
            <li class="mb-2 md:mb-0"><a href="./home">Accueil</a></li>
            <li class="mb-2 md:mb-0"><a href="./profile">Profile</a></li>
            <li class="mb-2 md:mb-0"><a href="./contacts">Contacts</a></li>
            <li class="mb-2 md:mb-0"><a href="./logout">Déconnexion</a></li>
        <?php endif; ?>
    </ul>
</nav>