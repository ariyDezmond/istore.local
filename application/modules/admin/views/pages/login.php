<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/favicon.ico">

        <title>Вход в админ панель</title>

        <!-- Bootstrap core CSS -->
        <link href="/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="/dist/css/signin.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="/dist/js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="container">

            <?php
            $attributes = array('class' => 'form-signin');
            echo form_open('admin/login', $attributes);
            ?>
            <h2 class="form-signin-heading">Авторизация</h2>
            <?php
            echo validation_errors();

            if ($this->session->userdata('error')) {
                echo $this->session->userdata('error');
            }
            $this->session->unset_userdata('error');

            $data = array(
                'name' => 'login',
                'value' => set_value('login'),
                'class' => 'form-control',
                'placeholder' => 'логин',
                'required' => '',
                'autofocus' => ''
            );
            echo form_input($data);

            $data = array(
                'name' => 'pass',
                'value' => set_value('pass'),
                'class' => 'form-control',
                'placeholder' => 'пароль',
                'required' => ''
            );
            echo form_password($data);
            $data = array(
                'name' => 'do',
                'value' => 'login',
                'type' => 'submit',
                'class' => 'btn btn-lg btn-primary btn-block',
                'content' => 'Войти'
            );
            echo form_button($data);
            ?>
            <?php echo form_close(); ?>

        </div> <!-- /container -->


        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="/dist/js/ie10-viewport-bug-workaround.js"></script>


    </body>
</html>