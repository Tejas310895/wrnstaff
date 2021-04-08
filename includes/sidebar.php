

        <ul class="nav page-navigation">
            <li class="nav-item <?php if(isset($_GET['dashboard'])){echo "active";} ?>">
            <a class="nav-link" href="index.php?dashboard">
                <i class="mdi mdi-file-document-box menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
            </li>
            <li class="nav-item <?php if(isset($_GET['order_new'])){echo "active";}elseif(isset($_GET['order_old'])){echo "active";} ?>">
                <a class="nav-link">
                <i class="mdi mdi-cube-outline menu-icon"></i>
                <span class="menu-title">Orders</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul>
                        <li class="nav-item"><a class="nav-link" href="index.php?order_new">Generate Order</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?order_old">Modify Orders</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item <?php if(isset($_GET['reports'])){echo "active";} ?>">
                <a href="index.php?reports" class="nav-link reports">
                <i class="mdi mdi-chart-areaspline menu-icon"></i>
                <span class="menu-title">Reports</span>
                </a>
            </li>
        </ul>
