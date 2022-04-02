<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Management System</title>
    <link rel="icon" href="assets/icon/medicine.svg" />
    <link rel="stylesheet" href="assets/style/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="assets/script/script.js" ></script>
</head>
<body>
    <header>
        <div class="navbar">
            <!-- <img src="assets" alt=""> -->
            <h3>PharmacyKey</h3>
            <ul class="nav-item">
                <li ><a href="#" class="loginbtn" onclick="showlogin()">Log In</a></li>
            </ul>
        </div>
    </header>
    <main>
        <div class="jumbotron">
            <div class="tagline">
                <h1>Kelola Obat Lebih Mudah </h1>
                <p>Membantu anda dalam memantau persediaan obat dan menentukan pilihan restock untuk obat dengan flow tinggi. Anda juga dapat memantau pendapatan dan pengeluaran atas stok obat yang anda miliki.</p>
                <a href="#" onclick="showlogin()">Cek Sekarang</a>
            </div>
            <figure>
                <img src="assets/illusbg/pharmacist.svg" alt="illus">
            </figure>
        </div>
    </main>
    <div class="loginbox">
        <div class="formlogin">
            <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--line); padding-bottom: 10px;">
                <h1>Log In</h1>
                <a href="#" class="btnclose" onclick="hidelogin()"><i class="fa fa-lg fa-times-circle"></i></a>
            </div>
            <div class="loginitem">
                <img src="assets/illusbg/illuslogin.svg" alt="illus">
                <div class="logintext">
                    <form action="pages/summaryMed.php" method="post">
                        <div>
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username">
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password">
                        </div>
                        <button type="submit"><i class="fa fa-sign-in-alt" style="margin-inline-end: 10px;"></i>Log In</button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    <footer>
        Copyright &copy; 2022 - PharmaCyst Sistem Apotek  | Illustration by <a href="http://www.storyset.com" target="_blank">Storyset </a> | Develope by Rizki Ramadhan
    </footer>
</body>
</html>