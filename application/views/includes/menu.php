<nav class="menu">
    <ul>
        <li class="<?= $this->currentArea == "dashboard" ? 'active' : '' ?>">
            <div>
                <a href="<?= base_url(); ?>">Home</a>
            </div>
        </li>
        <li class="<?= $this->currentArea == "conta" ? 'active' : '' ?>">
            <div>
                <a href="<?= base_url('conta'); ?>">Contas</a>
            </div>
        </li>
        <li>
            <div>
                <a href="<?= base_url('sair'); ?>">Sair</a>
            </div>
        </li>
    </ul>
</nav>