<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.0-alpha.6
 * @link http://coreui.io
 * Copyright (c) 2017 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Wahyu Febriyana">
    <link rel="shortcut icon" href="{$basedir}files/setting/{$logo}">

    <title>LOGIN - {$appname}</title>

    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{$appname}" />
    <meta property="og:title" content="{$nama_app_singkat}" />
    <meta property="og:image" itemprop="image" content="{$basedir}files/setting/{$logo}" />
    <meta property="og:description" content="{$appname}" />
    <meta property="og:url" content="{$basedir}" />
    
    <link itemprop="thumbnailUrl" href="{$basedir}files/setting/{$logo}"> 
    <span itemprop="thumbnail" itemscope itemtype="//schema.org/ImageObject"> 
        <link itemprop="url" href="{$basedir}files/setting/{$logo}"> 
    </span>

    <!-- Icons -->
    <link href="{$themepath}css/font-awesome.min.css" rel="stylesheet">
    <link href="{$themepath}css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="{$themepath}css/style.css" rel="stylesheet">
    <script type="text/javascript">
        var jbase = "{$basedir}";
        var jtheme = "{$themepath}";
    </script>

</head>

<body class="app flex-row align-items-center" style="background-size: cover; background-position: center; background-repeat: no-repeat; background-image: url('{$basedir}images/wonosobo-background-temp3.jpg');">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group mb-0">
                    <div class="card p-4">
                        <div class="card-block">
                            <h1>Login</h1>
                            <p class="text-muted result">Sign In to your account</p>
                            <form method="POST" id="form_login" enctype="multipart/form-data">
                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                                </div>
                                <div class="input-group mb-4">
                                    <span class="input-group-addon"><i class="icon-lock"></i>
                                    </span>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary px-4">Login</button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <!-- <button type="button" class="btn btn-link px-0" data-toggle="modal" data-target="#forgot" >Lupa Password?</button> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card card-inverse card-primary py-5">
                        <div class="card-block text-center">
                            <div class="text-center">
                                <img src="{$basedir}files/setting/{$logo}" style="height: 80px;">
                                <h2>{$nama_app_singkat}</h2>
                                <p>{$appname}</p>
                                <!-- <button type="button" class="btn btn-primary active mt-3" data-toggle="modal" data-target="#myModal" style="cursor: pointer;">Register Now!</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="wf_form">
                    <div class="modal-header">
                        <h4 class="modal-title">Registration Form</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <div id="pesanpesan"></div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label>Nama</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label>Alamat</label>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" name="alamat" placeholder="Alamat" required></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label>Nomor Telepon</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="hp" class="form-control" placeholder="Nomor Telepon" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label>Nomor KTP</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="ktp" class="form-control" placeholder="Nomor KTP" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label>Email</label>
                            </div>
                            <div class="col-md-9">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-3">
                                <label>Username</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label>Password</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" id="pw" class="form-control" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label>Ulangi Password</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="pw2" id="pw2" class="form-control" placeholder="Ulangi Password" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn_daftar" class="btn btn-success">Save</button>
                        <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="forgot" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="forgot_form">
                    <div class="modal-header">
                        <h4 class="modal-title">Lupa Password</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <div id="pesanforgot"></div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label>Username / No. Hp</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="user" class="form-control" placeholder="Username / No. Hp" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src='{$themepath}js/jquery.min.js'></script>
    <script type="text/javascript" src="{$themepath}js/md5.js"></script>
    <script src="{$themepath}js/index.js"></script>
    <!-- Bootstrap and necessary plugins -->
    <script src="{$themepath}bower_components/jquery/dist/jquery.min.js"></script>
    <script src="{$themepath}bower_components/tether/dist/js/tether.min.js"></script>
    <script src="{$themepath}bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>