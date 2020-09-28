<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | 404 Page not found</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .head {
            font-size: 200px;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, .4);
        }
    </style>
</head>

<body class="">

    <div class="container">
        <div class="row px-3">
            <div class="col-sm-12 col-lg-6 mx-auto text-center mt-5">
                <h1 class="text-warning head "> 404</h1>
                <div class="error-content">
                    <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
                    <p>
                        Maaf, Halaman yang anda cari tidak dijumpai atau silahkan coba dengan kata kunci yang lain.
                    </p>
                    <form class="search-form">
                        <div class="text-center">
                            <!-- <input type="text" name="search" class="form-control" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
                                </button>
                            </div> -->
                            <a href="<?= base_url('/dashboard'); ?>" class="btn btn-outline-info mt-4"> <i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Kembali ke halaman utama</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- ./wrapper -->

</body>

</html>