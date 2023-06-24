<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="bg-body-tertiary" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('books*') ? 'active' : '' }}" href="/books">
                        <i class="bi bi-book me-1"></i>
                        Books
                    </a>
                    <a class="nav-link {{ Request::is('categories*') ? 'active' : '' }}" href="/categories">
                        <i class="bi bi-bookmarks"></i>
                        Categories
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
