<?php
require $_SERVER['DOCUMENT_ROOT'] . "/transport/includes/db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Tabela Transport</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    body {
        background: #f4f7f6;
        font-family: 'Inter', sans-serif;
        margin: 0;
    }

    /* HEADER */
    .topbar {
        height: 56px;
        background: #1c1c1c;
        color: #fff;
        display: flex;
        align-items: center;
        padding: 0 15px;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1030;
    }

    /* SIDEBAR */
    .sidebar {
        width: 240px;
        height: calc(100vh - 56px);
        background: #1c1c1c;
        position: fixed;
        top: 56px;
        left: 0;
        padding: 20px;
        transition: 0.3s;
        z-index: 1020;
        overflow-y: auto;
    }

   /* SIDEBAR LINKS */
.sidebar a {
    display: block;
    color: rgba(255, 255, 255, 0.8); /* Slightly faded white for normal state */
    padding: 10px 14px;
    border-radius: 8px;
    text-decoration: none;
    margin-bottom: 6px;
    transition: 0.2s;
}

/* HOVER & ACTIVE STATE (Side links and Dropdown toggles) */
.sidebar a:hover, 
.sidebar a.active,
.sidebar .dropdown-toggle:hover {
    background: rgba(255, 255, 255, 0.1); /* Subtle light overlay */
    color: #ffffff !important;           /* Force white text */
}

/* DROPDOWN MENU CONTAINER */
/* Updated Dropdown Menu Style */
.dropdown-menu {
    display: none;        /* Hidden by default */
    position: static;     /* Push items down instead of floating over them */
    float: none;
    width: 100%;
    background-color: white !important; /* Darker grey to distinguish from sidebar */
    border: none;
    padding-left: 20px;   /* Indent the sub-items */
    margin: 0;
}

/* Ensure sub-links are visible and white */
.dropdown-menu a {
    color:grey !important;
    padding: 8px 15px;
    display: block;
    font-size: 0.9rem;
    border-radius: 4px;
}

/* Sub-link hover effect */
.dropdown-menu a:hover {
    background-color: #3d3d3d !important;
    color: #ffffff !important;
}

/* Fix for the span inside dropdown */
.dropdown-menu span {
    color: #666;
    font-size: 0.75rem;
    text-transform: uppercase;
    padding-left: 12px;
    display: block;
    margin-bottom: 5px;
}
    /* CONTENT */
    .content {
        margin-left: 240px;
        padding: 20px;
        margin-top: 56px;
        min-height: calc(100vh - 112px);
        /* Subtracts header and footer height */
    }

    .card-stat {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, .05);
        border: none;
    }

    /* FOOTER */
    footer {
        background: #1c1c1c;
        color: #fff;
        text-align: center;
        padding: 15px;
        font-size: 0.9rem;
    }
    
  .content {
    margin-left: 240px;
    padding: 20px;
    margin-top: 56px;
    min-height: calc(100vh - 112px);
}


    /* MOBILE RESPONSIVENESS */
    @media(max-width: 768px) {
        .sidebar {
            left: -240px;
        }

        .sidebar.show {
            left: 0;
        }


  .content {
    margin-left: 240px;
    padding: 20px;
    margin-top: 56px;
    min-height: calc(100vh - 112px);
}



    }
    </style>
</head>

<body>

    <header class="topbar">
        <button class="btn btn-sm btn-outline-light me-2 d-md-none" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>
        <strong class="ms-2">TABELA</strong>
    </header>

    <nav class="sidebar" id="sidebar">

        <a href="/transport/dashboard.php" class="active">
            <i class="bi bi-grid me-2"></i>Dashboard
        </a>

        <!-- Vehicles dropdown -->
        <div class="dropdown">
            <a href="#" class="dropdown-toggle">
                <i class="bi bi-truck me-2"></i> Vehicles
            </a>
            <div class="dropdown-menu">
                <span class="">Vehicle Setup</span>
                <a href="/transport/vehicles/add.php">Add Vehicles</a>
                <a href="/transport/vehicles/list.php">List Vehicles</a>
                <a href="/transport/vehicles/statuses/list.php">Vehicle Statuses</a>
                <a href="/transport/vehicles/statuses/add.php">Add Vehicle Status</a>

                <a href="/transport/vehicles/types/list.php">Vehicle types</a>
                <a href="/transport/vehicles/types/add.php">Add Vehicle types</a>

            </div>
        </div>
        <div class="dropdown">
            <a href="#" class="dropdown-toggle">
                <i class="bi bi-box me-2"></i> Roles
            </a>
            <div class="dropdown-menu">

                <a href="/transport/roles/list.php">list all Roles</a>
                <a href="/transport/roles/add.php">Add Role</a>
            </div>
        </div>

        <div class="dropdown">
            <a href="#" class="dropdown-toggle">
                <i class="bi bi-box me-2"></i> Users
            </a>
            <div class="dropdown-menu">

                <a href="/transport/users/list.php">All Users</a>
                <a href="/transport/users/add.php">Add User</a>
            </div>
        </div>


        <div class="dropdown">
            <a href="#" class="dropdown-toggle">
                <i class="bi bi-box me-2"></i> Companies
            </a>
            <div class="dropdown-menu">

                <a href="/transport/companies/list.php">All Companies</a>
                <a href="/transport/companies/add.php">Add Company</a>
            </div>
        </div>






        <!-- Shipments dropdown -->
        <div class="dropdown">
            <a href="#" class="dropdown-toggle">
                <i class="bi bi-box me-2"></i> Shipments
            </a>
            <div class="dropdown-menu">
             <a href="/transport/shipments/list.php">All Shipments</a>
<a href="/transport/shipments/add.php">Add Shipment</a>

<a href="/transport/shipments/shipment-status/add.php">
    <i class="bi bi-truck me-2"></i>Shipment Status Add
</a>

<a href="/transport/shipments/shipment-status/list.php">
    <i class="bi bi-truck me-2"></i>Shipment Status
</a>
 

            </div>
        </div>

        <!-- Accounts dropdown -->
        <div class="dropdown">
            <a href="#" class="dropdown-toggle">
                <i class="bi bi-wallet2 me-2"></i> Accounts
            </a>
            <div class="dropdown-menu">
               <a href="/transport/accounts/list.php">All Accounts</a>
<a href="/transport/accounts/add.php">Add Account</a>

<a href="/transport/accounts/types/list.php">Account Types</a>
<a href="/transport/accounts/types/add.php">Add Account Type</a>


            </div>
        </div>

        <!-- Accounts dropdown -->
        <div class="dropdown">
            <a href="#" class="dropdown-toggle">
                <i class="bi bi-wallet2 me-2"></i> Items
            </a>
            <div class="dropdown-menu">
                <a href="/transport/items/add.php">Add Item</a>
                <a href="/transport/items/list.php">View Item</a>

            </div>
        </div>

           <!-- Accounts dropdown -->
        <div class="dropdown">
            <a href="#" class="dropdown-toggle">
                <i class="bi bi-wallet2 me-2"></i> Expenses
            </a>
            <div class="dropdown-menu">
                 <a href="/transport/expenses/list.php">all Expenses</a>
<a href="/transport/expenses/add.php">Add Expense</a>

            </div>
        </div>


  


    </nav>