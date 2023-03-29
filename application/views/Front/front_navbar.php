<nav class="navbar fixed-top">

    <div class="d-flex align-items-center navbar-left">
    </div>


    <a class="navbar-logo" href="<?= base_url() ?>">
        <h1>Servicios de Solución</h1>
    </a>

    <div class="navbar-right">
        <div class="header-icons d-inline-block align-middle">
            <div class="input-group">
                <input type="number" class="form-control typeahead" id="searchProject" placeholder="Ingrese la identificación del proyecto ... " data-provide="typeahead" autocomplete="off">
                <div class="input-group-append ">
                    <button type="submit" class="btn btn-info default p-1 pl-3 pr-3 pt-2" onclick="search_project()">
                        <i class="simple-icon-magnifier"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="user d-inline-block">
        </div>

    </div>
</nav>