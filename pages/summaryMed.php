<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Summary</title>
    <link rel="icon" href="../assets/icon/medicine.svg" />
    <link rel="stylesheet" href="../assets/style/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <script defer src="../assets/script/script.js" ></script>
</head>
<body style="background: rgba(218, 218, 255, 0.26); font-size: 14px">
    <?php 
        include "../code/connection.php";
    ?>
    <div class="okok">
        <div class="navbar bgwhite">
            <!-- <img src="assets" alt=""> -->
            <h3>PharmacyKey</h3>
            <ul class="nav-item">
                <li><i class="fi fi-rr-calendar" style="margin-inline-end: 10px; position:relative; top: 2px;"></i><?php echo date('d M Y')?></li>
                <li><i class="fi fi-rr-user" style="margin-inline-end: 10px; position:relative; top: 2px;"></i>Administrator</li>
                <li ><a href="../index.php" class="logoutbtn" title="Log Out"><i class="fa fa-lg fa-power-off" ></i></a></li>
            </ul>
        </div>
    </div>
    <aside>
        <ul class="item-menu-box">
           <li><a href="?content=summary" ><i class="fa fa-home" style="margin-inline-end: 10px"></i><span class="caption">Beranda | Home</span></a></li> 
           <li>
                <details id="detpenjualan">
                    <summary><i class="fa fa-money-bill-alt" style="margin-inline-end: 10px"></i><span class="caption">Penjualan | Sales</span></summary>
                    <ul class="submenu">
                        <li><a href="?content=addsales"><i class="fa fa-plus" style="margin-inline-end: 10px"></i>Tambah | Add</a></li>
                        <li><a href="?content=editsales"><i class="fa fa-edit" style="margin-inline-end: 10px"></i>Edit/Cari | Edit/Find</a></li>
                        <li><a href="?content=repsales"><i class="fa fa-file-alt" style="margin-inline-end: 10px"></i>Laporan | Report</a></li>
                    </ul>
                </details>   
            </li>
           <li>
               <details id="detobat">
                   <summary><i class="fa fa-capsules" style="margin-inline-end: 10px"></i><span class="caption">Data Obat | Medicines</span></summary>
                   <ul class="submenu">
                        <li><a href="?content=addmedicine"><i class="fa fa-plus" style="margin-inline-end: 10px"></i>Tambah | Add</a></li>
                        <li><a href="?content=editmedicine"><i class="fa fa-edit" style="margin-inline-end: 10px"></i>Edit/Cari | Edit/Find</a></li>
                        <li><a href="?content=repmedicine"><i class="fa fa-file-alt" style="margin-inline-end: 10px"></i>Laporan | Report</a></li>
                    </ul>
               </details>
            </li>
           <li>
               <details id="detpurchase">
                   <summary><i class="fa fa-shopping-cart" style="margin-inline-end: 10px"></i><span class="caption">Pembelian | Purchase</span></summary>
                   <ul class="submenu">
                        <li><a href="?content=addpurchase"><i class="fa fa-plus" style="margin-inline-end: 10px"></i>Tambah | Add</a></li>
                        <li><a href="?content=editpurchase"><i class="fa fa-edit" style="margin-inline-end: 10px"></i>Edit/Cari | Edit/Find</a></li>
                        <li><a href="?content=reppurchase"><i class="fa fa-file-alt" style="margin-inline-end: 10px"></i>Laporan | Report</a></li>
                    </ul>
               </details>
            </li>
           <li>
               <details>
                   <summary><i class="fa fa-bell" style="margin-inline-end: 10px"></i><span class="caption">Informasi | Information </span></summary>
                   <ul class="submenu">
                        <li><a href="#"><i class="fa fa-exclamation" style="margin-inline-end: 10px"></i>Expired Soon</a></li>
                        <li><a href="#"><i class="fa fa-seedling" style="margin-inline-end: 10px"></i>Flow A</a></li>
                        <li><a href="#"><i class="fa fa-seedling" style="margin-inline-end: 10px"></i>Flow B</a></li>
                    </ul>
               </details>
            </li> 
        </ul>
    </aside>
    <main class="content">
        <?php 
            if(isset($_GET['content'])){
                $content = $_GET['content'];
                switch($content){
                    case 'summary' :
                        include "summary.php";
                        break;
                    case 'addmedicine' :
                        include "inputObat.php";
                        break;
                    case 'editmedicine' :
                        include "editObat.php";
                        break;
                    case 'repmedicine' :
                        include "reportObat.php";
                        break;
                    case 'addsales' :
                        include "inputSales.php";
                        break;
                    case 'editsales' : 
                        include "editSales.php";
                        break;
                    case 'repsales' :
                        include "reportSales.php";
                        break;
                    case 'addpurchase' : 
                        include "inputPurchase.php";
                        break;
                    case 'editpurchase' : 
                        include "editPurchase.php";
                        break;
                    case 'reppurchase' :
                        include "reportPurchase.php";
                        break;
                    default:
                        echo "Hello Summary Page";
                        break;
                }   
            } else {
                // include "editSales.php";
            }
        ?>
    </main>
    <footer class="footsum">
        Copyright &copy; 2022 - PharmaCyst Sistem Apotek  | Illustration by <a href="http://www.storyset.com" target="_blank">Storyset </a> | Develope by Rizki Ramadhan | Uicons by <a href="https://www.flaticon.com/uicons">Flaticon</a>
    </footer>
</body>
</html>